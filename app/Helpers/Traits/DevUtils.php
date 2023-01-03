<?php

namespace App\Helpers\Traits;

trait DevUtils
{
    // check input argument to be correct values
    // in case if some variable is wrong throws an InvalidArgumentException
    public static function checkArguments(...$args): void
    {
        $argNum = 0;  // the number of input argument

        foreach($args as $arg)  // go through each input argument and check it
        {
            if (!$arg) // if argument is empty
            {
                $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];  // get a name of the caller function
                $message = "ERROR: in the function $caller() input argument #$argNum is empty";

                throw new \InvalidArgumentException($message);
            }

            $argNum++;   // increase the number of input argument
        }
    }

    // makes a proper config key by the type of file
    public static function getConfigKeyByFileType($fileType): string
    {
        $keyParts = explode("_", $fileType);
        return implode(".", $keyParts);  // get a string with a proper config key
    }

    // returns config data by some config key
    public static function getConfig(string $configKey): mixed
    {
        $configData = config($configKey);

        if (!$configData)  // check if data isn't empty
        {
            throw new \RuntimeException("there is an empty data by config key: $configKey");
        }

        return $configData;  // return config data
    }

    // a little modified dd() function
    public static function dd(...$args)
    {
        // get debug backtrace data
        $callerClass = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['class'];        // get a name of the caller class
        $callerFunction = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];  // get a name of the caller function
        $callerLine = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[0]['line'];          // get a string number from where the dd() function was called

        // dump debug backtrace data into the console
        dump("***************************** DEBUG INFO *****************************",
            "Class:    " . $callerClass,
            "Function: " . $callerFunction,
            "Line:     " .$callerLine,
            "Args:     ");

        // dump each of the input arguments into the console
        foreach($args as $arg)
        {
            dump($arg);
        }

        dd(); // stop executing of the program
    }
}