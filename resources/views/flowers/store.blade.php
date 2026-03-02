
@extends('layouts.app')

@section('title', 'Добавить Цветок')

@section('content')
<div class="container">
    <h1>Добавить новый Цветок</h1>

    <form action="{{ route('flowers.store') }}" method="POST" enctype="multipart/form-data" style="max-width:600px;">
        @csrf
        <div>
            <label>Название</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Категория</label><br>
            <select name="category_id" required>
                <option value="">-- Выберите категорию --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Цена (₽)</label><br>
            <input type="number" name="price" step="0.01" value="{{ old('price') }}" required>
            @error('price') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Описание</label><br>
            <textarea name="description">{{ old('description') }}</textarea>
            @error('description') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Изображение</label><br>
            <input type="file" name="image" required>
            @error('image') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <button type="submit" style="margin-top:10px;">Добавить</button>
    </form>
</div>
@endsection
