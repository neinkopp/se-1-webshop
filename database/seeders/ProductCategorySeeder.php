<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        // T-Shirts (bestehend)
        ProductCategory::create([
            'name' => 'T-Shirts',
            'filters' => [
                'color' => [
                    'displayName' => 'Farbe',
                    'type' => 'color'
                ],
                'size' => [
                    'displayName' => 'Größe',
                    'type' => 'select'
                ],
                'material' => [
                    'displayName' => 'Material',
                    'type' => 'select'
                ],
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
                ]
            ]
        ]);
  ProductCategory::create([
            'name' => 'Hoodies',
            'filters' => [
                'color' => [
                    'displayName' => 'Farbe',
                    'type' => 'color'
                ],
                'size' => [
                    'displayName' => 'Größe',
                    'type' => 'select'
                ],
                'material' => [
                    'displayName' => 'Material',
                    'type' => 'select'
                ],
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
                ]
            ]
        ]);
    
      
        // Schuhe
        ProductCategory::create([
            'name' => 'Schuhe',
            'filters' => [
                'color' => [
                    'displayName' => 'Farbe',
                    'type' => 'color',
                ],
                'shoe_size' => [
                    'displayName' => 'Schuhgröße',
                    'type' => 'select'
                ],
             
               
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
                ]
            ]
        ]);

        // Jacken
        ProductCategory::create([
            'name' => 'Jacken',
            'filters' => [
                'color' => [
                    'displayName' => 'Farbe',
                    'type' => 'color'
                ],
                'size' => [
                    'displayName' => 'Größe',
                    'type' => 'select'
               
                ],
               
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
                ]
            ]
        ]);

        // Taschen (haben keine Größen im klassischen Sinne)
        ProductCategory::create([
            'name' => 'Taschen',
            'filters' => [
                'color' => [
                    'displayName' => 'Farbe',
                    'type' => 'color'
                ],
                'material' => [
                    'displayName' => 'Material',
                    'type' => 'select'
                ],
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
                ]
            ]
       
      ]); 
      ProductCategory::create([
            'name' => 'Kartenspiel',
            'filters' => [
                
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
                ]
            ]
        ]);
         
        
    
    }
}