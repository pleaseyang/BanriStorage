<?php

namespace Tests;

use BanriStorage\Product;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    use StorageEntity;

    public function testIndex()
    {
        $storage = $this->storage();
        $product = new Product($storage);
        dump($product->index(0, 50));
    }

    public function testDelete()
    {
        $storage = $this->storage();
        $product = new Product($storage);
        dump($product->delete('PHPC1-P-KCRRSC'));
    }

    public function testInfo()
    {
        $storage = $this->storage();
        $product = new Product($storage);
        dump($product->info('PHPC1-P-DSRBDF'));
    }

    public function testCreate()
    {
        $storage = $this->storage();
        $product = new Product($storage);
        try {
            dump($product->create([
                'name' => 'API创建',
                'status' => 1,
                'attributeCodes' => [
                    'PHPC1-PA-YLSTWP',
                    'QDC-PA-KTDSEZ',
                    '14702'
                ]
            ]));
        } catch (GuzzleException $e) {
            dump($e->getMessage());
        }
    }

    public function testUpdate()
    {
        $storage = $this->storage();
        $product = new Product($storage);
        dump($product->update('PHPC1-P-DSRBDF', [
            'name' => 'name',
            'status' => 1,
            'attributeCodes' => [
                'PHPC1-PA-SIGYYZ',
                'PHPC1-PA-LTEKZG',
                'PHPC1-PA-QJXWCG',
                'PHPC1-PA-YLSTWP',
                'QDC-PA-KTDSEZ',
                '14702',
                '我是人民8321',
            ]
        ]));
    }
}
