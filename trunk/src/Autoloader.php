<?php

namespace SimpleStaffList;

class Autoloader
{
    /**
     * @param string $class
     */
    public function autoload($class)
    {
        $len = strlen(__NAMESPACE__);

        if (strncmp(__NAMESPACE__, $class, $len) !== 0) {
            return;
        }

        $filename = __DIR__ . str_replace('\\', '/', substr($class, $len)) . '.php';

        if (file_exists($filename)) {
            require $filename;
        }
    }
}
