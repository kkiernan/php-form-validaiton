# Basic Form Validator

This is a basic form validation class based on Laravel's much superior validation tools. I am writing it for my own use on simple hand-rolled projects, practice and learning. So, yeah.

## Installation

The easiest way to use the class is through composer. In a terminal with composer installed, run the following:

````
composer require kkiernan/validator
````

## Usage

Since I basically am learning from Laravel here, it is used basically the same way. Create a `Kiernan\Validator` instance, passing it your data and validation rules. Add multiple rules to a field using the pipe separator.

```
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
```

Once you've created the validator instance, you can call either the `Validator::fails()` or `Validator::passes()` methods. For example:
```
if ($validator->fails())
{
    // Validation has failed
}

if ($validator->passes())
{
	// Validation has passed
}
```

If validation has failed, you can retrieve the error messages by calling `Validator::messages()`.

```
print_r($validator->messages());
```

## Available Validation Rules

- boolean
- email
- ip
- required
- url
- float