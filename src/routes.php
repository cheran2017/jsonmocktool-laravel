<?php


// json mock management
$router->post('jsonmock','JsonMockController@save');
$router->get("jsonmock/elumina/controls","JsonMockController@get");
$router->post("jsonmock/elumina/control","JsonMockController@get");