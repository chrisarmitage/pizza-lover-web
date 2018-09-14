<?php

declare(strict_types=1);

namespace Application\Controller\TempOrder;

use Application\Entity\BasketLine;
use Application\Repository\BasketLineDatastore;
use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddItem implements Controller
{
    protected $mobile;
    protected $itemId;
    protected $quantity;

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
        $this->mobile   = $params['mobile'] ?? 'n/a';
        $this->itemId   = (int) $params['itemId'] ?? 0;
        $this->quantity = (int) $params['quantity'] ?? 1;

        $this->basketLineDatastore = $basketLineDatastore;
    }

    public function dispatch()
    {
        $this->basketLineDatastore->insert(
            new BasketLine(
                $this->mobile,
                $this->itemId,
                $this->quantity
            )
        );

        return [
            'success' => true,
        ];
    }

}
