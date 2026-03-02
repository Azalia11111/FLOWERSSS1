@extends('layouts.app')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
    <h1>Корзина</h1>
    <a href="{{ url('/') }}" class="btn ghost">Каталог</a>
</div>

@if(session('status'))
  <div style="padding:10px;border:1px solid #e6f4ea;background:#f3fff6;border-radius:8px;margin-bottom:12px">
    {{ session('status') }}
  </div>
@endif

@php
  $cart = $cart ?? session('cart', ['items'=>[],'total'=>0]);
  $products = $products ?? collect();
@endphp

@if(empty($cart['items']) || count($cart['items']) === 0)
    <div style="padding:20px;background:#fff6f8;border:1px solid rgba(240,138,161,.12);border-radius:8px">Ваша корзина пуста.</div>
@else
  <div style="background:#fff;border:1px solid #eee;padding:12px;border-radius:8px;margin-bottom:12px;">
    <ul style="list-style:none;margin:0;padding:0">
      @foreach($cart['items'] as $id => $rawQty)
        @php
          $product = $products->get($id);
          // поддержка двух форматов корзины: id => qty или id => ['qty'=>n]
          $qty = is_array($rawQty) ? ($rawQty['qty'] ?? 1) : (int)$rawQty;
          $name = $product->name ?? ($product->title ?? 'Товар');
          $price = $product->price ?? 0;
          $image = $product->image ?? null;
          $lineTotal = $price * max(0, $qty);
        @endphp

        <li style="display:flex;justify-content:space-between;padding:12px 0;border-bottom:1px solid rgba(0,0,0,.04);align-items:center">
          <div style="display:flex;gap:12px;align-items:center;max-width:70%;">
            @if($image)
              <img src="{{ asset(ltrim( '/')) }}" alt="{{ $name }}" style="width:72px;height:56px;object-fit:cover;border-radius:6px">
            @endif
            <div>
              <div style="font-weight:600">{{ $name }}</div>
              <div style="color:#7d7d7d;font-size:13px;">{{ number_format($price,0,'',' ') }} ₽</div>
            </div>
          </div>

          <div style="display:flex;gap:8px;align-items:center">
            <form method="post" action="{{ route('cart.update', $id) }}" style="display:inline-flex;align-items:center;">
              @csrf
              <input type="number" name="qty" value="{{ $qty }}" min="0" style="width:64px;padding:6px;border:1px solid #eee;border-radius:6px;text-align:center">
              <button class="btn" type="submit" style="padding:6px 10px;margin-left:6px">Обновить</button>
            </form>

            <form method="post" action="{{ route('cart.remove', $id) }}" style="display:inline-block;margin-left:6px;">
              @csrf
              <button class="btn ghost" type="submit" onclick="return confirm('Удалить товар?')">Удалить</button>
            </form>

            <div style="font-weight:700;margin-left:12px">{{ number_format($lineTotal,0,'',' ') }} ₽</div>
          </div>
        </li>
      @endforeach
    </ul>

    <div style="margin-top:12px;display:flex;justify-content:space-between;align-items:center">
      <div style="font-weight:700">Итого: {{ number_format($cart['total'] ?? 0,0,'',' ') }} ₽</div>

      <div style="display:flex;gap:8px">
        <form method="post" action="{{ route('cart.clear') }}">
          @csrf
          <button class="btn ghost" type="submit" onclick="return confirm('Очистить корзину?')">Очистить</button>
        </form>

      <form method="POST" action="{{ route('orders.store') }}">
  @csrf
  <button type="submit" class="btn">Оформить заказ</button>
</form>

      </div>
    </div>
  </div>
@endif
@endsection
