<?php


namespace BanriStorage;


interface Curd
{
    /**
     * list
     *
     * @param int $pageNum
     * @param int $pageSize
     * @param array $param
     * @return array
     */
    public function index($pageNum, $pageSize, $param = []);

    /**
     * create
     *
     * @param array $param
     * @return array
     */
    public function create($param);

    /**
     * info
     *
     * @param int|string $code
     * @return array
     */
    public function info($code);

    /**
     * update
     *
     * @param int|string $code
     * @param array $param
     * @return array
     */
    public function update($code, $param);

    /**
     * list
     *
     * @param int|string $code
     * @return array
     */
    public function delete($code);
}
