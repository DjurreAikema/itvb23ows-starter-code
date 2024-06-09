<?php

use PHPUnit\Framework\TestCase;
use Models\Database;
use Helpers\SessionHelper;

class PassTest extends TestCase
{
    private $db;
    private $sessionHelper;

    protected function setUp(): void
    {
        $this->db = $this->createMock(Database::class);
        $this->sessionHelper = $this->createMock(SessionHelper::class);
    }

    public function testPassWithValidSession()
    {
        $_SESSION['player'] = 1;

        $this->db->method('getInstance')->willReturn($this->db);
        $this->db->method('getConnection')->willReturn($this->db);
        $this->db->method('prepare')->willReturn($this->db);
        $this->db->method('execute')->willReturn(true);

        $this->sessionHelper->method('getState')->willReturn('state');

        $this->assertTrue(pass());
    }

//    public function testPassWithInvalidSession()
//    {
//        $_SESSION['player'] = -1;
//
//        $this->assertFalse(pass());
//    }
}
