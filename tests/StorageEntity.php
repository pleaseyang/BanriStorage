<?php


namespace Tests;


use BanriStorage\Storage;

trait StorageEntity
{
    public function storage()
    {
        return new Storage('http://192.168.0.142:8080', 'PHPC1-A-KWSMAV', null, 3);
    }
}
