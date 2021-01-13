<?php


namespace BanriStorage;


use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\TransferStats;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class Storage
{
    private $key = 'secretKey';

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $apiCode;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $logPath;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * Storage constructor.
     * @param string $uri 请求地址 @请填写环境变量提供的地址
     * @param string $apiCode API编码 @由仓库提供
     * @param string|null $logPath 本地储存地址 @请求日志存放路径 请注意权限 | null 不储存
     * @param int $timeout 响应时间 @0 不限制
     */
    public function __construct($uri, $apiCode, $logPath = 'banriStorageApi', $timeout = 0)
    {
        $this->setUri($uri);
        $this->setClient($timeout);
        $this->setApiCode($apiCode);
        $this->setLogPath($logPath);
    }

    /**
     *
     * @param string $url
     * @param array $param
     * @return array
     * @throws GuzzleException
     */
    public function post($url, $param = [])
    {
        $params = array_merge($param, [
            $this->key => $this->getApiCode()
        ]);
        $response = $this->getClient()->request('POST', $url, [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::JSON => $params,
            RequestOptions::ON_STATS => function (TransferStats $stats) {
                $this->log($stats);
            }
        ]);
        $res = (string)$response->getBody();
        $result = \GuzzleHttp\json_decode($res, true);
        if ($this->logPath) {
            $result['requestFile'] = $this->getLogPath(
                Carbon::parse($result['timestamp'], 'Asia/Shanghai')->format('Ymd')
                . DIRECTORY_SEPARATOR
                . $result['requestId'] . '.log'
            );
        }
        return $result;
    }

    /**
     * 回调 返回正确的响应
     *
     * @return string
     */
    public static function success()
    {
        return \GuzzleHttp\json_encode([
           'status' => true
        ]);
    }

    /**
     * @param TransferStats $stats
     * @throws Exception
     */
    private function log(TransferStats $stats)
    {
        if ($this->logPath && $stats->getResponse()) {
            $response = \GuzzleHttp\json_decode($stats->getResponse()->getBody(), true);
            $carbon = Carbon::now('Asia/Shanghai');
            $path = $carbon->format('Ymd');
            $this->getFilesystem()->createDir($path);
            $contents = "请求标识: {$response['requestId']}\n";
            $contents .= "请求时间: " . $carbon . "\n";
            $contents .= "请求地址: {$stats->getEffectiveUri()}\n";
            $contents .= "请求头: " . \GuzzleHttp\json_encode($stats->getRequest()->getHeaders()) . "\n";
            $contents .= "请求方式: " . $stats->getRequest()->getMethod() . "\n";
            $contents .= "请求参数: " . $stats->getRequest()->getBody() . "\n";
            $contents .= "响应时间: " . $stats->getTransferTime() . "\n";
            $contents .= "响应码: " . $stats->getResponse()->getStatusCode() . "\n";
            $contents .= "响应信息: " . $stats->getResponse()->getBody();
            $logPath = $path . DIRECTORY_SEPARATOR . $response['requestId'] . '.log';
            $this->getFilesystem()->put($logPath, $contents);
        }
    }

    /**
     * @param string $uri
     * @return void
     */
    private function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    private function getUri()
    {
        return $this->uri;
    }

    /**
     * @param int $timeout
     * @return void
     */
    private function setClient($timeout)
    {
        $this->client = new Client([
            'base_uri' => $this->getUri(),
            'timeout' => $timeout,
            'verify' => false
        ]);
    }

    /**
     * @return Client
     */
    private function getClient()
    {
        return $this->client;
    }

    /**
     * @return string
     */
    private function getApiCode()
    {
        return $this->apiCode;
    }

    /**
     * @param string $apiCode
     */
    private function setApiCode($apiCode)
    {
        $this->apiCode = $apiCode;
    }

    /**
     * @return Filesystem
     */
    private function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * @param Filesystem $filesystem
     */
    private function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param string $path
     * @return string|null
     */
    private function getLogPath($path = '')
    {
        return $this->logPath . DIRECTORY_SEPARATOR . $path;
    }

    /**
     * @param string $logPath
     */
    private function setLogPath($logPath)
    {
        $root = null;
        if ($logPath) {
            $root = dirname(__DIR__) . DIRECTORY_SEPARATOR . $logPath;
            $adapter = new Local(
                $root,
                LOCK_EX,
                Local::DISALLOW_LINKS,
                [
                    'file' => [
                        'public' => 0744,
                        'private' => 0700,
                    ],
                    'dir' => [
                        'public' => 0755,
                        'private' => 0700,
                    ]
                ]
            );
            $filesystem = new Filesystem($adapter);
            $this->setFilesystem($filesystem);
        }
        $this->logPath = $root;
    }
}
