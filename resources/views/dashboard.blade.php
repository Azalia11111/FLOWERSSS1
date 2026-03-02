
@
@section('title', 'Заказ оформлен')

@section('content')
  <div style="background:#fff;border-radius:12px;padding:20px;border:1px solid rgba(0,0,0,.04);max-width:700px;">
    <h2>Спасибо! Ваш заказ принят</h2>
    @if(isset($order))
      <p>Номер заказа: <strong>#{{ $order->id }}</strong></p>
      @php
        $items = $order->items ?? [];
        $total = $order->total_price ?? 0;
      @endphp

      @if(!empty($items))
        <ul style="list-style:none;padding:0;margin:16px 0;">
          @foreach($items as $item)
            <li style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid rgba(0,0,0,.04);align-items:center;">
              <div>
                <strong>{{ $item['name'] ?? $item['title'] ?? 'Товар' }}</strong><br>
                <small>{{ $item['qty'] ?? 1 }} × {{ number_format($item['price'] ?? 0, 0, '', ' ') }} ₽</small>
              </div>
              <div style="font-weight:700;">
                {{ number_format(($item['price'] ?? 0) * ($item['qty'] ?? 1), 0, '', ' ') }} ₽
              </div>
            </li>
          @endforeach
        </ul>
        <div style="font-weight:700;font-size:16px; text-align:right;">
          Итого: {{ number_format($total, 0, '', ' ') }} ₽
        </div>
      @endif

      <p>При готовности букета мы вам позвоним.</p>
    @else
      <p>Информация о заказе недоступна.</p>
    @endif
    <p style="margin-top:12px"><a href="{{ url('/') }}" class="btn ghost">Вернуться в каталог</a></p>
  </div>
@endsection
