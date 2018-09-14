<?php

declare(strict_types=1);

namespace Application\Controller\User;

use Application\Entity\User;
use Application\Repository\UserDatastore;
use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;

class SignUp implements Controller
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
        $this->mobile   = $params['mobile'] ?? 'n/a';
        $this->password = $params['password'] ?? 'pass';
        $this->name     = $params['name'] ?? 'n/a';
        $this->address  = $params['address'] ?? 'n/a';

        $this->userDatastore = $userDatastore;
    }

    public function dispatch()
    {
        $this->userDatastore->insert(
            new User(
                $this->mobile,
                $this->password,
                $this->name,
                $this->address
            )
        );

        return [
            'success' => true,
        ];
    }

}
