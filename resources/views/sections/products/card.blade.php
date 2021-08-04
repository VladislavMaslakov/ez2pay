@extends('layouts.app')

@section('header')
    <h1>Витрина</h1>
@endsection

@section('slot')
    <div class="container" style="margin-top:30px;">
        <div class="row">
                <div class="col-md-12">
                        <div class="col-md-12 card">
                            <span style="text-align: center;font-size: 32px;">{{$product->name}}</span>
                            <div>
                                <img src="https://via.placeholder.com/550" alt="">
                            </div>
                            <div class="float-left">{{$product->description}}</div>
                            <div class="" style="text-align: right;">{{$product->price}}р.</div>
                        </div>
                    <a href="{{route('product.add_to_cart', ['id' => $product->id])}}" class="btn btn-danger float-right">Добавить в корзину</a>
                </div>
        </div>
    </div>
@endsection
