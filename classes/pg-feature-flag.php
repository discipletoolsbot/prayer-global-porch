<?php

class PG_Feature_Flag {

    const PREFIX = 'pg_flag_';
    public $flag_name;

    public function __construct( string $flag_name ) {
        $this->flag_name = self::PREFIX . $flag_name;
    }

    public function is_on() {
        $flag = get_option( $this->flag_name );

        if ( !$flag ) {
            return false;
        }

        return true;
    }
}