<?php


namespace BanriStorage;


use GuzzleHttp\Exception\GuzzleException;

class Product implements Curd
{

    private $code = 'productCode';

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
        return $this->getStorage()->post(ApiList::PRODUCTS, $param);
    }

    /**
     * @param array $param
     * @return array
     * @throws GuzzleException
     */
    public function create($param)
    {
        return $this->getStorage()->post(ApiList::PRODUCT_CREATE, $param);
    }

    /**
     * @param int|string $code
     * @return array
     * @throws GuzzleException
     */
    public function info($code)
    {
        return $this->getStorage()->post(ApiList::PRODUCT, [
            $this->code => $code
        ]);
    }

    /**
     * @param int|string $code
     * @param array $param
     * @return array
     * @throws GuzzleException
     */
    public function update($code, $param)
    {
        $param[$this->code] = $code;
        return $this->getStorage()->post(ApiList::PRODUCT_UPDATE, $param);
    }

    /**
     * @param int|string $code
     * @return array
     * @throws GuzzleException
     */
    public function delete($code)
    {
        return $this->getStorage()->post(ApiList::PRODUCT_DELETE, [
            $this->code => $code
        ]);
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
