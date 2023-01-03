<?php


namespace App\Helpers\Traits;


use RuntimeException;

trait EnvUtils
{
    public static function updateDotEnv($key, $newValue, $delimiter = ''): bool
    {
        try {
            $path = base_path('.env');

            $oldValue = env($key);
            if ($oldValue === $newValue) {
                return true;
            }

            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    $key . '=' . $delimiter . $oldValue . $delimiter,
                    $key . '=' . $delimiter . $newValue . $delimiter,
                    file_get_contents($path)
                ));
            }
            return true;
        } catch (RuntimeException $exception) {
            return false;
        }
    }
}
