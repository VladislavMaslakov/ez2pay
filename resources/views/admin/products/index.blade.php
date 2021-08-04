@extends('layouts.app')

@section('header')
    <h1>Ваши Товары</h1>
    <a href="/admin/products/create" class="btn btn-success">Добавить</a>
@endsection

@section('slot')
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-12">
                @if(count($products))
                    <table class="table table-bordered">
                        <tr>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Описание</th>
                            <th></th>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->description}}</td>
                                <td width="60">
                                    <a href="{{route('products.edit', ['product' => $product->id])}}" class="float-left">
                                        <img src="https://icon-library.com/images/edit-icon-online/edit-icon-online-14.jpg" width="20" title="Редактировать">
                                    </a>
                                    <form id="destroy-form" action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                                        @method('DELETE')
                                            <button type="submit">
                                                <img src="https://cdn0.iconfinder.com/data/icons/communication-solid-set/512/cloud-minus-2_Communication_solid_A-512.png" width="20" alt="Удалить">
                                            </button>
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h2>Вы не добавили не одного товара</h2>
                @endif
            </div>
        </div>
    </div>
@endsection
