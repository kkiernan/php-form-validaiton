<?php

use Kiernan\Validator;
use Kiernan\Session;

require '../../src/Kiernan/Validator.php';
require '../../src/Kiernan/Session.php';

Session::create();

$validator = new Validator(
	[
		'name' => $_POST['name'],
		'email' => $_POST['email'],
		'ip_address' => $_POST['ip_address'],
		'website' => $_POST['website'],
		'age' => $_POST['age'],
	],
	[
		'name' => 'required',
		'email' => 'required|email',
		'ip_address' => 'ip',
		'website' => 'url',
		'age' => 'required|integer',
	]
);

if ($validator->fails()) {
	Session::flash('old', $_POST);
	Session::flash('errors', $validator->messages());
	header('Location: index.php');
	exit;
}

Session::flash('success', 'Form submitted successfully');

header('Location: index.php');
