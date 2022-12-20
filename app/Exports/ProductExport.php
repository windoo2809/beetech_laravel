<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select(
            'id',
            'name',
            'stock',
            'category_id',
            'expired_at'
        )->get();
    }

    public function heading():array{
        return [
            'ID',
            'Name',
            'Stock',
            'Category ID',
            'Expired At'
        ];
    }
}
