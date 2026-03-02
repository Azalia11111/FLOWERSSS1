@extends('layouts.app')

@section('title', 'Заказ #' . $order->id)

@section('content')
<div style="background:#fff;border-radius:12px;padding:20px;border:1px solid rgba(0,0,0,.04);max-width:800px;">
  <h2>Спасибо! Ваш заказ принят</h2>
  <p>Номер заказа: <strong>#{{ $order->id }}</strong></p>
  <p style="margin-bottom:12px">По готовности букета напишем вам на почту.</p>

  <h3>Товары</h3>
  <table style="width:100%;border-collapse:collapse">
    <thead>
      <tr style="text-align:left;border-bottom:1px solid #eee">
         <th style="text-align:left;padding:8px"></th>
        <th style="padding:8px;width:120px">Цена</th>
        <th style="padding:8px;width:100px">Кол-во</th>
        <th style="padding:8px;width:140px;text-align:right">Сумма</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->items as $it)
        @php
          $name = $it['name'] ?? $it['title'] ?? 'Товар';
          $price = $it['price'] ?? 0;
          $qty = $it['qty'] ?? 1;
        @endphp
        <tr>
          <td style="padding:8px;border-bottom:1px solid #f4f4f4">{{ $name }}</td>
          <td style="padding:8px;border-bottom:1px solid #f4f4f4">{{ number_format($price,0,'',' ') }} ₽</td>
          <td style="padding:8px;border-bottom:1px solid #f4f4f4">{{ $qty }}</td>
          <td style="padding:8px;border-bottom:1px solid #f4f4f4;text-align:right">{{ number_format($price * $qty,0,'',' ') }} ₽</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div style="margin-top:12px;font-weight:700;text-align:right">Итого: {{ number_format($order->total,0,'',' ') }} ₽</div>

  <p style="margin-top:16px"><a href="{{ url('/') }}" class="btn ghost">Вернуться в каталог</a></p>
</div>
@endsection

