<?php

use PHPUnit\Framework\TestCase;
use Models\Database;
use Helpers\SessionHelper;

class MoveTest extends TestCase
{
    private $db;
    private $sessionHelper;

    protected function setUp(): void
    {
        $this->db = $this->createMock(Database::class);
        $this->sessionHelper = $this->createMock(SessionHelper::class);
    }

    public function testMoveWithValidMove()
    {
        $_SESSION['player'] = 1;
        $_SESSION['board'] = ['1,1' => [['player1', 'Q']]];
        $_POST['from'] = '1,1';
        $_POST['to'] = '2,2';

//        $this->db->method('getInstance')->willReturn($this->db);
        $this->db->method('getConnection')->willReturn($this->db);
        $this->db->method('prepare')->willReturn($this->db);
        $this->db->method('execute')->willReturn(true);

        $this->sessionHelper->method('getState')->willReturn('state');

        $this->assertTrue(move());
    }

//    public function testMoveWithInvalidMove()
//    {
//        $_SESSION['player'] = 1;
//        $_SESSION['board'] = ['1,1' => [['player1', 'Q']]];
//        $_POST['from'] = '1,1';
//        $_POST['to'] = '1,1';
//
//        $this->assertFalse(move());
//    }
}
