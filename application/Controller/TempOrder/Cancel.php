<?php

namespace Application\Controller\TempOrder;

use Framework\Controller;
use Google\Cloud\Datastore\DatastoreClient;
use Symfony\Component\HttpFoundation\Request;

class Cancel implements Controller
{
    protected $mobile;

    /**
     * @var DatastoreClient
     */
    protected $datastoreClient;
    /**
     * @var Request
     */
    private $request;

    /**
     * Index constructor.
     * @param Request $request
     * @param DatastoreClient $datastoreClient
     */
    public function __construct(Request $request, DatastoreClient $datastoreClient)
    {
        $params = $request->query->all();
        $this->mobile = $params['mobile'] ?? 'n/a';

        $this->datastoreClient = $datastoreClient;
        $this->request = $request;
    }

    public function dispatch()
    {
        $query = $this->datastoreClient->query()
            ->filter('mobile', '=', $this->mobile)
            ->kind('TempOrder')
            ->keysOnly();

        $results = $this->datastoreClient->runQuery($query);

        $keys = [];
        /** @var \Google\Cloud\Datastore\Entity $result */
        foreach ($results as $result) {
            $keys[] = $result->key();
        }

        $this->datastoreClient->deleteBatch($keys);

        return ['success' => true];
    }


}
