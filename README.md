# Basic Form Validation with Session Based Messaging

This is a basic form validation class based on Laravel's [far superior] validation tools. I am writing it for my own use on simple hand-rolled projects, practice and learning. So, yeah.

## Installation

The easiest way to use the class is through composer. I've added this to Packagist, again basically for my own convenience. In a terminal with composer installed, run the following:

````
composer require kkiernan/validator
````

Or add the package to your composer.json file and run composer install.

## Validator

### Usage

I am basically copying Laravel here. Create a `Kiernan\Validator` instance, passing it your data and validation rules. Add multiple rules to a field using the pipe separator.

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

### Available Validation Rules

- boolean
- email
- float
- integer
- ip
- required
- url

## Session Based Messages

The examples/full example shows a hand-rolled example that uses the validator along with the session helper that is included. The session class provides a simple way of storing and retrieving messages from a session.

### Usage

The session class uses the singleton pattern to present you with static methods you can call. Before use, you must first create the session instance. This just ensures that a PHP session is available to the class so that you don't have to check for/start a session in all of your scripts.

```
Session::create();
```

The session class has the following methods available:

- Session::flash();
- Session::old();
- Session::has();
- Session::get();
- Session::clear();

### Session::flash()

Add data to the session.

```
Session::flash('success', 'We have received your application. Someone will be in touch shortly.');
```

### Session::old()

Retreive old session data. Returns null if data does not exist. You must first flash old data to the session:

```
if ($validator->fails())
{
	Session::flash('old', $_POST);

	Session::flash('errors', $validator->messages());

	header('Location: index.php');

	exit;
}
```

And then old data can be retrieved:

```
<input type="text" name="name" value="<?php echo Session::old('name') ?>">
```

### Session::has()

Check to see if a key exists in the session. The following example displays a success alert using Twitter Bootstrap styles. 

```
<?php if (Session::has('success')): ?>
	<div class="alert alert-success">
		<?php echo Session::get('success'); ?>
	</div>
<?php endif; ?>
```

### Session::get()

Get a value from the session if it exists. See `Session::has()` example.

### Session::clear()

Clear the session data. This is useful at the bottom of your script if you do not want the session errors, old data, etc to persist across multiple page loads. I'd like to build this into the `Session::flash()` method, but for now you must call clear manually.

```
Session::clear();
```