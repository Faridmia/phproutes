<?php
require "Router.php";
use OurApplication\Routing\Router;
// Router::get('/',function() {
//     echo "welcome";
// });

Router::get( '/hello/world', function () {
    echo "hello world";
} );

Router::get( '/greet/(\w+)', function ( $name ) {
    echo "hello {$name}";
} );

Router::get( '/greet/(\w+)/title/(\w+)', function ( $name, $title ) {
    echo "hello {$title} {$name}";
} );

Router::get('/verb',function(){
    echo $_SERVER['REQUEST_METHOD'];
});

Router::post('/verb',function(){
    echo $_SERVER['REQUEST_METHOD'];
});

Router::cleanup();