<?php


namespace BanriStorage;


use GuzzleHttp\Exception\GuzzleException;

class ProductAttribute implements Curd
{

    private $code = 'productAttributeCode';

    /**
     * @var Storage
     */
    private $storage;

    /**
     * ProductAttribute constructor.
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
        return $this->getStorage()->post(ApiList::PRODUCT_ATTRIBUTES, $param);
    }

    /**
     * @param array $param
     * @return array
     * @throws GuzzleException
     */
    public function create($param)
    {
        return $this->getStorage()->post(ApiList::PRODUCT_ATTRIBUTE_CREATE, $param);
    }

    /**
     * @param int|string $code
     * @return array
     * @throws GuzzleException
     */
    public function info($code)
    {
        return $this->getStorage()->post(ApiList::PRODUCT_ATTRIBUTE, [
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
        return $this->getStorage()->post(ApiList::PRODUCT_ATTRIBUTE_UPDATE, $param);
    }

    /**
     * @param int|string $code
     * @return array
     * @throws GuzzleException
     */
    public function delete($code)
    {
        return $this->getStorage()->post(ApiList::PRODUCT_ATTRIBUTE_DELETE, [
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
