<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->paginate(5);
        return view('products.index',compact('products'));
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success','Product created successfully.');
    }

    public function show(Product $product): View
    {
        return view('products.show',compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('products.edit',compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }






}
