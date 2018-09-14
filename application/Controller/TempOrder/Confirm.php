<?php

declare(strict_types=1);

namespace Application\Controller\TempOrder;

use Application\Repository\BasketLineDatastore;
use Framework\Controller;
use Google\Cloud\Datastore\DatastoreClient;
use Symfony\Component\HttpFoundation\Request;

class Confirm implements Controller
{
    protected $mobile;

    /**
     * @var BasketLineDatastore
     */
    protected $basketLineDatastore;

    /**
     * @var DatastoreClient
     */
    protected $datastoreClient;

    /**
     * @param Request $request
     * @param BasketLineDatastore $basketLineDatastore
     * @param DatastoreClient $datastoreClient
     */
    public function __construct(Request $request, BasketLineDatastore $basketLineDatastore, DatastoreClient $datastoreClient)
    {
        $params = $request->query->all();
        $this->mobile = $params['mobile'] ?? 'n/a';

        $this->basketLineDatastore = $basketLineDatastore;
        $this->datastoreClient = $datastoreClient;
    }

    public function dispatch()
    {
        /** Get TempOrder */
        $basketLines = $this->basketLineDatastore->findByMobile($this->mobile);

        /** Create Order */
        $orderKey = $this->datastoreClient->key('Order');
        $order = $this->datastoreClient->entity(
            $orderKey,
            [
                'dateTime' => new \DateTimeImmutable(),
                'mobile' => $this->mobile,
            ]
        );

        $this->datastoreClient->insert($order);

        foreach ($basketLines as $basketLine) {
            // $orderLineKey = $datastore->key('OrderLine');
            $orderLineKey = $order->key()->pathElement('OrderLine');
            $orderLine = $this->datastoreClient->entity(
                $orderLineKey,
                [
                    'orderId' => $order->key(),
                    'itemId' => $basketLine->getItemId(),
                    'quantity' => $basketLine->getQuantity(),
                ]
            );

            $this->datastoreClient->insert($orderLine);
        }

        $keys = [];
        /** @var \Google\Cloud\Datastore\Entity $basketLine */
//        foreach ($results as $basketLine) {
//            $keys[] = $basketLine->key();
//        }
//
//        $datastore->deleteBatch($keys);
    }

}
