<?php

    function generate_sid($coordinatorModel)
    {
        $numLength = 2;
            $strLength = 4;
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $num = '0123456789';

            $staff_id = 'SID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
            $checkKey = $coordinatorModel->check_sid($staff_id);

            while ($checkKey == true) {
                $staff_id = 'SID' . '-' . substr(str_shuffle($num), 0, $numLength) . substr(str_shuffle($str), 0, $strLength);
                $checkKey = $coordinatorModel->check_sid($staff_id);
            }
            return $staff_id;
    }
    function generate_activation_code($coordinatorModel)
    {
        $num_length = 3;
        $str_length = 3;
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';

        $activation_code = substr(str_shuffle($num), 0, $num_length) . '-' . substr(str_shuffle($str), 0, $str_length) . '-' . substr(str_shuffle($num), 0, $num_length);
        $checkCode = $coordinatorModel->select_activation_code($activation_code);

        while ($checkCode == true) {
            $activation_code = substr(str_shuffle($num), 0, $num_length) . '-' . substr(str_shuffle($str), 0, $str_length) . '-' . substr(str_shuffle($num), 0, $num_length);
            $checkCode = $coordinatorModel->select_activation_code($activation_code);
        }

        return $activation_code;
        
    }

    

    

    

    