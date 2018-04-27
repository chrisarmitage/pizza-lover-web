<?php

declare(strict_types=1);

namespace Application\Controller\User;

use Application\Repository\UserDatastore;
use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;

class LogIn implements Controller
{
    protected $mobile;
    protected $password;
    protected $name;
    protected $address;

    /**
     * @var UserDatastore
     */
    protected $userDatastore;

    /**
     * @param Request       $request
     * @param UserDatastore $userDatastore
     */
    public function __construct(Request $request, UserDatastore $userDatastore)
    {
        $params = $request->query->all();
        $this->mobile = $params['mobile'] ?? null;
        $this->password = $params['password'] ?? null;

        $this->userDatastore = $userDatastore;
    }

    public function dispatch()
    {
        $user = $this->userDatastore->findByMobileAndPassword(
            $this->mobile,
            $this->password
        );

        if ($user === null) {
            return [
                'success' => false,
            ];
        }

        return [
            'success' => true,
            'mobile'  => $user->getMobile(),
            'name'    => $user->getName(),
        ];
    }
}
