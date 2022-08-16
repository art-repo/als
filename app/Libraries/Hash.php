<?php

    namespace App\Libraries;

    class Hash {
        
        public static function hashPassword($password)
        {
            return password_hash($password, PASSWORD_BCRYPT);
        }

    }