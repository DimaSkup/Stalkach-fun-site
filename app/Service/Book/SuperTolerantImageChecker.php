<?php

namespace App\Book\Service;

use ImageChecker;

class SuperTolerantImageChecker implements ImageChecker
{
    public function check(string $imageContent): bool
    {
        return true;
    }
}