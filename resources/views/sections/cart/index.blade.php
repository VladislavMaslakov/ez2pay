@extends('layouts.app')

@section('header')
    <h1>Корзина</h1>
@endsection

@section('slot')
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Название</th>
        <th>Количество</th>
        <th>Цена</th>
    </tr>
    </thead>

    <tbody>
    <?php
    $items = \Darryldecode\Cart\Facades\CartFacade::session(auth()->user()->id)->getContent();
    foreach($items as $row) :?>
        <tr>
            <td>
                <p><strong>{{$row->name}}</strong></p>
            </td>
            <td>{{$row->quantity}}</td>
            <td>{{$row->price * $row->quantity }}</td>
        </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="2">Итого</td>
        <td>
            {{\Darryldecode\Cart\Facades\CartFacade::session(auth()->user()->id)->getTotal()}}
        </td>
    </tr>
    </tbody>

</table>
@endsection
