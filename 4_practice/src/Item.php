<?php

class Item {
    public $code;
    public $name;
    public $price;
    public $quantity;

    public static function create($code, $name, $price, $quantity) {
        $item = new Item($code, $name, $price);
        $item->setQuantity($quantity);
        return $item;
    }

    public function __construct($code, $name, $price) {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }
}