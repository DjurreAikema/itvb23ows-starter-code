<?php

use PHPUnit\Framework\TestCase;
use Models\Database;
use Helpers\SessionHelper;

class UndoTest extends TestCase
{
    private $db;
    private $sessionHelper;

    protected function setUp(): void
    {
        $this->db = $this->createMock(Database::class);
        $this->sessionHelper = $this->createMock(SessionHelper::class);
    }

    public function testUndoWithValidLastMove()
    {
        $_SESSION['last_move'] = 1;

//        $this->db->method('getInstance')->willReturn($this->db);
        $this->db->method('getConnection')->willReturn($this->db);
        $this->db->method('prepare')->willReturn($this->db);
        $this->db->method('execute')->willReturn(true);
        $this->db->method('get_result')->willReturn($this->db);
        $this->db->method('fetch_array')->willReturn([5 => 0, 6 => 'state']);

        $this->sessionHelper->method('setState')->willReturn(true);

        $this->assertTrue(undo());
    }

    public function testUndoWithInvalidLastMove()
    {
        $_SESSION['last_move'] = -1;

        $this->db->method('getInstance')->willReturn($this->db);
        $this->db->method('getConnection')->willReturn($this->db);
        $this->db->method('prepare')->willReturn($this->db);
        $this->db->method('execute')->willReturn(true);
        $this->db->method('get_result')->willReturn($this->db);
        $this->db->method('fetch_array')->willReturn(false);

        $this->assertFalse(undo());
    }
}