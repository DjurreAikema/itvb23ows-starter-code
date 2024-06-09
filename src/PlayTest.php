<?php

use PHPUnit\Framework\TestCase;
use Models\Database;
use Helpers\SessionHelper;

class PlayTest extends TestCase
{
    private $db;
    private $sessionHelper;

    protected function setUp(): void
    {
        $this->db = $this->createMock(Database::class);
        $this->sessionHelper = $this->createMock(SessionHelper::class);
    }

    public function testPlayWithValidMove()
    {
        $_SESSION['player'] = 1;
        $_SESSION['board'] = [];
        $_SESSION['hand'] = [1 => ['Q' => 1]];
        $_POST['piece'] = 'Q';
        $_POST['to'] = '1,1';

        $this->db->method('getInstance')->willReturn($this->db);
        $this->db->method('getConnection')->willReturn($this->db);
        $this->db->method('prepare')->willReturn($this->db);
        $this->db->method('execute')->willReturn(true);

        $this->sessionHelper->method('getState')->willReturn('state');

        $this->assertTrue(play());
    }

//    public function testPlayWithInvalidMove()
//    {
//        $_SESSION['player'] = 1;
//        $_SESSION['board'] = ['1,1' => [['player1', 'Q']]];
//        $_SESSION['hand'] = [1 => ['Q' => 1]];
//        $_POST['piece'] = 'Q';
//        $_POST['to'] = '1,1';
//
//        $this->assertFalse(play());
//    }
}
