<?php

use Kiernan\Session;
use Kiernan\Validator;

require '../../src/Kiernan/Validator.php';
require '../../src/Kiernan/Session.php';

Session::create();

Session::flash('foo', 'Foo');

echo Session::get('foo');

Session::clear();