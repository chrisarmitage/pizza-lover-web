<?php

namespace Application\Repository;

use Application\Entity\User;
use Google\Cloud\Datastore\DatastoreClient;

class UserDatastore
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
     * @param User $user
     */
    public function insert(User $user)
    {
        $userKey = $this->datastore->key('User');
        $user = $this->datastore->entity(
            $userKey,
            [
                'mobile'   => $user->getMobile(),
                'password' => $user->getPassword(),
                'name'     => $user->getName(),
                'address'  => $user->getAddress(),
            ]
        );

        $this->datastore->insert($user);
    }

    /**
     * @param $mobile
     * @param $password
     * @return User|null
     */
    public function findByMobileAndPassword($mobile, $password)
    {
        $query = $this->datastore->query()
            ->filter('mobile', '=', $mobile)
            ->filter('password', '=', $password)
            ->limit(1)
            ->kind('User');

        $results = $this->datastore->runQuery($query);

        if (iterator_count($results) === 0) {
            return null;
        }

        $results->rewind();
        $row = $results->current();

        return new User(
            $row->mobile,
            null,
            $row->name,
            $row->address
        );
    }
}
