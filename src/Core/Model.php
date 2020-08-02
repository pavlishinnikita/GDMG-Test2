<?php

namespace App\Core;

use ReflectionClass;
use ReflectionProperty;

abstract class Model
{
    protected abstract function fileName();
    private $storage;

    public function __construct() // сюда можно передать интерфейс и определить стандартную реализацию и юзать любой тип хранения с горячей заменой
    {
        $this->storage = new JsonStorage($this->fileName());
    }

    public function findAll()
    {
        // need to return array of self with init data set is update to true
        return $this->storage->getAll();
    }

    public function findOne($field, $value)
    {
        // need to return self with init data and set is update to true
        return (Object) $this->storage->getData($field, $value);
    }

    public function save($isUpdate)
    {
        $reflectionClass = new ReflectionClass($this);
        return $this->storage->write($reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC), $this, $isUpdate);
    }
}