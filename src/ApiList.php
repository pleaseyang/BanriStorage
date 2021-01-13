<?php


namespace BanriStorage;


/**
 * API请求地址
 *
 * Class ApiList
 * @package BanriStorage
 */
class ApiList
{
    /*
    |--------------------------------------------------------------------------
    | 币种管理
    |--------------------------------------------------------------------------
    */
    const CURRENCIES = 'currencyApi/list'; // 币种列表

    /*
    |--------------------------------------------------------------------------
    | 产品管理
    |--------------------------------------------------------------------------
    */
    const PRODUCTS = 'productApi/list'; // 产品列表
    const PRODUCT = 'productApi/info'; // 产品详情
    const PRODUCT_CREATE = 'productApi/create'; // 新增产品
    const PRODUCT_UPDATE = 'productApi/update'; // 编辑产品
    const PRODUCT_DELETE = 'productApi/delete'; // 删除产品

    /*
    |--------------------------------------------------------------------------
    | 产品属性管理
    |--------------------------------------------------------------------------
    */
    const PRODUCT_ATTRIBUTES = 'productAttributeApi/list'; // 产品属性列表
    const PRODUCT_ATTRIBUTE = 'productAttributeApi/info'; // 产品属性详情
    const PRODUCT_ATTRIBUTE_CREATE = 'productAttributeApi/create'; // 新增产品属性
    const PRODUCT_ATTRIBUTE_UPDATE = 'productAttributeApi/update'; // 编辑产品属性
    const PRODUCT_ATTRIBUTE_DELETE = 'productAttributeApi/delete'; // 删除产品属性

    /*
    |--------------------------------------------------------------------------
    | 快递
    |--------------------------------------------------------------------------
    */
    const EXPRESS_LIST_BY_NAME = 'recipientOrderApi/expressListByName'; // 通过快递名称查询快递编码

    /*
    |--------------------------------------------------------------------------
    | 收货单管理
    |--------------------------------------------------------------------------
    */
    const RECIPIENTORDERAPI_CREATE = 'recipientOrderApi/create'; // 创建收货单
}
