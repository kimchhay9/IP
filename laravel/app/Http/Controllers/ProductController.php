<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Get /api/products
    public function getProducts()
    {
        return response()->json(Product::all());
    }

    // Post /api/products
    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'pricing' => 'required|numeric',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'pricing' => $request->pricing,
            'description' => $request->description,
            'images' => $request->images,
        ]);

        return response()->json([
            'message' => 'Product added successfully!',
            'product' => $product
        ], 201);
    }

    // Patch /api/products/{productId}
    public function updateProduct(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'pricing' => 'required|numeric',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
        ]);

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'pricing' => $request->pricing,
            'description' => $request->description,
            'images' => $request->images,
        ]);

        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product
        ]);
    }

    // Delete /api/products/{productId}
    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return response()->json([
            'message' => 'Delete successful!',
            'id' => $productId
        ]);
    }
}
