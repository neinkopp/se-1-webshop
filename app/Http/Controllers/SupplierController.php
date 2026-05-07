<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function getAllSuppliers(): array
    {
        $suppliers = Supplier::all();

        return compact('suppliers');
    }

    public function show(string $supplier_name)
    {
        $supplier = Supplier::where('supplier_name', '=', $supplier_name, true)->firstOrFail();

        return view('product', compact('supplier'));
    }
}
