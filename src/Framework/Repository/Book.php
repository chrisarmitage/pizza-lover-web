<?php

declare(strict_types=1);

namespace Framework\Repository;

class Book
{
    protected $data = [
        [
            'owner' => 'ca',
            'id' => 'botw',
            'name' => 'Book of the Worm',
        ],
        [
            'owner' => 'ca',
            'id' => 'aot',
            'name' => 'Angles of Time',
        ],
        [
            'owner' => 'ca',
            'id' => 'wotmm',
            'name' => 'Writings of the Mad Monk',
        ],
        [
            'owner' => 'cw',
            'id' => 'botw',
            'name' => 'Book of the Worm CW',
        ],
        [
            'owner' => 'bc',
            'id' => 'ca',
            'name' => 'Codex Astartes',
        ],
        [
            'owner' => 'bc',
            'id' => 'lf',
            'name' => 'Libre Fanatica',
        ],
    ];

    public function getAll($owner)
    {
        return array_values(
            array_filter(
                $this->data,
                function($book) use ($owner) {
                    return $book['owner'] === $owner;
                }
            )
        );
    }

    public function get($owner, $id)
    {
        return array_values(
            array_filter(
                $this->data,
                function($book) use ($owner, $id) {
                    return $book['owner'] === $owner
                        && $book['id'] === $id;
                }
            )
        )[0];
    }
}
