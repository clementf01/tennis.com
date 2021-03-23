<?php

namespace Models\ManagersInterface;

use Models\Entity\Entity;

interface ManagerInterface
{
    public function create(Entity $e);
    public function fetchAll();
    public function update(Entity $e);
    public function delete(Entity $e);
    public function fetchByOne(array $criteria);
}
