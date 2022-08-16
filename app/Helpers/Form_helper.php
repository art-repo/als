<?php

    function display_error($validation, $field)
    {
        if($validation->hasError($field)){
            return $validation->getError($field);
        }else{
            return false;
        }
    }

    function generate_oid()
    {
        $numLength = 2;
        $strLength = 4;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';
        return 'OID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
    }