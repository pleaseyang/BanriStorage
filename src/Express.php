<?php


namespace BanriStorage;


use GuzzleHttp\Exception\GuzzleException;

/**
 * 快递
 *
 * Class Express
 * @package BanriStorage
 */
class Express
{

    /**
     * @var Storage
     */
    private $storage;

    /**
     * 获取快递列表
     *
     * @param string|null $name
     * @return array
     * @throws GuzzleException
     */
    public function index($name = null)
    {
        $param['name'] = $name;
        return $this->getStorage()->post(ApiList::EXPRESS_LIST_BY_NAME, $param);
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
