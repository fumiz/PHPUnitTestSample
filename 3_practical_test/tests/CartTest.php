<?php
require_once('src/Cart.php');

class CartTest extends PHPUnit_Framework_TestCase {
    public function testConstruct() {
        $cart = new Cart();
        $this->assertEmpty($cart->getItems());
    }

    public function testAddItem() {
        $cart = new Cart();

        $cart->addItem('item_one');
        $items = $cart->getItems();
        $this->assertEquals($items, array('item_one'));

        $cart->addItem('item_two');
        $items = $cart->getItems();
        $this->assertEquals($items, array('item_one', 'item_two'));
    }

    public function testRemoveItem() {
        $cart = new Cart();
        $cart->addItem('item_one');
        $cart->addItem('item_two');
        $cart->addItem('item_three');
        $cart->removeItem('item_two');

        $items = $cart->getItems();
        $this->assertEquals($items, array('item_one', 'item_three'));
    }
}
?>
