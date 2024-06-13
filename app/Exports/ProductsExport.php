<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch your products data
        return Product::all();
    }

    public function headings(): array
    {
        // Define column headers
        return [
            'ID',
            'Name',
            'Category',
            'Price',
            // Add more headers as needed
        ];
    }
}
