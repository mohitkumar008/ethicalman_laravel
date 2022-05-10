<?php
function prx($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}

function getUserTempId()
{
    if (session()->has('USER_TEMP_ID') == '') {
        $rand = rand(0, PHP_INT_MAX);
        session()->put('USER_TEMP_ID', $rand);
        return $rand;
    } else {
        // return '1234';
        return session()->get('USER_TEMP_ID');
    }
}

function test()
{
    dd(":(");
}
