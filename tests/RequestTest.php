<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use app\core\Request;

class RequestTest extends TestCase
{
    public function testGetUri(): void
    {
        $_SERVER['REQUEST_URI'] = '/test';
        $request = new Request();
        $this->assertEquals('/test', $request->getUri());
    }

    public function testGetMethod(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $request = new Request();
        $this->assertEquals('GET', $request->getMethod());
    }

    public function testGetBodyForGetMethod(): void
    {
        $_GET = ['key1' => 'value1', 'key2' => 'value2'];
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $request = new Request();
        $this->assertEquals(['key1' => 'value1', 'key2' => 'value2'], $request->getBody());
    }

    public function testGetBodyForPostMethod(): void
    {
        $_POST = ['key3' => 'value3', 'key4' => 'value4'];
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $request = new Request();
        $this->assertEquals(['key3' => 'value3', 'key4' => 'value4'], $request->getBody());
    }
}
