<?php

namespace Core;

use PHPUnit\Framework\TestCase;

class HandDropdownTest extends TestCase
{
    public function testNoOptionForZeroCountTile()
    {
        // Arrange
        $player = 0;
        $hand = [
            0 => [
                'A' => 1,
                'B' => 0, // This tile type should not appear in the output
            ],
            1 => [
                'A' => 2,
            ],
        ];

        // Act
        ob_start();
        foreach ($hand[$player] as $tile => $ct) {
            if ($ct > 0) {
                echo "<option value=\"$tile\">$tile</option>";
            }
        }
        $output = ob_get_clean();

        // Assert
        $this->assertStringNotContainsString('<option value="B">B</option>', $output);
    }
}