<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{

    public function checkout()
    {
        $products = \Darryldecode\Cart\Facades\CartFacade::session(auth()->user()->id)->getContent();
        try {
            Mail::send(
                'emails.order',
                [
                    'title' => 'Ez2Pay | Новый заказ',
                    'msg'   => $products
                ], function ($mail){
                $mail->to(auth()->user()->email)->subject('Ez2Pay | Оформлен заказ');
            });
        }catch (\Exception $exception) {
            Log::error('Failed add product to cart ' . $exception->getMessage());
        }
        \Darryldecode\Cart\Facades\CartFacade::session(auth()->user()->id)->clear();
        session()->flash('message', 'Заказ оформлен');
        return redirect()->to(route('dashboard'));
    }

}
