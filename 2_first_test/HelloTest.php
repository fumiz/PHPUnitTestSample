<?php
class HelloTest extends PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $addedValue = 1 + 1;
        $this->assertEquals(2, $addedValue);
    }

    public function testText()
    {
        $text = "This is a pen";
        $this->assertEquals("This is a pen", $text);
    }
}
?>

