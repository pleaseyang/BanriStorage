<?php

namespace Tests;

use BanriStorage\ProductAttribute;
use GuzzleHttp\Exception\GuzzleException;
use League\Flysystem\FileExistsException;
use PHPUnit\Framework\TestCase;

class ProductAttributeTest extends TestCase
{

    use StorageEntity;

    public function testDelete()
    {
        $storage = $this->storage();
        $productAttribute = new ProductAttribute($storage);
        try {
            $res = $productAttribute->delete('QDC-PA-KTDSEZ');
            dump($res);
        } catch (GuzzleException $e) {
            dump($e->getMessage());
        } catch (FileExistsException $e) {
        }
    }

    public function testUpdate()
    {
        $storage = $this->storage();
        $productAttribute = new ProductAttribute($storage);
        try {
            $res = $productAttribute->update('PHPC1-PA-YLSTWP', [
                'currencyCode' => 'JPY',
                'name' => '我是API创建的PHP仓的产品属性日币--修改',
                'status' => 1,
                'price' => 1,
            ]);
            dump($res);
        } catch (GuzzleException $e) {
            dump($e->getMessage());
        } catch (FileExistsException $e) {
        }
    }

    public function testIndex()
    {
        $storage = $this->storage();
        $productAttribute = new ProductAttribute($storage);
        try {
            $res = $productAttribute->index(1, 10);
            dump($res);
        } catch (GuzzleException $e) {
        } catch (FileExistsException $e) {
        }
    }

    public function testInfo()
    {
        $storage = $this->storage();
        $productAttribute = new ProductAttribute($storage);
        try {
            $res = $productAttribute->info('PHPC1-PA-YLSTWP');
            dump($res);
        } catch (GuzzleException $e) {
            dump($e->getMessage());
        } catch (FileExistsException $e) {
        }
    }

    public function testCreate()
    {
        $storage = $this->storage();
        $productAttribute = new ProductAttribute($storage);
        try {
            $res = $productAttribute->create([
                'currencyCode' => 'JPY',
                'name' => '我是API',
                'status' => 1,
                'price' => 222,
            ]);
            dump($res);
        } catch (GuzzleException $e) {
            dump($e->getMessage());
        } catch (FileExistsException $e) {
        }
    }
}
