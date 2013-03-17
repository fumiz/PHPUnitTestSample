# 準備

## PHPUnitのインストール
PEARでインストールするのが一番楽です

    sudo pear channel-discover pear.symfony.com
    sudo pear channel-discover pear.phpunit.de
    sudo pear install phpunit/PHPUnit

もしPEARを使うのがはじめてなら、php.iniのinclude_pathにPEARのディレクトリを入れるのを忘れないで!

* ネット上にはバージョンが古い情報もあるので気をつけて!

## インストールできたことの確認

### テストの記述
test_first.php
'''php
<?php
class ArrayTest extends PHPUnit_Framework_TestCase
{
    public function testNewArrayIsEmpty()
    {
        // 配列を作成します。
        $fixture = array();

        // 配列のサイズは 0 です。
        $this->assertEquals(0, sizeof($fixture));
    }

    public function testArrayContainsAnElement()
    {
        // 配列を作成します。
        $fixture = array();

        // 配列にひとつの要素を追加します。
        $fixture[] = 'Element';

        // 配列のサイズは 1 です。
        $this->assertEquals(1, sizeof($fixture));
    }
}
?>
'''

### テストの実行
'''
phpunit test_first.php
'''

結果が返ります
'''
% phpunit test.php                                                                                                                                    -1-[miff:~/tmp]

PHPUnit 3.7.18 by Sebastian Bergmann.

..

Time: 0 seconds, Memory: 4.50Mb

OK (2 tests, 2 assertions)
'''

これで動作確認はOKです

