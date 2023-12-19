<?php

namespace Pstoregr\Myaade;

function dd()
{
    foreach (func_get_args() as $x) {
        dump($x);
    }
    die();
}
