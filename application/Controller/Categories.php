<?php

namespace Application\Controller;

use Framework\Controller;

class Categories implements Controller
{
    public function dispatch()
    {
        return [
            [ 'category' => 'Pizza' ],
            [ 'category' => 'Sandwich' ],
            [ 'category' => 'Salad' ],
            [ 'category' => 'Beverages' ],
            [ 'category' => 'Extras' ],
        ];
    }
}
