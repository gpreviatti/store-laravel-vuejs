<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductController extends Controller
{
    public function list($id = null)
    {
        if ($id != null) {
            return Product::find($id);
        }
        return Product::all();
    }

    public function store(Request $request, $id = null)
    {
        if ($id != null) {
            $product = Product::find($id);
            $product->update($request->all());
        } else {
            $product = new Product();
            $product->fill($request->all())->save();
        }
        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return ['success' => true];
    }
}
