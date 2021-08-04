<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('sections.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('sections.products.card', compact('product'));
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        try {
            \Darryldecode\Cart\Facades\CartFacade::session(auth()->user()->id)->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => array(),
                'associatedModel' => $product
            ));
        }catch (\Exception $exception) {
            Log::error('Failed add product to cart ' . $exception->getMessage());
        }
        session()->flash('message', 'Товар добавлен в корзину');
        return redirect()->to(route('dashboard'));
    }

}
