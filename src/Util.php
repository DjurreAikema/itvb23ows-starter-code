<?php

namespace Core;

class Util
{
    public function getOffsets(): array
    {
        return [[0, 1], [0, -1], [1, 0], [-1, 0], [-1, 1], [1, -1]];
    }

    public function isNeighbour($a, $b): bool
    {
        $a = explode(',', $a);
        $b = explode(',', $b);
        if (
            ($a[0] == $b[0] && abs($a[1] - $b[1]) == 1)
            || ($a[1] == $b[1] && abs($a[0] - $b[0]) == 1)
            || ($a[0] + $a[1] == $b[0] + $b[1])
        ) {
            return true;
        }
        return false;
    }

    public function hasNeighbour($a, $board): bool
    {
        foreach (array_keys($board) as $b) {
            if ($this->isNeighbour($a, $b)) {
                return true;
            }
        }
        return false;
    }

    public function neighboursAreSameColor($player, $a, $board): bool
    {
        foreach ($board as $b => $st) {
            if (!$st) {
                continue;
            }
            $c = $st[count($st) - 1][0];
            if ($c != $player && $this->isNeighbour($a, $b)) {
                return false;
            }
        }
        return true;
    }

    public function len($tile): int
    {
        return $tile ? count($tile) : 0;
    }

    public function slide($board, $from, $to): bool
    {
        if (!$this->hasNeighBour($to, $board)) {
            return false;
        }
        if (!$this->isNeighbour($from, $to)) {
            return false;
        }
        $b = explode(',', $to);
        $common = [];
        foreach ($this->getOffsets() as $pq) {
            $p = $b[0] + $pq[0];
            $q = $b[1] + $pq[1];
            if ($this->isNeighbour($from, $p . "," . $q)) {
                $common[] = $p . "," . $q;
            }
        }
        return !(!$board[$common[0]] && !$board[$common[1]] && !$board[$from] && !$board[$to])
            && min($this->len($board[$common[0]]), $this->len($board[$common[1]])) <= max($this->len($board[$from]), $this->len($board[$to]));
    }
}
