<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'image|file|required',
            'price' => 'required',
            'stock' => 'required|integer'
        ]);

        $validatedData['image'] = $request->file('image')->store('images/product');

        Product::create($validatedData);

        return redirect()->route('product.home')->with('added', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $product = Product::find($id);
        return view('pages.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $id)
    {
        $validation = [
            'name' => 'required',
            'image' => 'image|file',
            'price' => 'required',
            'stock' => 'required'
        ];

        $validatedData = $request->validate($validation);

        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('images/product');
        };

        Product::where('id', $id)->update($validatedData);

        return redirect()->route('product.home')->with('updated', 'Product updated successfully!');
    }

    public function updateStock(Request $request, $id)
    {
        $validatedData = $request->validate([
            'stock' => 'required|integer'
        ]);

        Product::where('id', $id)->update(['stock' => $validatedData['stock']]);

        return redirect()->route('product.home')->with('updated', 'Stock updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->transactions()->count() > 0) {
            return redirect()->back()->with('error', 'error');
        }

        $product->delete();
        return redirect()->back()->with('deleted', 'Product deleted successfully!');
    }
}
