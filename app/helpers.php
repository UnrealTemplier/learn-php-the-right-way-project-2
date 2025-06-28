<?php

declare(strict_types=1);

function d(...$objects): void
{
    echo '<pre>';
    var_dump(...$objects);
    echo '</pre>';
}

function dd(...$objects): never
{
    echo '<pre>';
    var_dump(...$objects);
    echo '</pre>';
    die();
}

function print_array(array $array): void
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function print_line(...$values): void
{
    foreach ($values as $value) {
        echo $value . '<br />';
    }
}

function print_formatted(...$values): void
{
    echo '<pre>';
    print_line(...$values);
    echo '</pre>';
}


