<?php

declare(strict_types=1);

namespace App\Helper;

//use Psr\Http\Message\ResponseInterface as Response;

final class InputUpdate
{
    public static function addMissingDefault(
        Array $input
    ): Array {
        if(!isset($input['created_at'])){
            $input['created_at'] = date('Y-m-d H:i:s', time());
        }
        if(!isset($input['updated_at'])){
            $input['updated_at'] = date('Y-m-d H:i:s', time());
        }
       
        return $input;
    }
}
