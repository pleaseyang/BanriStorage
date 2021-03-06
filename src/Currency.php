<?php


namespace BanriStorage;


use GuzzleHttp\Exception\GuzzleException;

/**
 * 币种
 *
 * Class Currency
 * @package BanriStorage
 */
class Currency
{
    /**
     * @var Storage
     */
    private $storage;

    /**
     * 获取币种列表
     *
     * @param int $pageNum
     * @param int $pageSize
     * @param array $param
     * @return array
     * @throws GuzzleException
     */
    public function index($pageNum, $pageSize, $param = [])
    {
        $param['pageNum'] = $pageNum;
        $param['pageSize'] = $pageSize;
        return $this->getStorage()->post(ApiList::CURRENCIES, $param);
    }

    /**
     * Product constructor.
     *
     * @param Storage $storage
     */
    public function __construct(Storage $storage)
    {
        $this->setStorage($storage);
    }

    /**
     * @return Storage
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param Storage $storage
     */
    public function setStorage(Storage $storage)
    {
        $this->storage = $storage;
    }
}
