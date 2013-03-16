<?php
class FailTest extends PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $addedValue = 1 + 2;
        $this->assertEquals(2, $addedValue);
    }

    public function testText()
    {
        $text = "This is not a pen";
        $this->assertEquals("This is a pen", $text);
    }
}
?>

