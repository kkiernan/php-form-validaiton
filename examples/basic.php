<?php

use Kiernan\Validator;

require '../vendor/autoload.php';

$validator = new Validator(
	[
		'name' => 'Kelly Kiernan',
		'email' => 'kelly@kellykiernan.com',
		'password' => 'secret',
		'ip_address' => '192.168.0.1',
	],
	[
		'name' => 'required',
		'email' => 'required|email',
		'password' => 'required',
		'ip_address' => 'required|ip',
	]
);

if ($validator->fails())
{
	print_r($validator->messages());
	exit;
}

echo 'Validation passed!';
