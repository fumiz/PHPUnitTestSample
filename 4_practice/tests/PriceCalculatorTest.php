<?php
require_once('src/PrefecturesParser.php');
require_once('src/ItemParser.php');
require_once('src/Item.php');
require_once('src/PriceCalculator.php');

class PriceCalculatorTest extends PHPUnit_Framework_TestCase {
    private $prefectures;
    private $items;

    private function loadText($path) {
        return mb_convert_encoding(
            file_get_contents($path),
            'UTF-8'
        );
    }

    public function setUp() {
        $prefectureParser = new PrefecturesParser();
        $this->prefectures = $prefectureParser->parsePrefectures(
            $this->loadText('tests/fixtures/prefectures.csv')
        );
        $itemParser = new ItemParser();
        $this->items = $itemParser->parseItems(
            $this->loadText('tests/fixtures/items.csv')
        );
    }

    /**
     * 商品価格10000円以上で送料無料
     */
    public function testCalcShippingCost() {
        $calculator = new PriceCalculator();
        $shippingPrice = $calculator->calcShippingCost(
            array(Item::create('N/A', 'N/A', 1000, 1)),
            $this->prefectures['01']
        );
        $this->assertSame(0, $shippingPrice);

        $shippingPrice = $calculator->calcShippingCost(
            array(Item::create('N/A', 'N/A', 999, 1)),
            $this->prefectures['01']
        );
        $this->assertSame(500, $shippingPrice);
    }

    public function testCalcItemsPrice() {
        $calculator = new PriceCalculator();
        $price = $calculator->calcItemsPrice(
            array(
                Item::create('N/A', 'N/A', 5000, 1),
                Item::create('N/A', 'N/A', 1111, 3),
            )
        );
        $this->assertSame(8333, $price);
    }

    public function testCalcCost() {
        $calculator = new PriceCalculator();

        $cost = $calculator->calcCost(
            array(
                $this->items['SS0849160']->setQuantity(2),
                $this->items['SS0828881']->setQuantity(1),
                $this->items['SS0814207']->setQuantity(3),
            ),
            $this->prefectures['27']
        );
        $this->assertSame(4362820, $cost);

        $cost = $calculator->calcCost(
            array(
                $this->items['SS0828881']->setQuantity(2),
                $this->items['SN3136950']->setQuantity(2),
            ),
            $this->prefectures['27']
        );
        $this->assertSame(4640, $cost);
    }

    public function testShowCost() {
        $calculator = new PriceCalculator();


        $expected = <<< DOC_END
ポータブル水質分析計 単価:700,000円 数量:2個 小計:1,400,000円
ネットスポンジたわし 単価:320円 数量:1個 小計:320円
ガスクロマトグラフ分析装置 単価:987,500円 数量:3個 小計:2,962,500円
送料: 0円
合計: 4,362,820円
DOC_END;
        $actual = $calculator->showCost(
            array(
                $this->items['SS0849160']->setQuantity(2),
                $this->items['SS0828881']->setQuantity(1),
                $this->items['SS0814207']->setQuantity(3),
            ),
            $this->prefectures['27']
        );
        $this->assertEquals($expected, $actual);

        $expected = <<< DOC_END
ネットスポンジたわし 単価:320円 数量:2個 小計:640円
試験器具用特殊洗浄液 単価:2,000円 数量:2個 小計:4,000円
送料: 300円
合計: 4,640円
DOC_END;
        $actual = $calculator->showCost(
            array(
                $this->items['SS0828881']->setQuantity(2),
                $this->items['SN3136950']->setQuantity(2),
            ),
            $this->prefectures['27']
        );
        $this->assertEquals($expected, $actual);
    }
}