<?php

namespace App\Infrastructure;

use App\Exceptions\ServiceException;
use Doctrine\ORM\Decorator\EntityManagerDecorator;

final class DoctrineStrictObjectManager extends EntityManagerDecorator implements StrictObjectManager
{
    /**
     * @param string $entityName
     * @param $id
     * @return null|object
     */
    public function findOrFail(string $entityName, $id)
    {
        $entity = $this->wrapped->find($entityName, $id);

        if ($entity === null)
        {
            throw new ServiceException(basename(str_replace('\\', '/', $entityName)) . ' not found');
        }

        return $entity;
    }
}