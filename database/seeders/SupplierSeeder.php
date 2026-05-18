<?php

namespace Database\Seeders;

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
            'supplier_name' => 'le_sserafim',
            'website' => 'Le.Sserafim.de',
            'email' => 'lesserafim@gmail.de',
            'telephone' => '+49 123 456789 1',
            'display_name' => 'Le Sserafim'
        ]);

         Supplier::create([
            'supplier_name' => 'aespa',
            'website' => 'Aespa.de',
            'email' => 'info@aespa.de',
            'telephone' => '+49 123 456789 2',
            'display_name' => 'Aespa'
        ]);
    }
}
