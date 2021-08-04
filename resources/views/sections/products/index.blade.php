@extends('layouts.app')

@section('header')
    <h1>Витрина</h1>
@endsection

@section('slot')
    <div class="container" style="margin-top:30px;">
        <div class="row">
            @if(!empty($products))
                <div class="col-md-12">
                    @foreach($products as $product)
                        <div class="col-md-3 float-left card">
                            <a href="{{route('product.show', ['id' => $product->id])}}">
                                <span style="text-align: center;font-size: 32px;">{{$product->name}}</span>
                            </a>
                            <div>
                                <a href="{{route('product.show', ['id' => $product->id])}}">
                                    <img src="https://via.placeholder.com/350 " alt=""></div>
                                </a>
                            <div class="float-left">{{$product->description}}</div>
                            <div class="" style="text-align: right;">{{$product->price}}р.</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
