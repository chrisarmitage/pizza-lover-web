<?php

namespace Application\Controller\TempOrder;

use Framework\Controller;
use Google\Cloud\Datastore\DatastoreClient;
use Symfony\Component\HttpFoundation\Request;

class Total implements Controller
{
    protected $orderId;

    /**
     * @var DatastoreClient
     */
    protected $datastoreClient;

    /**
     * Index constructor.
     * @param Request $request
     * @param DatastoreClient $datastoreClient
     */
    public function __construct(Request $request, DatastoreClient $datastoreClient)
    {
        $params = $request->query->all();
        $this->orderId = $params['orderId'] ?? 'n/a';
        $this->datastoreClient = $datastoreClient;
    }

    public function dispatch()
    {
        $order = $this->datastoreClient->lookup(
            $this->datastoreClient->key('Order', $this->orderId)
        );

        $query = $this->datastoreClient->query()
            ->hasAncestor($order->key())
            ->kind('OrderLine');

        $results = $this->datastoreClient->runQuery($query);

        $total = 0;
        foreach ($results as $result) {
            foreach ($this->getItems() as $item) {
                if ($result->itemId == $item['id']) {
                    $total += $result->quantity * $item['price'];
                }
            }
        }

        return $total;
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
