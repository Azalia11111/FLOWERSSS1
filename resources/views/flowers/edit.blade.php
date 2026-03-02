
@extends('layouts.app')

@section('title', 'Редактировать Цветок')

@section('content')
<div class="container">
    <h1>Редактировать: {{ $flower->name }}</h1>

    <form action="{{ route('flowers.update', $flower) }}" method="POST" enctype="multipart/form-data" style="max-width:600px;">
        @csrf
        @method('PUT')

        <div>
            <label>Название</label><br>
            <input type="text" name="name" value="{{ old('name', $flower->name) }}" required>
            @error('name') <div style="color:red">{{ $message }}</div> @enderror
 </div>

        <div>
            <label>Категория</label><br>
            <select name="category_id" required>
                <option value="">-- Выберите категорию --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $flower->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Цена (₽)</label><br>
            <input type="number" name="price" step="0.01" value="{{ old('price', $flower->price) }}" required>
            @error('price') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Описание</label><br>
            <textarea name="description">{{ old('description', $flower->description) }}</textarea>
            @error('description') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Текущее изображение</label><br>
            @if($flower->image_path)
                <img src="{{ asset('storage/' . $flower->image_path) }}" alt="{{ $flower->name }}" style="width:200px;height:120px;object-fit:cover;">
            @endif
        </div>

        <div>
            <label>Изменить изображение</label><br>
            <input type="file" name="image">
            @error('image') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <button type="submit" style="margin-top:10px;">Обновить</button>
    </form>
</div>
@endsection
