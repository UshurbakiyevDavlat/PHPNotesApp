<?php

test('it able to bind and resolve', function () {
    //explore
    $container = new \App\Core\Container();

    //act
    $container->bind('test', fn() => 'back');
    $result = $container->resolve('test');

    //expect
    expect($result)->toEqual('back');
});