<?php

class Test_Class extends Test_Class_Base {

    public function __construct() {
        parent::__construct();

        $this->var = 'test-class';

        dt_write_log( '' );
    }

    public function method() {
        dt_write_log( 'my-updated-method' );
    }
}