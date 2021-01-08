<?php

namespace Tests;

use BanriStorage\Express;
use GuzzleHttp\Exception\GuzzleException;
use League\Flysystem\FileExistsException;
use PHPUnit\Framework\TestCase;

class ExpressTest extends TestCase
{

    use StorageEntity;

    public function testIndex()
    {
        $storage = $this->storage();
        $currency = new Express($storage);
        try {
            $res = $currency->index('圆通');
            dump($res);
        } catch (GuzzleException $e) {
            dump($e->getMessage());
        } catch (FileExistsException $e) {
            dump($e->getMessage());
        }
    }
}
