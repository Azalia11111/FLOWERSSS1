<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
     private function products()
    {
        return [
            1 => ['id'=>1,'name'=>'Роза — Композиция 1','price'=>1200,'image'=>'/images/1.jpg'],
            2 => ['id'=>2,'name'=>'Роза — Композиция 2','price'=>1350,'image'=>'/images/2.jpg'],
            3 => ['id'=>3,'name'=>'Роза — Композиция 3','price'=>1500,'image'=>'/images/3.jpg'],
            4 => ['id'=>4,'name'=>'Тюльпан — Букет 1','price'=>900,'image'=>'/images/4.jpg'],
            5 => ['id'=>5,'name'=>'Тюльпан — Букет 2','price'=>1050,'image'=>'/images/5.jpg'],
            6 => ['id'=>6,'name'=>'Тюльпан — Букет 3','price'=>1100,'image'=>'/images/6.jpg'],
            7 => ['id'=>7,'name'=>'Гипсофила — Нежность 1','price'=>600,'image'=>'/images/7.jpg'],
            8 => ['id'=>8,'name'=>'Гипсофила — Нежность 2','price'=>650,'image'=>'/images/8.jpg'],
            9 => ['id'=>9,'name'=>'Гипсофила — Нежность 3','price'=>700,'image'=>'/images/9.jpg'],
        ];
    }

private function recalc(array &$cart)
{
    $total = 0;
    foreach ($cart['items'] as $productId => $raw) {
        $qty = is_array($raw) ? ($raw['qty'] ?? (int)$raw) : (int)$raw;
        $product = \App\Models\Flower::find($productId);
        if ($product) {
            $total += $product->price * $qty;
        }
    }
    $cart['total'] = $total;
}


  public function index()
{
    // Берём корзину из сессии и нормализуем её в массив с ключом items
    $cart = session('cart', ['items' => [], 'total' => 0]);

    if (!is_array($cart) || !isset($cart['items']) || !is_array($cart['items'])) {
        $cart = ['items' => [], 'total' => 0];
        session(['cart' => $cart]);
    }

    // Получаем ID товаров (если есть)
    $productIds = array_keys($cart['items']);
    if (count($productIds) > 0) {
        $products = \App\Models\Flower::whereIn('id', $productIds)->get()->keyBy('id');
    } else {
        $products = collect();
    }

    return view('cart.index', compact('cart', 'products'));
}

    public function add(Request $request, $id)
{
    $cart = session('cart', ['items' => [], 'total' => 0]);

    if (!is_array($cart) || !isset($cart['items']) || !is_array($cart['items'])) {
        $cart = ['items' => [], 'total' => 0];
    }

    $cart['items'][$id] = ($cart['items'][$id] ?? 0) + 1;

    // При необходимости пересчитай total (пример: цена из БД)
    $flower = \App\Models\Flower::find($id);
    $cart['total'] = ($cart['total'] ?? 0) + ($flower ? $flower->price : 0);

    session(['cart' => $cart]);

    return redirect()->route('cart.index')->with('success', 'Добавлено в корзину');
}

    public function update(Request $request, $id)
{
    $qty = (int) $request->input('qty', 1);
    $cart = session('cart', ['items' => [], 'total' => 0]);

    if (isset($cart['items'][$id])) {
        if ($qty <= 0) {
            unset($cart['items'][$id]);
        } else {
            // Нормализуем в простой формат: id => qty (int)
            $cart['items'][$id] = $qty;
        }
        $this->recalc($cart);
        session(['cart' => $cart]);
    }

    return redirect()->route('cart.index')->with('status','Корзина обновлена');
}


    public function remove(Request $request, $id)
    {
        $cart = session('cart', ['items'=>[],'total'=>0]);
        if (isset($cart['items'][$id])) {
            unset($cart['items'][$id]);
            $this->recalc($cart);
            session(['cart'=>$cart]);
        }
        return redirect()->route('cart.index')->with('status','Товар удалён');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('status','Корзина очищена');
    }
}
