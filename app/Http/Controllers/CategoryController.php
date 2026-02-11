<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /// GET /api/categories (es público)
    public function index() {
        return response()->json(Category::all(), 200);
    }

    // GET /api/categories/{id} (es público)
    public function show($id) {
        $category = Category::findOrFail($id);
        return response()->json($category, 200);
    }

    // POST /api/categories (token)
    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:categories', 'icon_path' => 'required']);
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    // PUT /api/categories/{id} (token)
    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category, 200);
    }

    // DELETE /api/categories/{id} (token)
    public function destroy($id) {
        Category::destroy($id);
        return response()->json(['message' => 'Categoría eliminada'], 200);
    }

    // GET /api/categories/{id}/exercises (es publico)
    public function exercises($id) {
        $category = Category::findOrFail($id);
        // Uso la relación definida en el modelo Category
        return response()->json($category->exercises, 200);
    }
}
