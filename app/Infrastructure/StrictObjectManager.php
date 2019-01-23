<?php

namespace App\Infrastructure;

use Doctrine\Common\Persistence\ObjectManager;

interface StrictObjectManager extends ObjectManager
{
    /**
     * @param string $entityName
     * @param $id
     * @return null|object
     */
    public function findOrFail(string $entityName, $id);
}