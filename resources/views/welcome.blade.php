 @extends('layouts.app')

@section('title','LOWERS — Главная')

@push('head')
<!-- Можно добавить дополнительные стили если нужно -->
@endpush

@section('content')
    <section id="catalog">
        <div style="display:grid;gap:20px">
            <!-- Розы -->
            <div style="background:#fff;border-radius:14px;padding:18px;border:1px solid rgba(0,0,0,0.03);box-shadow:0 6px 18px rgba(243,232,255,0.5)">
                <h2 style="font-family:Playfair Display, serif;margin:0 0 12px">Розы</h2>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px">
                    <div style="text-align:center;border-radius:12px;padding:12px;background:linear-gradient(180deg,#fff,#fffaf9);">
                        <img src="{{ asset('1.jpg') }}" alt="Роза 1" style="width:100%;height:160px;object-fit:cover;border-radius:8px;margin-bottom:10px">
                        <div style="font-weight:600">Роза — Композиция 1</div>
                        <div style="color:#7d7d7d">1 200 ₽</div>
                        <a href="{{ route('cart.add', ['id' => 1]) }}" style="display:inline-block;margin-top:8px;padding:8px 12px;background:#f08aa1;color:#fff;border-radius:8px;text-decoration:none;font-weight:700">В корзину</a>
                    </div>
                    <div style="text-align:center;border-radius:12px;padding:12px;background:linear-gradient(180deg,#fff,#fffaf9);">
                        <img src="{{ asset('2.jpg') }}" alt="Роза 2" style="width:100%;height:160px;object-fit:cover;border-radius:8px;margin-bottom:10px">
                        <div style="font-weight:600">Роза — Композиция 2</div>
                        <div style="color:#7d7d7d">1 350 ₽</div>
                        <a href="{{ route('cart.add', ['id' => 2]) }}" style="display:inline-block;margin-top:8px;padding:8px 12px;background:#f08aa1;color:#fff;border-radius:8px;text-decoration:none;font-weight:700">В корзину</a>
                    </div>
                    <div style="text-align:center;border-radius:12px;padding:12px;background:linear-gradient(180deg,#fff,#fffaf9);">
                        <img src="{{ asset('3.jpg') }}" alt="Роза 3" style="width:100%;height:160px;object-fit:cover;border-radius:8px;margin-bottom:10px">
                        <div style="font-weight:600">Роза — Композиция 3</div>
                        <div style="color:#7d7d7d">1 500 ₽</div>
                        <a href="{{ route('cart.add', ['id' => 3]) }}" style="display:inline-block;margin-top:8px;padding:8px 12px;background:#f08aa1;color:#fff;border-radius:8px;text-decoration:none;font-weight:700">В корзину</a>
                    </div>
                </div>
            </div><!-- Тюльпаны -->
            <div style="background:#fff;border-radius:14px;padding:18px;border:1px solid rgba(0,0,0,0.03);box-shadow:0 6px 18px rgba(243,232,255,0.5)">
                <h2 style="font-family:Playfair Display, serif;margin:0 0 12px">Тюльпаны</h2>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px">
                    <div style="text-align:center;padding:12px;background:linear-gradient(180deg,#fff,#fffaf9);border-radius:12px">
                        <img src="{{ asset('4.jpg') }}" alt="Тюльпан 1" style="width:100%;height:160px;object-fit:cover;border-radius:8px;margin-bottom:10px">
                        <div style="font-weight:600">Тюльпан — Букет 1</div>
                        <div style="color:#7d7d7d">900 ₽</div>
                        <a href="{{ route('cart.add', ['id' => 4]) }}" style="display:inline-block;margin-top:8px;padding:8px 12px;background:#f08aa1;color:#fff;border-radius:8px;text-decoration:none;font-weight:700">В корзину</a>
                    </div>
                    <div style="text-align:center;padding:12px;background:linear-gradient(180deg,#fff,#fffaf9);border-radius:12px">
                        <img src="{{ asset('5.jpg') }}" alt="Тюльпан 2" style="width:100%;height:160px;object-fit:cover;border-radius:8px;margin-bottom:10px">
                        <div style="font-weight:600">Тюльпан — Букет 2</div>
                        <div style="color:#7d7d7d">1 050 ₽</div>
                        <a href="{{ route('cart.add', ['id' => 5]) }}" style="display:inline-block;margin-top:8px;padding:8px 12px;background:#f08aa1;color:#fff;border-radius:8px;text-decoration:none;font-weight:700">В корзину</a>
                    </div>
                    <div style="text-align:center;padding:12px;background:linear-gradient(180deg,#fff,#fffaf9);border-radius:12px">
                        <img src="{{ asset('6.jpg') }}" alt="Тюльпан 3" style="width:100%;height:160px;object-fit:cover;border-radius:8px;margin-bottom:10px">
                        <div style="font-weight:600">Тюльпан — Букет 3</div>
                        <div style="color:#7d7d7d">1 100 ₽</div>
                        <a href="{{ route('cart.add', ['id' => 6]) }}" style="display:inline-block;margin-top:8px;padding:8px 12px;background:#f08aa1;color:#fff;border-radius:8px;text-decoration:none;font-weight:700">В корзину</a>
                    </div>
                </div>
            </div><!-- Гипсофила -->
            <div style="background:#fff;border-radius:14px;padding:18px;border:1px solid rgba(0,0,0,0.03);box-shadow:0 6px 18px rgba(243,232,255,0.5)">
                <h2 style="font-family:Playfair Display, serif;margin:0 0 12px">Гипсофила</h2>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px">
                    <div style="text-align:center;padding:12px;background:linear-gradient(180deg,#fff,#fffaf9);border-radius:12px">
                        <img src="{{ asset('7.jpg') }}" alt="Гипсофила 1" style="width:100%;height:160px;object-fit:cover;border-radius:8px;margin-bottom:10px">
                        <div style="font-weight:600">Гипсофила — Нежность 1</div>
                        <div style="color:#7d7d7d">600 ₽</div>
                        <a href="{{ route('cart.add', ['id' => 7]) }}" style="display:inline-block;margin-top:8px;padding:8
px 12px;background:#f08aa1;color:#fff;border-radius:8px;text-decoration:none;font-weight:700">В корзину</a>
                    </div>
                    <div style="text-align:center;padding:12px;background:linear-gradient(180deg,#fff,#fffaf9);border-radius:12px">
                        <img src="{{ asset('8.jpg') }}" alt="Гипсофила 2" style="width:100%;height:160px;object-fit:cover;border-radius:8px;margin-bottom:10px">
                        <div style="font-weight:600">Гипсофила — Нежность 2</div>
                        <div style="color:#7d7d7d">650 ₽</div>
                        <a href="{{ route('cart.add', ['id' => 8]) }}" style="display:inline-block;margin-top:8px;padding:8px 12px;background:#f08aa1;color:#fff;border-radius:8px;text-decoration:none;font-weight:700">В корзину</a>
                    </div>
                    <div style="text-align:center;padding:12px;background:linear-gradient(180deg,#fff,#fffaf9);border-radius:12px">
                        <img src="{{ asset('9.jpg') }}" alt="Гипсофила 3" style="width:100%;height:160px;object-fit:cover;border-radius:8px;margin-bottom:10px">
                        <div style="font-weight:600">Гипсофила — Нежность 3</div>
                        <div style="color:#7d7d7d">700 ₽</div>
                        <a href="{{ route('cart.add', ['id' => 9]) }}" style="display:inline-block;margin-top:8px;padding:8px 12px;background:#f08aa1;color:#fff;border-radius:8px;text-decoration:none;font-weight:700">В корзину</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
@endsection