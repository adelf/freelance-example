<?php

namespace App\Infrastructure;

use App\Exceptions\EntityNotFoundException;
use Doctrine\ORM\Decorator\EntityManagerDecorator;

final class StrictEntityManager extends EntityManagerDecorator
{
    /**
     * @param string $entityName
     * @param $id
     * @return null|object
     */
    public function findOrFail(string $entityName, $id)
    {
        $entity = $this->wrapped->find($entityName, $id);

        if($entity === null)
        {
            throw new EntityNotFoundException(basename(str_replace('\\', '/', $entityName)) . ' not found');
        }

        return $entity;
    }
}