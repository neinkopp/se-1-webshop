<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
//Mertens Shirt
            Product::create([
                'id' => fake()->uuid(),
                'category_id' => '1',
                'supplier_name' => "le_sserafim",
                'name' => "Mertens-Shirt",
                'handle' => "mertens_shirt",
                'description' => "Ein schlichtes Tshirt mit dem Aufdruck Ihres Lieblingsprofessoren. Schlicht, bequem und dennoch schick, 100% Baumwolle, perfekt für die nächste Vorlesung!",
                'price' => fake()->numberBetween(29,30),
                'attributes' => [
                    'default_pictures' => [
                        [
                            'picture_storage_key' => "Mertens-Shirt-Weiß-Vorne.png"
                        ],
                        [
                            'picture_storage_key' => "BHH-Shirt-Weiß-Hinten.png"
                        ],
                        [
                            'picture_storage_key' => "Mertens-Shirt-Schwarz-Vorne.png"
                        ],
                        [
                            'picture_storage_key' => "BHH-Shirt-Schwarz-Hinten.png"
                        ]
                    ],
                    'assets' => [
                        [
                            "asset_storage_key" => "designmertens.jpg",
                            "position" => "front"
                        ],
                        [
                            "asset_storage_key" => "BHH-Logo",
                            "position" => "back"
                        ]
                    ],
                   'properties' => [
                    'color' => [
                        [
                            'displayName' => 'weiß',
                            'value' => '#ffffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Shirt-Weiß-Vorne.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000ff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Shirt-Schwarz-Hinten.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                       
                    ],
                        'size' => ['XL', 'L', 'M','S'],
                        'material' => ['Baumwolle'],
                        'print' => ['Prof. Mertens']
                    ]
                ]
            ]);
//BHH Shirt
             Product::create([
                'id' => fake()->uuid(),
                'category_id' => '1',
                'supplier_name' => "le_sserafim",
                'name' => "BHH-Shirt",
                'handle' => "bhh_shirt",
                'description' => "Ein schlichtes Tshirt mit dem Aufdruck Ihrer Lieblingshochschule. Schlicht, bequem und dennoch schick, 100% Baumwolle, perfekt für die nächste Vorlesung!",
                'price' => fake()->numberBetween(29,30),
                'attributes' => [
                    'default_pictures' => [
                        [
                            'picture_storage_key' => "BHH-Shirt-Weiß-Vorne.png"
                        ],
                        [
                            'picture_storage_key' => "BHH-Shirt-Weiß-Hinten.png"
                        ],
                        [
                            'picture_storage_key' => "BHH-Shirt-Schwarz-Vorne.png"
                        ],
                        [
                            'picture_storage_key' => "BHH-Shirt-Schwarz-Hinten.png"
                        ]
                    ],
                    'assets' => [
                        [
                            "asset_storage_key" => "BHH-Kreuz",
                            "position" => "front"
                        ],
                        [
                            "asset_storage_key" => "BHH-Logo",
                            "position" => "back"
                        ]
                    ],
                   'properties' => [
                    'color' => [
                        [
                            'displayName' => 'weiß',
                            'value' => '#ffffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Shirt-Weiß-Vorne.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000ff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Shirt-Schwarz-Hinten.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                       
                    ],
                        'size' => ['XL', 'L', 'M','S'],
                        'material' => ['Baumwolle'],
                        'print' => ['BHH']
                    ]
                ]
            ]);
       

        
//Mertens Hoodie
         Product::create([
            'id' => fake()->uuid(),
            'category_id' => '2',
            'supplier_name' => "le_sserafim",
            'name' => "Mertens-Hoodie",
            'handle' => "mertens_hoodie",
            'description' => "Angenehm warmer kuscheliger Baumwollhoodie mit Aufdruck Ihres Lieblingsprofessoren. Für alle, die im Winter die Vorlesungen überstehen möchten!",
            'price' => fake()->numberBetween(29,30),
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "Mertens-Hoodie-Weiß-Vorne.png"
                    ],
                    [
                        'picture_storage_key' => "Mertens-Hoodie-Schwarz-Vorne.png"
                    ],
                    [
                        'picture_storage_key' => "BHH-Hoodie-Weiß-Hinten.png"
                    ],
                    [
                        'picture_storage_key' => "BHH-Hoodie-Schwarz-Hinten.png"
                    ]
                ],
                'assets' => [
                    [
                    "asset_storage_key" => "designmertens.jpg",
                    "position" => "front"
                    ],
                    [
                    "asset_storage_key" => "BHH-Logo",
                    "position" => "back"
                    ]
                ],
               'properties' => [
                    'color' => [
                        [
                            'displayName' => 'weiß',
                            'value' => '#ffffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Hoodie-Weiß-Vorne.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000ff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Hoodie-Schwarz-Vorne.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                       
                    ],
                    'size' => ['XL', 'L', 'M','S'],
                    'material' => ['Baumwolle', 'Leinen', 'Viskose'],
                    'print' => ['Prof. Mertens']
                ]
            ]
        ]);

//BHH Hoodie
        Product::create([
            'id' => fake()->uuid(),
            'category_id' => '2',
            'supplier_name' => "le_sserafim",
            'name' => "BHH-Hoodie",
            'handle' => "bhh_hoodie",
            'description' => "Angenehm warmer kuscheliger Baumwollhoodie mit Aufdruck Ihrer Hochschule. Wie cool! Für alle, die im Winter die Vorlesungen überstehen möchten!",
            'price' => fake()->numberBetween(29,30),
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "BHH-Hoodie-Weiß-Vorne.png"
                    ],
                    [
                        'picture_storage_key' => "BHH-Hoodie-Weiß-Hinten.png"
                    ],
                    [
                        'picture_storage_key' => "BHH-Hoodie-Schwarz-Vorne.png"
                    ],
                    [
                        'picture_storage_key' => "BHH-Hoodie-Schwarz-Hinten.png"
                    ]
                ],
                'assets' => [
                    [
                    "asset_storage_key" => "BHH-Kreuz.png",
                    "position" => "front"
                    ],
                    [
                    "asset_storage_key" => "BHH-Logo.png",
                    "position" => "back"
                    ]
                ],
                'properties' => [
                    'color' => [
                        [
                            'displayName' => 'weiß',
                            'value' => '#ffffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Hoodie-Weiß-Vorne.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000ff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Hoodie-Schwarz-Vorne.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                       
                    ],
                    'size' => ['XL', 'L', 'M', 'S'],
                    'material' => ['Baumwolle', 'Leinen', 'Viskose'],
                    'print' => ['BHH']
                ]
            ]
        ]);
//Tasche Mertens
        Product::create([
            'id' => fake()->uuid(),
            'category_id' => '5',
            'supplier_name' => "aespa",
            'name' => "Mertens-Tasche",
            'handle' => "mertens_tasche",
            'description' => "Wer bei dieser Stofftasche nicht neidisch wird, dem ist auch nicht mehr zu helfen! Ob Einkauf, Bücherabgabe oder Handgepäck, diese Tasche ist für jegliche Aufgabe genau richtig.",
            'price' => fake()->numberBetween(29,30),
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "Mertens-Tasche-Weiß.png"
                    ],
                    [
                        'picture_storage_key' => "Mertens-Tasche-Schwarz.png"
                    ],
                    [
                        'picture_storage_key' => "Mertens-Tasche-Blau.png"
                    ],
                 
                ],
                'assets' => [
                    [
                    "asset_storage_key" => "designmertens.jpg",
                    "position" => "front"
                    ]
                ],
                'properties' => [
                    'color' => [
                        [
                            'displayName' => 'weiß',
                            'value' => '#ffffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Tasche-Weiß.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000ff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Tasche-Schwarz.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                        [
                            'displayName' => 'blau',
                            'value' => '#20157aff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Tasche-Blau.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                       
                    ],
        
                    'material' => ['Baumwolle', 'Leinen', 'Viskose'],
                    'print' => ['Prof. Mertens']
                ]
            ]
        ]);

//Tasche BHH
     Product::create([
            'id' => fake()->uuid(),
            'category_id' => '5',
            'supplier_name' => "aespa",
            'name' => "BHH-Tasche",
            'handle' => "bhh_tasche",
            'description' => "Wer bei dieser Stofftasche nicht neidisch wird, dem ist auch nicht mehr zu helfen! Ob Einkauf, Bücherabgabe oder Handgepäck, diese Tasche ist für jegliche Aufgabe genau richtig.",
            'price' => fake()->numberBetween(29,30),
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "BHH-Tasche-Weiß.png"
                    ],
                    [
                        'picture_storage_key' => "BHH-Tasche-Schwarz.png"
                    ],
                    [
                        'picture_storage_key' => "BHH-Tasche-Blau.png"
                    ],
                 
                ],
                'assets' => [
                    [
                    "asset_storage_key" => "BHH_Logo.png",
                    "position" => "front"
                    ]
                ],
                'properties' => [
                    'color' => [
                        [
                            'displayName' => 'weiß',
                            'value' => '#ffffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Tasche-Weiß.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000ff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Tasche-Schwarz.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                        [
                            'displayName' => 'blau',
                            'value' => '#20157aff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Tasche-Blau.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                       
                    ],
        
                    'material' => ['Baumwolle', 'Leinen', 'Viskose'],
                    'print' => ['BHH']
                ]
            ]
        ]);

//Kartenspiel Mertens
         Product::create([
            'id' => fake()->uuid(),
            'category_id' => '6',
            'supplier_name' => "aespa",
            'name' => "Mertens-Kartenspiel",
            'handle' => "mertens_kartenspiel",
            'description' => "Dieses Kartendeck im Professorendesign ist ein MUSS für jeden Studenten. In der Pause mit dem Professoren ein Ründchen spielen hat noch niemandem geschadet. Mit Glück kommt man auch in der Vorlesung mit durch 😉",
            'price' => fake()->numberBetween(29,30),
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "Mertens-Kartenspiel.png"
                    ],
                   
                ],
                'assets' => [
                    [
                    "asset_storage_key" => "designmertens.jpg",
                    "position" => "back"
                    ]
                ],
               'properties' => [
                    
                    'kartenspieltyp' => ['Uno', 'Skat'],
                    'print' => ['Prof. Mertens']
                ]
            ]
        ]);

//Kartenspiel BHH        
         Product::create([
            'id' => fake()->uuid(),
            'category_id' => '6',
            'supplier_name' => "aespa",
            'name' => "BHH-Kartenspiel",
            'handle' => "bhh_kartenspiel",
            'description' => "Dieses Kartendeck im BHH ist ein MUSS für jeden Studenten. In der Pause mit dem Professoren ein Ründchen spielen hat noch niemandem geschadet. Mit Glück kommt man auch in der Vorlesung mit durch 😉",
            'price' => fake()->numberBetween(29,30),
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "BHH-Kartenspiel.png"
                    ],
                  
                    
                ],
                'assets' => [
                    [
                    "asset_storage_key" => "BHH_Logo.png",
                    "position" => "back"
                    ]
                ],
               'properties' => [
                  
                    'kartenspieltyp' => ['Uno', 'Skat'],
                    'print' => ['BHH']
                ]
            ]
        ]);
//Mertens Schuhe
         Product::create([
            'id' => fake()->uuid(),
            'category_id' => '3',
            'supplier_name' => "aespa",
            'name' => "Mertens-Sneaker",
            'handle' => "mertens_sneaker",
            'description' => "Schuhe",
            'price' => fake()->numberBetween(29,30),
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "Mertens-Sneaker-Weiß.png"
                    ],
                 
                ],
                'assets' => [
                    [
                    "asset_storage_key" => "designmertens.jpg",
                    "position" => "back"
                    ]
                ],
               'properties' => [
                    'color' => [
                        [
                            'displayName' => 'weiß',
                            'value' => '#ffffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Sneaker-Weiß.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                       
                       
                    ],
                    'shoe_size' => ['41', '40', '39'],
                    'material' => ['Baumwolle', 'Leinen', 'Viskose'],
                    'print' => ['Prof.Mertens']
                ]
            ]
        ]);

//BHH Schuhe
         Product::create([
            'id' => fake()->uuid(),
            'category_id' => '3',
            'supplier_name' => "aespa",
            'name' => "BHH-Sneaker",
            'handle' => "bhh_sneaker",
            'description' => "Schuhe",
            'price' => fake()->numberBetween(29,30),
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "BHH_Sneaker-Weiß.png"
                    ],
                 
                    
                ],
                'assets' => [
                    [
                    "asset_storage_key" => "BHH_Logo.png",
                    "position" => "back"
                    ]
                ],
               'properties' => [
                    'color' => [
                        [
                            'displayName' => 'weiß',
                            'value' => '#ffffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH_Sneaker-Weiß.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                      
                    ],
                    'shoe_size' => ['41', '40', '39'],
                    'material' => ['Baumwolle', 'Leinen', 'Viskose'],
                    'print' => ['BHH']
                ]
            ]
        ]);

//Mertens Jacken
        Product::create([
            'id' => fake()->uuid(),
            'category_id' => '4',
            'supplier_name' => "le_sserafim",
            'name' => "Mertens-Jacke",
            'handle' => "mertens_jacke",
            'description' => "Jacke",
            'price' => fake()->numberBetween(29,30),
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "Mertens-Jacke-Schwarz.png"
                    ],
                    [
                        'picture_storage_key' => "Mertens-Jacke-Blau.png"
                    ],
                ],
                'assets' => [
                    [
                    "asset_storage_key" => "designmertens.jpg",
                    "position" => "front"
                    ]
                ],
                'properties' => [
                    'color' => [
                        [
                            'displayName' => 'blau',
                            'value' => '#130f47ff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Jacke-Blau.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000ff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Jacke-Schwarz.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                       
                    ],
                    'size' => ['XL', 'L', 'M', 'S'],
                    'print' => ['Mertens']
                ]
            ]
        ]);

//BHH Jacken
        Product::create([
            'id' => fake()->uuid(),
            'category_id' => '4',
            'supplier_name' => "le_sserafim",
            'name' => "BHH-Jacke",
            'handle' => "bhh_jacke",
            'description' => "Jacke",
            'price' => fake()->numberBetween(29,30),
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "BHH-Jacke-Blau.png"
                    ],
                    [
                        'picture_storage_key' => "BHH-Jacke-Schwarz.png"
                    ],
                    
                ],
                'assets' => [
                  
                    [
                    "asset_storage_key" => "BHH_Logo_Weiß",
                    "position" => "front"
                    ]
                ],
                'properties' => [
                    'color' => [
                        [
                            'displayName' => 'blau',
                            'value' => '#130f47ff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Jacke-Blau.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000ff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Jacke-Schwarz.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                       
                    ],
                    'size' => ['XL', 'L', 'M', 'S'],
                    'print' => ['Mertens']
                ]
            ]
        ]);
    }
    }

