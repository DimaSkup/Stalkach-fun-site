<?php

namespace App\Service;

final class ImageGuard
{
    private GoogleVisionClient $googleVision;

    public function __construct(GoogleVisionClient $googleVision)
    {
        $this->googleVision = $googleVision;
    }

    public function check(string $imageContent, bool $weakerRules) : bool
    {
        // cheking
        return true;
    }
}