<?php

namespace Tests;

use BanriStorage\Currency;
use GuzzleHttp\Exception\GuzzleException;
use League\Flysystem\FileExistsException;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{

    use StorageEntity;

    public function testIndex()
    {
        $storage = $this->storage();
        $currency = new Currency($storage);
        try {
            $res = $currency->index(1, 50);
            dump($res);
        } catch (GuzzleException $e) {
            dump($e->getMessage());
        } catch (FileExistsException $e) {
            dump($e->getMessage());
        }
    }
}
