<?php

declare(strict_types=1);

use app\core\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    public function testSet(): void
    {
        $session = new Session();
        $session->set('key', 'value');
        $this->assertEquals('value', $session->get('key'));
    }

    public function testGet(): void
    {
        $session = new Session();
        $this->assertEquals('value', $session->get('key'));
        $this->assertNull($session->get('nonexistentKey'));
    }
}
