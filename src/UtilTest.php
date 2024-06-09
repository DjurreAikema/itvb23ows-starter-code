<?php

namespace Core;
require __DIR__ . '/vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase
{
    private $util;

    protected function setUp(): void
    {
        $this->util = new Util();
    }

    public function testIsNeighbour()
    {
        $this->assertTrue($this->util->isNeighbour('1,1', '1,2'));
        $this->assertTrue($this->util->isNeighbour('1,1', '2,1'));
        $this->assertFalse($this->util->isNeighbour('1,1', '3,3'));
    }

    public function testIsNeighbourWithSameXCoordinate()
    {
        $this->assertTrue($this->util->isNeighbour('1,1', '1,2'));
    }

    public function testIsNeighbourWithSameYCoordinate()
    {
        $this->assertTrue($this->util->isNeighbour('1,1', '2,1'));
    }

    public function testIsNotNeighbourWithFarCoordinates()
    {
        $this->assertFalse($this->util->isNeighbour('1,1', '3,3'));
    }

    public function testHasNeighbourWithNeighbouringCoordinates()
    {
        $board = [
            '1,1' => true,
            '1,2' => true,
            '2,2' => false,
            '3,3' => false,
        ];

        $this->assertTrue($this->util->hasNeighbour('1,1', $board));
        $this->assertTrue($this->util->hasNeighbour('1,2', $board));
    }

    public function testNeighboursAreSameColorWithSameColorNeighbours()
    {
        $board = [
            '1,1' => [['player1', 'some other data']],
            '1,2' => [['player1', 'some other data']],
            '2,2' => [['player2', 'some other data']],
            '3,3' => [['player2', 'some other data']],
        ];

        $this->assertTrue($this->util->neighboursAreSameColor('player1', '1,1', $board));
    }

    public function testNeighboursAreSameColorWithDifferentColorNeighbours()
    {
        $board = [
            '1,1' => [['player1', 'some other data']],
            '1,2' => [['player2', 'some other data']],
            '2,2' => [['player2', 'some other data']],
            '3,3' => [['player2', 'some other data']],
        ];

        $this->assertFalse($this->util->neighboursAreSameColor('player1', '1,1', $board));
    }

    public function testNeighboursAreSameColorWithNoNeighbours()
    {
        $board = [
            '1,1' => [['player1', 'some other data']],
            '3,3' => [['player2', 'some other data']],
        ];

        $this->assertTrue($this->util->neighboursAreSameColor('player1', '1,1', $board));
    }

    public function testLenWithNonEmptyArray()
    {
        $tile = ['player1', 'player2', 'player3'];
        $this->assertEquals(3, $this->util->len($tile));
    }

    public function testLenWithEmptyArray()
    {
        $tile = [];
        $this->assertEquals(0, $this->util->len($tile));
    }

    public function testLenWithNull()
    {
        $tile = null;
        $this->assertEquals(0, $this->util->len($tile));
    }

    public function testSlideWithNoNeighbour()
    {
        $board = [
            '1,1' => [['player1', 'some other data']],
            '3,3' => [['player2', 'some other data']],
        ];

        $this->assertFalse($this->util->slide($board, '1,1', '3,3'));
    }

    public function testSlideWithNonNeighbouringTiles()
    {
        $board = [
            '1,1' => [['player1', 'some other data']],
            '1,2' => [['player1', 'some other data']],
        ];

        $this->assertFalse($this->util->slide($board, '1,1', '1,2'));
    }

    public function testSlideWithNeighbouringTilesAndDifferentLengths()
    {
        $board = [
            '1,1' => [['player1', 'some other data']],
            '1,2' => [['player1', 'some other data'], ['player1', 'some other data']],
            '2,2' => [['player1', 'some other data']],
        ];

        $this->assertTrue($this->util->slide($board, '1,1', '1,2'));
    }

    public function testSlideWithNeighbouringTilesAndSameLengths()
    {
        $board = [
            '1,1' => [['player1', 'some other data']],
            '1,2' => [['player1', 'some other data']],
            '2,2' => [['player1', 'some other data']],
        ];

        $this->assertTrue($this->util->slide($board, '1,1', '1,2'));
    }
}