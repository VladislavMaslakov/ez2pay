<?php

namespace App\Repositories;


use App\Models\Product;

class ProductRepository extends AbstractRepository
{

    public function getModelClass(): string
    {
        return Product::class;
    }


}
