<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{

    protected $repository;


    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function list()
    {
        $products = $this->repository->getAll();
        return view('admin.products.index', compact('products'));
    }

    public function create() {
        return view('admin.products.create');
    }

    public function edit($id) {
        $product = $this->repository->getOneById($id);
        if(!$product) {
            session()->flash('message', 'Товар не найден');
            return redirect()->to('admin/products/list');
        }

        return view('admin.products.edit', compact('product'));
    }

    public function destroy($id) {
        try {
            $this->repository->delete($id);
        }catch (\Exception $exception){
            Log::error("Error destroy product id ".$id." ".$exception->getMessage());
        }
        session()->flash('message', 'Товар успешно удален');
        return redirect()->to('admin/products/list');
    }

    public function store(ProductStoreRequest $request) {
        try {
            $this->repository->create(array_merge($request->all(), ['seller_id' => auth()->user()->id]));
        }catch (\Exception $exception){
            Log::error("Error on create new product ".$exception->getMessage());
        }
        session()->flash('message', 'Товар успешно добавлен');
        return redirect()->to('admin/products/list');
    }


    public function update(Request $request, $id)
    {
        $product = $this->repository->getOneById($id);
        if(!$product) {
            session()->flash('message', 'Товар не найден');
            return redirect()->to('admin/products/list');
        }
        try {
            $this->repository->update(array_merge($request->all(), ['seller_id' => auth()->user()->id]), $id);
        }catch (\Exception $exception){
            Log::error("Error on update product ".$exception->getMessage());
        }
        session()->flash('message', 'Товар успешно изменен');
        return redirect()->to('admin/products/list');

    }

}
