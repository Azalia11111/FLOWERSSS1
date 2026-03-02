<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flower;
use App\Models\Category;

use Illuminate\Support\Facades\Storage;

class FlowerController extends Controller
{

    public function index()
    {
        $flowers = Flower::with('category')->latest()->get();
        $categories = Category::orderBy('name')->get(); // для формы добавления (если админ)
        return view('flowers.index', compact('flowers', 'categories'));
    }

    // (можно использовать, но не обязательно)
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('flowers.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:4096',
            'description' => 'nullable|string',
           
'category_id' => 'required|exists:categories,id',

        ]);

        $path = $request->file('image')->store('', 'public');

        Flower::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image_path' => $path,
            'description' => $validated['description'] ?? '',
         
'category_id' => $validated['category_id'] ?? null,

        ]);

        return redirect()->route('flowers.index')->with('success', 'Цветок успешно добавлен');
    }

    public function edit(Flower $flower)
    {
        $categories = Category::orderBy('name')->get();
        return view('flowers.edit', compact('flower', 'categories'));
    }

    
public function update(Request $request, Flower $flower)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($flower->image_path) {
            Storage::disk('public')->delete($flower->image_path);
        }
         $validated['image_path'] = $request->file('image')->store('', 'public');
    }

    $flower->update([
        'name' => $validated['name'],
       
'category_id' => $validated['category_id'] ?? null,

        'price' => $validated['price'],
        'description' => $validated['description'] ?? '',
        'image_path' => $validated['image_path'] ?? $flower->image_path,
    ]);

    return redirect()->route('flowers.index')->with('success', 'Цветок успешно обновлён');
}


    public function destroy(Flower $flower)
    {
        if ($flower->image_path && Storage::disk('public')->exists($flower->image_path)) {
            Storage::disk('public')->delete($flower->image_path);
        }

        $flower->delete();

        return redirect()->route('flowers.index')->with('success', 'Цвет успешно удалён');
    }
}