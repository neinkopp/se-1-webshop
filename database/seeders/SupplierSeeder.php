<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'supplier_name' => 'mock_supplier_1',
            'website' => 'supplier_1.de',
            'email' => 'supplier1@mock.de',
            'telephone' => '+49 123 456789 1',
            'display_name' => 'Mock Supplier 1 GmbH'
        ]);
    }
}
