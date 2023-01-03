<?php

namespace App\Book\Service;

use ImageChecker;

class WeakImageChecker implements ImageChecker
{
    private ImageGuard $imageGuard;

    public function __construct(ImageGuard $imageGuard)
    {
        $this->imageGuard = $imageGuard;
    }

    public function check(string $imageContent): bool
    {
        return $this->imageGuard->check($imageContent, true);
    }
}