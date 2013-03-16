<?php
require_once('src/PrefecturesParser.php');

class PrefecturesParserTest extends PHPUnit_Framework_TestCase {
    private $fixture;

    public function setUp() {
        $this->fixture = mb_convert_encoding(
            file_get_contents('tests/fixtures/prefectures.csv'),
            'UTF-8'
        );
    }

    public function testParsePrefectures() {
        $parser = new PrefecturesParser();
        $prefectures = $parser->parsePrefectures($this->fixture);

        $this->assertSame('北海道', $prefectures['01']['name']);
        $this->assertSame(500, $prefectures['01']['shipping_price']);

        $this->assertSame('大阪', $prefectures['27']['name']);
        $this->assertSame(300, $prefectures['27']['shipping_price']);

        $this->assertSame('沖縄', $prefectures['47']['name']);
        $this->assertSame(700, $prefectures['47']['shipping_price']);
    }
}