<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
// Добавьте это
use App\Models\Flower;
class OrderController extends Controller
{
   
 public function store(Request $request)
{
    $request->validate([
        'name' => 'nullable|string|max:255',
        'email'=> 'nullable|email|max:255',
    ]);

    $cart = session('cart', ['items'=>[], 'total'=>0]);
    if (empty($cart['items'])) {
        return redirect()->route('cart.index')->with('error','Корзина пуста');
    }

    $ids = array_keys($cart['items']);
    $flowers = Flower::whereIn('id', $ids)->get()->keyBy('id');

    $items = []; $total = 0;
    foreach ($cart['items'] as $id => $raw) {
        $qty = is_array($raw) ? ($raw['qty'] ?? (int)$raw) : (int)$raw;
        $f = $flowers->get($id);
        if (! $f) continue;
        $items[] = ['id'=>$f->id,'name'=>$f->name,'price'=> (int)$f->price,'qty'=>$qty,'image'=>$f->image ?? null];
        $total += $f->price * $qty;
    }

    try {
        $order = Order::create([
            'user_id' => auth()->id(),
            'name'    => $request->input('name', auth()->user()->name ?? null),
            'email'   => $request->input('email', auth()->user()->email ?? null),
            'items'   => $items,
            'total'   => $total,
            'status'  => 'pending',
        ]);
        session()->forget('cart');
        return redirect()->route('orders.show', $order->id)->with('success','Заказ оформлен');
    } catch (\Throwable $e) {
        Log::error($e->getMessage());
        return back()->with('error','Не удалось сохранить заказ');
    }
}

    

     public function index()
{
    $user = auth()->user();

    // Проверяем, является ли пользователь админом
    // Можно проверять по email или по наличию вашего AdminMiddleware
    if ($user->email === 'ruslan32r26663r2r@gmail.com') {
        // Админ видит ВСЕ заказы всех пользователей
        $orders = \App\Models\Order::latest()->paginate(15);
    } else {
        // Обычный пользователь видит только СВОИ заказы
        $orders = $user->orders()->latest()->paginate(10);
    }

    return view('orders.index', compact('orders'));
}

public function show(Order $order)
{
    abort_unless(auth()->check() && $order->user_id === auth()->id(), 403);
    $items = $order->items; // уже массив
    return view('orders.show', compact('order','items'));
}

    public function success(Order $order)
    {
        return view('orders.success', compact('order'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart.items', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart.items', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Товар удален из корзины.');
    }

    public function dashboard(Request $request)
    {
        $orderId = $request->session()->get('order_id'); 
        if (!$orderId) {
            return redirect('/')->with('error', 'Заказ не найден');
        }
        $order = Order::find($orderId);
        return view('dashboard', compact('order'));
    }

  
    public function create()
{
    $cart = session('cart', ['items' => [], 'total' => 0]);

    if (empty($cart['items'])) {
        return redirect()->route('cart.index')->with('error', 'Корзина пуста');
    }

    $productIds = array_keys($cart['items']);
    $flowers = Flower::whereIn('id', $productIds)->get()->keyBy('id');

    $items = [];
    $total = 0;
    foreach ($cart['items'] as $id => $raw) {
        $qty = is_array($raw) ? ($raw['qty'] ?? 1) : (int)$raw;
        $f = $flowers->get($id);
        $price = $f->price ?? ($raw['price'] ?? 0);
        $name = $f->name ?? ($raw['name'] ?? 'Товар');

        $items[] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'qty' => $qty,
            'image' => $f->image ?? null,
        ];

        $total += $price * $qty;
    }

    return view('orders.show', compact('items', 'total'));
}
}
