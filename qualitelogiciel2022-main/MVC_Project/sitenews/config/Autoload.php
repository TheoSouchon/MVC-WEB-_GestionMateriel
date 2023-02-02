<?php

// Autoload class to automatically load necessary files for the application
class Autoload
{
    private static $_instance=null;    
    /** 
     * Method to start autoload and register the _autoload function
     */
    public static function charger() {
        if(null!==self::$_instance) {
            throw new RuntimeException(sprintf('%s is already started',__CLASS__));
        }
        self::$_instance=new self();
        if(!spl_autoload_register(array(self::$_instance, '_autoload'), false)) {
            throw new RuntimeException(sprintf('%s Could not start the autoload',__CLASS__));
        }
    }

     /** 
     * Function used to load the file corresponding to the class passed as a parameter
     * @param string $class
     */
    private static function _autoload($class) {
        $filename = $class.'.php';
        $dir =array('modeles/modeles/','modeles/gateways/','modeles/classes/','config/','controleur/');
        foreach ($dir as $d){
            $file=$d.$filename;
            if (file_exists($file)){
                include $file;
            }
        }
    }


}