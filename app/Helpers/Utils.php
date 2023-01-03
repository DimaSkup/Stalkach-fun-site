<?php


namespace App\Helpers;


use App\Helpers\Traits\DevUtils;
use App\Helpers\Traits\EnvUtils;
use App\Helpers\Traits\FileUtils;
use App\Helpers\Traits\FormatUtils;
use App\Helpers\Traits\TextUtils;

class Utils
{
    use EnvUtils;
    use FileUtils;
    use FormatUtils;
    use TextUtils;
    use DevUtils;
}
