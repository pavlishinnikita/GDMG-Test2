<?php

namespace App\Core;

use Exception;

class JsonStorage
{
  private $json;
  private $filename;
  public function __construct(string $filename)
  {
    $this->filename = $filename;
    $this->open($filename);
  }
  private function open($filename)
  {
    if (!file_exists(ROOT . "src\\Assets\db\\{$filename}")) {
      throw new Exception('DB NOT EXISTS');
    }
    $this->json = json_decode(file_get_contents(ROOT . "src\\Assets\db\\{$filename}"), true);
  }

  public function getData(string $field, string $value)
  {
    foreach ($this->json as $item) {
      if (array_key_exists($field, $item) && $item[$field] === $value) {
        return $item;
      }
    }
    return null;
  }

  public function getAll()
  {
    return $this->json;
  }

  private function reflectionPropertiesToArray($properties, $obj)
  {
    $newDataArray = [];
    foreach($properties as $value) {
      if(!$value->isStatic()) {
        $newDataArray[$value->getName()] = $value->getValue($obj);
      }
    }
    return $newDataArray;
  }

  public function write($newData, $obj, $isUpdate)
  {
    $newDataArray = $this->reflectionPropertiesToArray($newData, $obj);
    foreach($newDataArray as $value) {
      foreach($this->json as $k => $arr) {
        if(in_array($value, $arr)) {
          if($isUpdate) {
            $this->json[$k] = $newDataArray;
          } else {
            // or throw exception
            return false;
          }
        }
      }
    }
    if(!$isUpdate || empty($this->json)) {
      array_push($this->json, $newDataArray);
    }
    $jsondata = json_encode($this->json, JSON_PRETTY_PRINT);
    if (file_put_contents(ROOT . "src\\Assets\db\\{$this->filename}", $jsondata)) {
      return true;
    } else {
      return false;
    }
  }
}
