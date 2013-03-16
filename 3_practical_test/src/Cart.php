<?php
class Cart {
    private $items;

    function __construct() {
        $this->items = array();
    }

    public function addItem($item) {
        array_push($this->items, $item);
    }

    public function removeItem($item) {

    }

    public function getItems() {
        return $this->items;
    }
}
?>
