
@extends('layouts.app')

@section('title', 'LOWERS — Цветы')

@push('head')
<style>
    /* Общие стили из вашего шаблона + стили для категорий и карточек */
    .flowers-container {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }
    .flower-card {
        border: 1px solid #ddd;
        padding: 10px;
        width: 220px;
        text-align: center;
        border-radius: 12px;
        background: linear-gradient(180deg, #fff, #fffaf9);
        box-shadow: 0 2px 8px rgba(243,232,255,0.3);
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .flower-card img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .admin-actions {
        display: flex;
        gap: 8px;
        margin-top: 8px;
    }
    form.add-flower-form {
        max-width: 600px;
        margin-top: 20px;
    }
    form.add-flower-form div {
        margin-bottom: 10px;
    }
    form.add-flower-form input[type="text"],
    form.add-flower-form input[type="number"],
    form.add-flower-form select,
    form.add-flower-form textarea {
        width: 100%;
        padding: 6px;
        box-sizing: border-box;
    }
    .error-message {
        color: red;
        font-size: 0.9em;
    }
    .success-message {
        color: green;
        margin-bottom: 15px;
    }

    /* Новые стили для блоков по категориям */
    .category-wrapper {
        background: #fff;
        border-radius: 14px;
        padding: 18px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 6px 18px rgba(243,232,255,0.5);
        margin-bottom: 30px;
    }
    .category-wrapper h2 {
        font-family: 'Playfair Display', serif;
        margin: 0 0 12px 0;
    }
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 14px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1>Каталог цветов</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @php
        // Группируем цветы по категориям
        $flowersByCategory = $flowers->groupBy(fn($f) => $f->category?->name ?? 'Без категории');
    @endphp

    {{-- Блоки по категориям (Розы, Тюльпаны, Гипсофила) --}}
    @foreach(['Розы', 'Тюльпаны', 'Гипсофила'] as $categoryName)
        @if(isset($flowersByCategory[$categoryName]) && $flowersByCategory[$categoryName]->count())
            <div class="category-wrapper">
                <h2>{{ $categoryName }}</h2>
                <div class="category-grid">
                    @foreach($flowersByCategory[$categoryName] as $flower)
                        <div class="flower-card">
                            @if($flower->image_path)
                               
 
<img src="{{ asset('storage/' . $flower->image_path) }}" alt="{{ $flower->name }}">


                            @else
                                <img src="{{ asset('placeholder.jpg') }}" alt="Изображение отсутствует">
                            @endif
                            <h3>{{ $flower->name }}</h3>
                            <p>Цена: {{ $flower->price }} ₽</p>

                            @auth
                                @if(auth()->user()->is_admin)
                                    <div  class="admin-actions">
                                        <a href="{{ route('flowers.edit', $flower) }}">Редактировать</a>
                                        <form action="{{ route('flowers.destroy', $flower) }}" method="POST" onsubmit="return confirm('Удалить?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Удалить</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth

                            <a href="{{ route('cart.add', ['id' => $flower->id]) }}" class="flower-cart-link" style="margin-top: auto; display: inline-block; padding: 8px 12px; background: #f08aa1; color: #fff; border-radius: 8px; text-decoration: none; font-weight: 700;">В корзину</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    {{-- Если нужны цветы без категории или другие категорії - их можно отобразить ниже так же --}}

    @auth
        @if(auth()->user()->is_admin)
            <hr>
            <h2>Добавить новый Цветок</h2>
            <form class="add-flower-form" action="{{ route('flowers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label>Название</label><br>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                    @error('name') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label>Категория</label><br>
                    <select name="category_id">
                        <option value="">-- Без категории --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="error-message">{{ $message }}</div> @enderror
                </div>

              



                <div>
                    <label>Цена (₽)</label><br>
                    <input type="number" name="price" step="0.01" value="{{ old('price') }}" required>
                    @error('price') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label>Описание</label><br>
                    <textarea name="description">{{ old('description') }}</textarea>
                    @error('description') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div>
    <label>Изображение</label><br>
    <input type="file" name="image" accept="image/*" capture="environment" id="imageInput">
    <div>
        <img id="preview" src="" alt="Превью изображения" style="max-width: 100%; margin-top:10px; display:none; border-radius: 8px;">
    </div>
    @error('image') <div class="error-message">{{ $message }}</div> @enderror
</div>
<script>
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('preview');

    input.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.setAttribute('src', e.target.result);
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            preview.setAttribute('src', '');
        }
    });
</script>


                <button type="submit" style="margin-top:10px;">Добавить</button>
            </form>
        @endif
    @endauth
</div>
@endsection

