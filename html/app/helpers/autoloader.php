<?php
class autoloader {

    public function __construct() {
        spl_autoload_extensions('.php');
        spl_autoload_register(array($this, 'load'));
    }
    
    private function load($className) {
        $extension = spl_autoload_extensions();

        $directories = array(
            'app/helpers/',
            'app/installer/'
        );
       
        //for each directory
        foreach($directories as $directory)
        {
            //see if the file exsists
            if(file_exists(ABS_PATH . '/'. $directory.$className . $extension))
            {
                require_once (ABS_PATH . '/'. $directory.$className . $extension);
                return;
            }           
        }  
    }

}