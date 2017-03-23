<?php

echo 123;die;
$reflection = new ReflectionFunction('a');
var_export($reflection->getFileName());

//a();
function a(){
    $backtrace = debug_backtrace();
    var_export($backtrace);die;
}

die;

class User{
}
$user = new User();
echo spl_object_hash($user);
die;

$remote_address = '127.0.0.1';
$new_socket = @stream_socket_accept($socket, 0, $remote_address);
stream_set_blocking($socket, 0);
