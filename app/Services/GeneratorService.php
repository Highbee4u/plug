<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneratorService
{

    private function create_string($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    private function check_db($string, $table, $column)
    {
        return DB::table($table)->select($column)->where($column, '=', $string)->first() ?? false;
    }

    public function generate_string_code($length, $table = null, $column = null)
    {


        if(!isset($length) && !is_numeric($length))
        {
            return false;
        }

        $code = $this->create_string($length);

        if(!isset($table) || !isset($column))
        {
            return $code;
        }

        $check_table = $this->check_db($code, $table, $column);
        if ($check_table)
        {
            $code =  $this->generate_string_code($length, $table, $column);
        }

        return $code;

    }
}