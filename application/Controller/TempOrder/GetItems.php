<?php

declare(strict_types=1);

namespace Application\Controller\TempOrder;

use Application\Repository\BasketLineDatastore;
use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;

class GetItems implements Controller
{
    protected $mobile;

    /**
     * @var BasketLineDatastore
     */
    protected $basketLineDatastore;

    /**
     * @param Request             $request
     * @param BasketLineDatastore $basketLineDatastore
     */
    public function __construct(Request $request, BasketLineDatastore $basketLineDatastore)
    {
        $params = $request->query->all();
        $this->mobile = $params['mobile'] ?? 'n/a';

        $this->basketLineDatastore = $basketLineDatastore;
    }

    public function dispatch()
    {
        $basketLines = $this->basketLineDatastore->findByMobile($this->mobile);

        if (count($basketLines) === 0) {
            return [
                'success' => false,
            ];
        }

        $items = [];
        foreach ($basketLines as $basketLine) {
            foreach ($this->getItems() as $item) {
                if ($item['id'] == $basketLine->getItemId()) {
                    $items[] = [
                        'id' => $basketLine->getItemId(),
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'qty' => $basketLine->getQuantity(),
                        'mobile' => $basketLine->getMobile(),
                    ];
                }
            }

        }

        return [
            'success' => true,
            'items'  => $items,
        ];
    }

    protected function getItems()
    {
        return [
            [
                'id'       => 1,
                'name'     => 'Cheese',
                'price'    => 3.50,
                'category' => 'Pizza',
                'photo'    => 'pizza-cheese.jpg',
            ],
            [
                'id'       => 2,
                'name'     => 'Ham',
                'price'    => 4.50,
                'category' => 'Pizza',
                'photo'    => 'pizza-ham.png',
            ],
            [
                'id'       => 3,
                'name'     => 'Meat Feast',
                'price'    => 5.00,
                'category' => 'Pizza',
                'photo'    => 'pizza-meat-feast.jpg',
            ],
            [
                'id'       => 21,
                'name'     => 'Ham',
                'price'    => 3.50,
                'category' => 'Sandwich',
                'photo'    => 'sandwich-ham.jpg',
            ],
            [
                'id'       => 22,
                'name'     => 'Tuna',
                'price'    => 4.50,
                'category' => 'Sandwich',
                'photo'    => 'sandwich-tuna.jpg',
            ],
            [
                'id'       => 23,
                'name'     => 'Cheese',
                'price'    => 5.00,
                'category' => 'Sandwich',
                'photo'    => 'sandwich-cheese.jpg',
            ],
            [
                'id'       => 11,
                'name'     => 'Caesar Salad',
                'price'    => 3.50,
                'category' => 'Salad',
                'photo'    => 'salad-caesar.jpg',
            ],
            [
                'id'       => 12,
                'name'     => 'Greek Salad',
                'price'    => 3.80,
                'category' => 'Salad',
                'photo'    => 'salad-greek.jpg',
            ],
            [
                'id'       => 13,
                'name'     => 'Arabic Salad',
                'price'    => 3.90,
                'category' => 'Pizza',
                'photo'    => 'salad-arabic.jpg',
            ],
        ];
    }

}
