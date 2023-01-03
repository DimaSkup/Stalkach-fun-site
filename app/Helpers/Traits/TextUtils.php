<?php


namespace App\Helpers\Traits;


use InvalidArgumentException;
use JsonException;
use stdClass;

trait TextUtils
{
    public static function jsonEncode($value, int $options = 0, int $depth = 512): string
    {
        try {
            $json = json_encode($value, JSON_THROW_ON_ERROR | $options, $depth);
            if(JSON_ERROR_NONE !== json_last_error()) {
                throw new InvalidArgumentException('JSON encode error: ' . json_last_error_msg());
            }
        } catch (JsonException $e) {
            // TODO: LOGGER
        }
        return $json ?? '';
    }

    public static function jsonDecode(?string $json, bool $assoc = false, int $depth = 512, int $options = 0)
    {
        try {
            $data = json_decode($json, $assoc, $depth, JSON_THROW_ON_ERROR | $options);
        } catch (JsonException $e) {
            // TODO: LOGGER
        }
        return $data ?? ($assoc ? [] : new stdClass());
    }
}
