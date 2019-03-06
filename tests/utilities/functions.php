<?php


function create($class, $attributes = [], $times = null)
{
    $class::flushEventListeners();
    return factory($class, $times)->create($attributes);
}


function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}

function createWithEvents($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}
