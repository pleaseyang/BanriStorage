## BANRI仓库对外API

### 实例化仓库
```
$storage = new Storage(
    'http://192.168.0.142:8080', // 对接的URL地址
    'PHPC1-A-KWSMAV', // 颁发的密钥
    null, // 请求存放的文件地址 (注意权限)
    3 // 请求最大响应时间
);
```

#### 例 创建产品属性
```
$productAttribute = new ProductAttribute($storage);
$productAttribute->create([
    'currencyCode' => 'JPY',
    'name' => '产品属性名称',
    'status' => 1,
    'price' => 11,
]);
```
