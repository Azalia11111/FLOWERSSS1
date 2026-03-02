
@extends('layouts.app')

@section('title', 'Личный кабинет продавца — Управление позициями')

@section('content')
<div class="container">
    <h1>Управление цветами</h1>

    {{-- Сообщения об успехе --}}
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    {{-- Форма создания нового цвета --}}
    <h2>Добавить новый цвет</h2>
    <form action="{{ route('seller.flowers.store') }}" method="POST" enctype="multipart/form-data" style="margin-bottom:30px;">
        @csrf
        <div>
            <label>Название</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Цена (₽)</label><br>
            <input type="number" name="price" value="{{ old('price') }}" required>
            @error('price') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Изображение</label><br>
            <input type="file" name="image" required>
            @error('image') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <button type="submit" style="margin-top:10px;">Добавить</button>
    </form>

    {{-- Список цветов --}}
    <h2>Список цветов</h2>
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Изображение</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flowers as $flower)
                <tr>
                    <td>{{ $flower->id }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $flower->image) }}" alt="{{ $flower->name }}" style="width:100px; object-fit: cover;">
                    </td>
                    <td>{{ $flower->name }}</td>
                    <td>{{ number_format($flower->price, 0, '', ' ') }} ₽</td>
                    <td>
                        <a href="{{ route('flowers.edit', $flower->id) }}">Редактировать</a>
                        <form action="{{ route('flowers.show', $flower->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Удалить этот цвет?')">
        @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if($flowers->isEmpty())
                <tr><td colspan="5" style="text-align:center;">Позиции отсутствуют</td></tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
