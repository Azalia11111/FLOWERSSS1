@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 900px; margin: 0 auto; padding: 20px;">
    <h1 style="margin-bottom: 20px; font-family: 'Playfair Display', serif;">
        {{ auth()->user()->email === 'ruslan32r26663r2r@gmail.com' ? 'Управление заказами (Админ)' : 'Мои заказы' }}
    </h1>

    @if($orders->isEmpty())
        <div style="background: #fff; padding: 20px; border-radius: 8px; text-align: center; border: 1px solid #eee;">
            Заказов пока нет.
        </div>
    @else
        @foreach($orders as $order)
          <div style="padding:20px; border:1px solid #eee; margin-bottom:20px; border-radius:12px; background:#fff; box-shadow: 0 4px 10px rgba(0,0,0,0.03);">
            
            {{-- Верхняя часть: Номер, Дата и Сумма --}}
            <div style="display:flex; justify-content:space-between; align-items:flex-start; border-bottom: 1px solid #f4f4f4; padding-bottom: 10px; margin-bottom: 10px;">
                <div>
                    <a href="{{ route('orders.show', $order->id) }}" style="font-weight:700; color:#f08aa1; text-decoration:none; font-size:19px;">
                        Заказ #{{ $order->id }}
                    </a>
                    <div style="font-size:13px; color:#666; margin-top: 5px;">
                        📅 {{ $order->created_at->format('d.m.Y') }} в {{ $order->created_at->format('H:i') }}
                    </div>
                </div>
                
                <div style="text-align:right;">
                    <div style="font-size:18px; font-weight:700; color:#333;">{{ number_format($order->total, 0, '', ' ') }} ₽</div>
                    <div style="font-size:11px; color:#fff; background:{{ $order->status == 'pending' ? '#ffc107' : '#28a745' }}; padding:2px 7px; border-radius:4px; display:inline-block; margin-top:5px; text-transform: uppercase;">
                        {{ $order->status }}
                    </div>
                </div>
            </div>

            {{-- 1. ДАННЫЕ КЛИЕНТА (Только для Админа) --}}
            @if(auth()->user()->email === 'ruslan32r26663r2r@gmail.com')
                <div style="background: #fff5f7; padding: 10px; border-radius: 6px; margin-bottom: 10px; font-size: 14px; border-left: 4px solid #f08aa1;">
                    <strong>Клиент:</strong> {{ $order->name }} | <strong>Email:</strong> {{ $order->email }}
                </div>
            @endif

            {{-- 2. СПИСОК ТОВАРОВ (Для всех) --}}
            <div style="margin-top: 10px;">
                <span style="color: #888; font-size: 12px; text-transform: uppercase; font-weight: 700;">Состав заказа:</span>
                <ul style="list-style: none; padding: 0; margin: 5px 0 0 0;">
                    @php
                        // Безопасное декодирование данных
                        $rawItems = is_string($order->items) ? json_decode($order->items, true) : $order->items;
                        $itemsList = (isset($rawItems['items']) && is_array($rawItems['items'])) ? $rawItems['items'] : $rawItems;
                    @endphp

                    @if(is_iterable($itemsList))
                        @foreach($itemsList as $key => $item)
                            <li style="display: flex; justify-content: space-between; font-size: 14px; padding: 3px 0; border-bottom: 1px dashed #f0f0f0;">
                                @if(is_array($item))
                                    {{-- Если данные в формате массива (новое) --}}
                                    <span>
                                        {{ is_string($item['name'] ?? null) ? $item['name'] : 'Товар' }} 
                                        <strong style="color: #f08aa1;">(x{{ $item['qty'] ?? 1 }})</strong>
                                    </span>
                                    <span style="color: #666;">{{ number_format(floatval($item['price'] ?? 0) * intval($item['qty'] ?? 1), 0, '', ' ') }} ₽</span>
                                @else
                                    {{-- Если данные в старом формате (ID => Кол-во) --}}
                                    <span>Товар #{{ $key }} <strong>(x{{ $item }})</strong></span>
                                    <span style="color: #666;">--- ₽</span>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li style="color: #999; font-size: 13px;">Информация о товарах недоступна</li>
                    @endif
                </ul>
            </div>

           
            <div style="margin-top: 15px; text-align: right;">
               
            </div>
          </div>
        @endforeach

        <div style="margin-top:20px;">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
