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
        // Validações
        $validator = \Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'amount' => 'required|integer',
                'price' => 'required|integer'
            ],
            [
                'required' => 'O campo :attribute é necessário',
                'integer' => 'O Campo :attribute deve ser um numero'
            ]
        );

        // Retorna a mensagem de erro em formato json
        if ($validator->fails()) {
            return ['error' => $validator->errors()->all()];
        }

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
