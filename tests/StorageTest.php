<?php

namespace Tests;

use BanriStorage\Storage;
use PHPUnit\Framework\TestCase;

class StorageTest extends TestCase
{

    public function testSuccess()
    {
        dump(Storage::success());
    }
}
