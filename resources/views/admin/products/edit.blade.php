@extends('layouts.app')

@section('header')
    <div class="row">
        <h1>Изменение товара</h1>
    </div>
@endsection

@section('slot')
    <div class="container" style="margin-top: 130px;">
        {{ Form::open(array('id' => 'main-form', 'url' => route('products.update', ['product' => $product->id]), 'method' => 'PUT')) }}
        <div class="form-group form-group-sm">
            {{ Form::label('name', 'Название', ['class' => 'required']) }}
            {{ Form::text('name', $product->name, array('class' => 'form-control', 'required' => 'required')) }}
        </div>
        <div class="form-group form-group-sm">
            {{ Form::label('price', 'Цена', ['class' => 'required']) }}
            {{ Form::text('price', $product->price, array('class' => 'form-control', 'required' => 'required')) }}
        </div>
        <div class="form-group form-group-sm">
            {{ Form::label('description', 'Описание', ['class' => 'required']) }}
            {{ Form::textarea('description', $product->description, array('class' => 'form-control', 'required' => 'required')) }}
        </div>
        {{ Form::submit('Сохранить', array('class' => 'btn btn-primary')) }}
        <input type="hidden" id="redirect_to_show" name="redirect_to_show" value="0" />
        {{ Form::button('Отмена', ['class' => 'btn btn-default', 'onclick' => 'history.back()']) }}
        {{ Form::close() }}
    </div>
    </div>
@endsection
