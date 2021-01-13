<?php


namespace BanriStorage;


use GuzzleHttp\Exception\GuzzleException;

/**
 * 收货单
 *
 * Class RecipientOrder
 * @package BanriStorage
 */
class RecipientOrder
{
    /**
     * @var Storage
     */
    private $storage;

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
     * 创建收货单
     *
     * @param $param
     * @return array
     * @throws GuzzleException
     */
    public function create($param)
    {
        return $this->getStorage()->post(ApiList::RECIPIENTORDERAPI_CREATE, $param);
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
