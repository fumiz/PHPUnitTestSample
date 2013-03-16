<?php
require_once('src/ItemParser.php');

class ItemParserTest extends PHPUnit_Framework_TestCase {
    private $fixture;

    public function setUp() {
        $this->fixture = mb_convert_encoding(
            file_get_contents('tests/fixtures/items.csv'),
            'UTF-8'
        );
    }

    public function testParseItems() {
        $parser = new ItemParser();
        $items = $parser->parseItems($this->fixture);

        $this->assertSame('SS0849160', $items['SS0849160']->code);
        $this->assertSame('ポータブル水質分析計', $items['SS0849160']->name);
        $this->assertSame(74500, $items['SS0849160']->price);
        $this->assertEmpty($items['SS0849160']->quantity);

        $this->assertSame('TK3135850', $items['TK3135850']->code);
        $this->assertSame('スポンジたわし', $items['TK3135850']->name);
        $this->assertSame(300, $items['TK3135850']->price);
        $this->assertEmpty($items['TK3135850']->quantity);

        $this->assertSame('SN3136950', $items['SN3136950']->code);
        $this->assertSame('試験器具用特殊洗浄液', $items['SN3136950']->name);
        $this->assertSame(2000, $items['SN3136950']->price);
        $this->assertEmpty($items['SN3136950']->quantity);
    }
}