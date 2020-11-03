<?php
class autoloader {

    public function __construct() {
        spl_autoload_extensions('.php');
        spl_autoload_register(array($this, 'load'));
    }
    
    private function load($className) {
        $extension = spl_autoload_extensions();

        $filename = ABS_PATH . '/' . $className . $extension;
        $filename = str_replace('\\', '/', $filename);
        if(file_exists($filename))
        {
            require_once $filename;
            return;
        }             
    }

}