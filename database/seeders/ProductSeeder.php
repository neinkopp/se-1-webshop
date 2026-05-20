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
                'price' => 29.99,
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
                            "asset_storage_key" => "BHH-Logo.png",
                            "position" => "back"
                        ]
                    ],
                   'properties' => [
                    'color' => [
                        [
                            'displayName' => 'weiß',
                            'value' => '#ffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Shirt-Weiß-Vorne.png"
                                ],
                                [
                                    'picture_storage_key' => "BHH-Shirt-Weiß-Hinten.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Shirt-Schwarz-Vorne.png"
                                ],
                                [
                                    'picture_storage_key' => "BHH-Shirt-Schwarz-Hinten.png"
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
                'price' => 29.99,
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
                            'value' => '#ffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Shirt-Weiß-Vorne.png"
                                ],
                                [
                                    'picture_storage_key' => "BHH-Shirt-Weiß-Hinten.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Shirt-Schwarz-Vorne.png"
                                ],
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
            'price' => 39.99,
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
                    "asset_storage_key" => "BHH-Logo.png",
                    "position" => "back"
                    ]
                ],
               'properties' => [
                    'color' => [
                        [
                            'displayName' => 'weiß',
                            'value' => '#ffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Hoodie-Weiß-Vorne.png"
                                ],
                                [
                                    'picture_storage_key' => "BHH-Hoodie-Weiß-Hinten.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Hoodie-Schwarz-Vorne.png"
                                ],
                                [
                                    'picture_storage_key' => "BHH-Hoodie-Schwarz-Hinten.png"
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
            'price' => 39.99,
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
                            'value' => '#ffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Hoodie-Weiß-Vorne.png"
                                ],
                                [
                                    'picture_storage_key' => "BHH-Hoodie-Weiß-Hinten.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Hoodie-Schwarz-Vorne.png"
                                ],
                                [
                                    'picture_storage_key' => "BHH-Hoodie-Schwarz-Hinten.png"
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
            'price' => 49.99,
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
                            'value' => '#ffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Tasche-Weiß.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Tasche-Schwarz.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                        [
                            'displayName' => 'blau',
                            'value' => '#20157a',
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
            'price' => 49.99,
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
                            'value' => '#ffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Tasche-Weiß.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Tasche-Schwarz.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                        [
                            'displayName' => 'blau',
                            'value' => '#20157a',
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
            'price' => 9.99,
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
                    
                    'Kartenspieltyp' => ['Skat'],
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
            'price' => 9.99,
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
                  
                    'Kartenspieltyp' => ['Skat'],
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
            'description' => "Sneaker mit unendlich Drip! Mit diesem Prachtexemplar sind Sie nicht nur der Hit auf dem Campus sondern auch im Alltag. Und nebenbei sind sie auch noch bequem, ein Traum!",
            'price' => 69.99,
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
                   'shoe_size' => ['45','44','43','42','41', '40', '39','38'],
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
            'description' => "Sneaker mit unendlich Drip! Mit diesem Prachtexemplar sind Sie nicht nur der Hit auf dem Campus sondern auch im Alltag. Und nebenbei sind sie auch noch bequem, ein Traum!",
            'price' => 69.99,
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "BHH-Sneaker-Weiß.png"
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
                            'value' => '#ffffff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Sneaker-Weiß.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                      
                    ],
                    'shoe_size' => ['45','44','43','42','41', '40', '39','38'],
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
            'description' => "Diese wetterfeste Jacke bringt Sie bei jedem Wetter sicher in Ihre nächste Vorlesung! Regen ist ab sofort keine Ausrede mehr!",
            'price' => 69.99,
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
                            'value' => '#130f47',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "Mertens-Jacke-Blau.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000',
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
            'description' => "Diese wetterfeste Jacke bringt Sie bei jedem Wetter sicher in Ihre nächste Vorlesung! Regen ist ab sofort keine Ausrede mehr!",
            'price' => 69.99,
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
                    "asset_storage_key" => "BHH_Logo_Weiß.png",
                    "position" => "front"
                    ]
                ],
                'properties' => [
                    'color' => [
                        [
                            'displayName' => 'blau',
                            'value' => '#130f47',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Jacke-Blau.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'schwarz',
                            'value' => '#000000',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "BHH-Jacke-Schwarz.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                       
                    ],
                    'size' => ['XL', 'L', 'M', 'S'],
                    'print' => ['BHH']
                ]
            ]
        ]);
         Product::create([
                'id' => fake()->uuid(),
                'category_id' => '1',
                'supplier_name' => "le_sserafim",
                'name' => "AStA-Shirt",
                'handle' => "asta_shirt",
                'description' => "Ein schlichtes Tshirt mit dem Aufdruck des AStAs. Schlicht, bequem und dennoch schick, 100% Baumwolle, perfekt für die nächste Vorlesung!",
                'price' => 29.99,
                'attributes' => [
                    'default_pictures' => [
                        [
                            'picture_storage_key' => "asta-Shirt-Blau-Vorne.png"
                        ],
                        [
                            'picture_storage_key' => "asta-Shirt-Blau-Hinten.png"
                        ],
                        [
                            'picture_storage_key' => "asta-Shirt-Rot-Vorne.png"
                        ],
                        [
                            'picture_storage_key' => "asta-Shirt-Rot-Hinten.png"
                        ]
                    ],
                    'assets' => [
                        [
                            "asset_storage_key" => "asta-logo.png",
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
                            'displayName' => 'blau',
                            'value' => '#2c0866',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "asta-Shirt-Blau-Vorne.png"
                                ],
                                [
                                    'picture_storage_key' => "asta-Shirt-Blau-Hinten.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'rot',
                            'value' => '#c20d0d',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "asta-Shirt-Rot-Vorne.png"
                                ],
                                [
                                    'picture_storage_key' => "asta-Shirt-Rot-Hinten.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                       
                    ],
                        'size' => ['XL', 'L', 'M','S'],
                        'material' => ['Baumwolle'],
                        'print' => ['AStA']
                    ]
                ]
            ]);

             Product::create([
                'id' => fake()->uuid(),
                'category_id' => '2',
                'supplier_name' => "le_sserafim",
                'name' => "AStA-Hoodie",
                'handle' => "asta_hoodie",
                'description' => "Angenehm warmer kuscheliger Baumwollhoodie mit Aufdruck des AStAs. Wie cool! Für alle, die im Winter die Vorlesungen überstehen möchten!",
                'price' => 39.99,
                'attributes' => [
                    'default_pictures' => [
                        [
                            'picture_storage_key' => "asta-Hoodie-Blau-Vorne.png"
                        ],
                        [
                            'picture_storage_key' => "asta-Hoodie-Blau-Hinten.png"
                        ],
                        [
                            'picture_storage_key' => "asta-Hoodie-Rot-Vorne.png"
                        ],
                        [
                            'picture_storage_key' => "asta-Hoodie-Rot-Hinten.png"
                        ]
                    ],
                    'assets' => [
                        [
                            "asset_storage_key" => "asta-logo.png",
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
                            'displayName' => 'blau',
                            'value' => '#2c0866',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "asta-Hoodie-Blau-Vorne.png"
                                ],
                                [
                                    'picture_storage_key' => "asta-Hoodie-Blau-Hinten.png"
                                ]
                            ],
                            'externalId' => 'asduashkwda'
                        ],
                        [
                            'displayName' => 'rot',
                            'value' => '#c20d0d',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "asta-Hoodie-Rot-Vorne.png"
                                ],
                                [
                                    'picture_storage_key' => "asta-Hoodie-Rot-Hinten.png"
                                ]
                            ],
                            'externalId' => 'asduawhkdaa'
                        ],
                       
                    ],
                        'size' => ['XL', 'L', 'M','S'],
                        'material' => ['Baumwolle'],
                        'print' => ['AStA']
                    ]
                ]
            ]);
    }
    }

