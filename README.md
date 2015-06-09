# Basic Form Validator

This is a basic form validation class based on Laravel's much superior validation tools. I am writing it for my own use on simple hand-rolled projects, practice and learning. So, yeah.

## Installation

The easier way to use this class is through composer. In a terminal, run the following:

````
composer require kkiernan/vadlidator
````

If you aren't using composer, download the source and require the validator file in your project. Note that the class exists in the Kiernan namespace. You can import the class like follows:

```
use Kiernan\Validator;
```

## Usage

It is used similar to the way Laravel's basic validation is used. Create a `Kiernan\Validator` instance, passing it your data and validation rules.

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

Once you've created the validator, you can call either the `Validator::fails()` or `Validator::passes()` methods. For example:
```
if ($validator->fails())
{
    // Validation has failed
}
```

If validation has failed, you can retrieve the error messages by calling `Validator::messages()`.

```
print_r($validation->messages());
```