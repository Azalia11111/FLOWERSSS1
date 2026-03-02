<form method="POST" action="{{ route('flowers.store') }}" enctype="multipart/form-data">
  @csrf
  <input name="name" placeholder="Название" value="{{ old('name') }}" required>

  <select name="category_id" class="form-control">
    <option value="">-- Без категории --</option>
    @foreach($categories as $cat)
      <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
        {{ $cat->name }}
      </option>
    @endforeach
  </select>

  <input name="price" type="number" step="0.01" placeholder="Цена" value="{{ old('price') }}" required>
  <textarea name="description" placeholder="Описание">{{ old('description') }}</textarea>
  <input type="file" name="image" accept="image/*">
  <button type="submit">Сохранить</button>
</form>
