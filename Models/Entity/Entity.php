<?php

namespace Models\Entity;

class Entity
{
    protected $id = null;
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $v)
    {
        $this->id = $v;
    }
}
