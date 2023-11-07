<?php

function str_random(int $num = 10) {
    try
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = strlen($characters);
        $out = '';
        for($i=0;$i<$num;$i++)
            $out .= $characters[random_int(0, $length - 1)];
        
        return $out;
    }
    catch(Exception $e)
    {
        throw new Exception($e, 500);
    }
}