<?php

namespace Application\Repository;

use Application\Entity\BasketLine;
use Google\Cloud\Datastore\DatastoreClient;

class BasketLineDatastore
{
    /**
     * @var DatastoreClient
     */
    protected $datastore;

    /**
     * @param DatastoreClient $datastore
     */
    public function __construct(DatastoreClient $datastore)
    {
        $this->datastore = $datastore;
    }

    /**
     * @param BasketLine $basketLine
     */
    public function insert(BasketLine $basketLine)
    {
        $basketLineKey = $this->datastore->key('BasketLine');
        $basketLine = $this->datastore->entity(
            $basketLineKey,
            [
                'mobile'   => $basketLine->getMobile(),
                'itemId'   => $basketLine->getItemId(),
                'quantity' => $basketLine->getQuantity(),
            ]
        );

        $this->datastore->insert($basketLine);
    }

    /**
     * @param $mobile
     * @return BasketLine[]
     */
    public function findByMobile($mobile)
    {
        $query = $this->datastore->query()
            ->filter('mobile', '=', $mobile)
            ->kind('BasketLine');

        $results = $this->datastore->runQuery($query);

        $basketLines = [];
        foreach ($results as $result) {
            $basketLines[] = new BasketLine(
                $result->mobile,
                $result->itemId,
                $result->quantity
            );
        }

        return $basketLines;
    }

}
