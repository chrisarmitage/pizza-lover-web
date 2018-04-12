<?php

declare(strict_types=1);

namespace Application\Controller\User;

use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;

class LogIn implements Controller
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
        $this->mobile = $params['mobile'] ?? null;
        $this->password = $params['password'] ?? null;
    }

    public function dispatch()
    {
        $store = new \GDS\Store('User');
        $user = $store->fetchOne(
            "SELECT * FROM User WHERE mobile = @mobile AND password = @password",
            [
                'mobile'   => $this->mobile,
                'password' => $this->password,
            ]
        );

        if ($user === null) {
            return [
                'success' => false,
            ];
        }

        return [
            'success' => true,
            'mobile'  => $user->mobile,
            'name'    => $user->name,
        ];
    }

}
