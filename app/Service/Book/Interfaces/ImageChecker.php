<?php



interface ImageChecker
{
    public function check(string $imageContent): bool;
}