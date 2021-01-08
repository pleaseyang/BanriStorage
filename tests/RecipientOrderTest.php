<?php

namespace Tests;

use BanriStorage\RecipientOrder;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class RecipientOrderTest extends TestCase
{

    use StorageEntity;

    public function testCreate()
    {
        $storage = $this->storage();
        $product = new RecipientOrder($storage);
        try {
            dump($product->create([
                'putOddNumber' => '1',
                'putLogisticsCode' => 'yuantong',
                'mode' => 1,
                'receBatch' => 'receBatch',
                'remark' => 'remark',
                'parentPutOddNumber' => '',
                'items' => [
                    [
                        'itemName' => 'itemName',
                        'itemCode' => 'itemCode',
                        'itemPutCount' => '1',
                        'itemPrice' => '1',
                        'itemCurrency' => 'CNY',
                        'itemProductName' => 'itemProductName',
                        'itemMaterrial' => 'itemMaterrial',
                        'itemPic' => 'itemPic',
                        'productCode' => 'PHPC1-P-FSKEKS',
                        'itemRemark' => 'itemRemark',
                    ]
                ]
            ]));
        } catch (GuzzleException $e) {
            dump($e->getMessage());
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
    }
}
