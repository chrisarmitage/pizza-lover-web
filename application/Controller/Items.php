<?php

namespace Application\Controller;

use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;

class Items implements Controller
{
    protected $category = null;

    public function __construct(Request $request)
    {
        $params = $request->query->all();
        $this->category = $params['category'] ?? null;
    }

    public function dispatch()
    {
        switch ($this->category) {
            case 'Pizza':
                return [
                    [
                        'id' => 1,
                        'name' => 'Cheese',
                        'price' => 3.50,
                        'category' => 'Pizza',
                        'photo' => 'pizza-cheese.jpg',
                    ],
                    [
                        'id' => 2,
                        'name' => 'Ham',
                        'price' => 4.50,
                        'category' => 'Pizza',
                        'photo' => 'pizza-ham.png',
                    ],
                    [
                        'id' => 3,
                        'name' => 'Meat Feast',
                        'price' => 5.00,
                        'category' => 'Pizza',
                        'photo' => 'pizza-meat-feast.jpg',
                    ],
                ];
                break;
            case 'Sandwich':
                return [
                    [
                        'id' => 21,
                        'name' => 'Ham',
                        'price' => 3.50,
                        'category' => 'Sandwich',
                        'photo' => 'sandwich-ham.jpg',
                    ],
                    [
                        'id' => 22,
                        'name' => 'Tuna',
                        'price' => 4.50,
                        'category' => 'Sandwich',
                        'photo' => 'sandwich-tuna.jpg',
                    ],
                    [
                        'id' => 23,
                        'name' => 'Cheese',
                        'price' => 5.00,
                        'category' => 'Sandwich',
                        'photo' => 'sandwich-cheese.jpg',
                    ],
                ];
                break;
            case 'Salad':
                return [
                    [
                        'id' => 11,
                        'name' => 'Caesar Salad',
                        'price' => 3.50,
                        'category' => 'Salad',
                        'photo' => 'salad-caesar.jpg',
                    ],
                    [
                        'id' => 12,
                        'name' => 'Greek Salad',
                        'price' => 3.80,
                        'category' => 'Salad',
                        'photo' => 'salad-greek.jpg',
                    ],
                    [
                        'id' => 13,
                        'name' => 'Arabic Salad',
                        'price' => 3.90,
                        'category' => 'Pizza',
                        'photo' => 'salad-arabic.jpg',
                    ],
                ];
            default:
                return [];
        }
    }

}
