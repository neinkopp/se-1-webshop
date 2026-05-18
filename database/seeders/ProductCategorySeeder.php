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
            'category_id' => 1,
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
            'category_id' => 2,
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
            'category_id' => 3,
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
             
                ],
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
                ]
            ]
        ]);

        // Jacken
        ProductCategory::create([
            'category_id' => 4,
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
            'category_id' => 5,
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
            'category_id' => 6,
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