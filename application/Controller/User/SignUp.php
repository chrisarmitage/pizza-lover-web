<?php

declare(strict_types=1);

namespace Application\Controller\User;

use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;

class SignUp implements Controller
{
    protected $mobile;
    protected $password;
    protected $name;
    protected $address;

    /**
     * Index constructor.
     * @param $request
     */
    public function __construct(Request $request)
    {
        $params = $request->query->all();
        $this->mobile   = $params['mobile'] ?? 'n/a';
        $this->password = $params['password'] ?? 'pass';
        $this->name     = $params['name'] ?? 'n/a';
        $this->address  = $params['address'] ?? 'n/a';
    }

    public function dispatch()
    {
        $user = new \GDS\Entity();
        $user->mobile = $this->mobile;
        $user->password = $this->password;
        $user->name = $this->name;
        $user->address = $this->address;

        $store = new \GDS\Store('User');
        $store->upsert($user);

        return [
            'success' => true,
            'mobile'  => $this->mobile,
        ];
    }

}
