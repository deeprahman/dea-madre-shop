<?php
declare(strict_types=1);

class DM_Home_Page extends Page{
    public function __construct(){
        $this->initialize();
    }

        public static function init()
    {
        new self();
    }
}