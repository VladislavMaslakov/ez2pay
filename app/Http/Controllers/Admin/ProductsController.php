<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{

    public function list()
    {
        $products = Product::where('seller_id', '=', auth()->user()->id)->get();
        return view('admin.products.index', compact('products'));
    }

    public function create() {
        return view('admin.products.create');
    }

    public function edit($id) {
        $product = Product::query()
                ->where('id', '=', $id)
                ->where('seller_id', '=', auth()->user()->id)
                ->first();
        if(!$product) {
            session()->flash('message', 'Товар не найден');
            return redirect()->to('admin/products/list');
        }

        return view('admin.products.edit', compact('product'));
    }

    public function destroy($id) {
        $product = Product::query()
            ->where('id', '=', $id)
            ->where('seller_id', '=', auth()->user()->id)
            ->first();
        if(!$product) {
            session()->flash('message', 'Товар не найден');
            return redirect()->to('admin/products/list');
        }
        try {
            $product->delete();
        }catch (\Exception $exception){
            Log::error("Error destroy product id ".$id." ".$exception->getMessage());
        }
        session()->flash('message', 'Товар успешно удален');
        return redirect()->to('admin/products/list');
    }

    public function store(ProductStoreRequest $request) {
        $product = new Product();
        $product->fill(array_merge($request->all(), ['seller_id' => auth()->user()->id]));
        try {
            $product->save();
        }catch (\Exception $exception){
            Log::error("Error on save new product ".$exception->getMessage());
        }
        session()->flash('message', 'Товар успешно добавлен');
        return redirect()->to('admin/products/list');
    }


    public function update(Request $request, $id)
    {
        $product = Product::query()
            ->where('id', '=', $id)
            ->where('seller_id', '=', auth()->user()->id)
            ->first();
        if(!$product) {
            session()->flash('message', 'Товар не найден');
            return redirect()->to('admin/products/list');
        }
        $product->fill(array_merge($request->all(), ['seller_id' => auth()->user()->id]));
        try {
            $product->save();
        }catch (\Exception $exception){
            Log::error("Error on update product ".$exception->getMessage());
        }
        session()->flash('message', 'Товар успешно изменен');
        return redirect()->to('admin/products/list');

    }

}
