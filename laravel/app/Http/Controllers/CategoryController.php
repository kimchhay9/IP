<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // --- Get /api/categories
    public function getCategories() {
        return response()->json(Category::all());
    }

    // --- Post /api/categories
    public function createCategory(Request $request) {
        $request->validate([
            'name' => 'required|string|unique:categories',
        ]);

        $category = Category::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Added successfully!',
            'category' => $category
        ], 201);
    }

    // --- Get /api/categories/{categoryId}
    public function getCategory($categoryId) {
        $category = Category::findOrFail($categoryId);
        return response()->json($category);
    }

    // --- Patch /api/categories/{categoryId}
    public function updateCategory(Request $request, $categoryId) {
        $category = Category::findOrFail($categoryId);

        $request->validate([
          'name' => 'required|string|unique:categories,name,' . $categoryId
        ]);
        
        $category->update([ 'name'=> $request->name ]);

        return response()->json([
          'message'=>'updated successfully',
          'category'=>$category
        ]);
    }

    // --- Delete /api/categories/{categoryId}
    public function deleteCategory($categoryId) {
        $category = Category::findOrFail($categoryId);
        $category->delete();

        return response()->json(['message' => 'Deleted successfully!']);
    }
}
