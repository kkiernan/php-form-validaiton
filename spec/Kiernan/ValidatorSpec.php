<?php namespace spec\Kiernan;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ValidatorSpec extends ObjectBehavior {

	function let()
	{
		$this->beConstructedWith(
			[
				'name' => 'Kelly Kiernan',
				'email' => 'kelly@kellykiernan.com',
				'is_admin' => true,
			],
			[
				'name' => 'required',
				'email' => 'required',
				'is_admin' => 'boolean',
			]
		);
	}

	function it_is_initializable()
	{
		$this->shouldHaveType('Kiernan\Validator');
	}

	function the_default_example_passes_validation()
	{
		$this->passes()->shouldBe(true);
	}

	function it_requires_all_required_fields()
	{
		$this->beConstructedWith(
			['name' => 'Kelly'],
			['name' => 'required', 'email' => 'required']
		);

		$this->passes()->shouldBe(false);

		$this->messages()->shouldBe(['The email field is required.']);
	}

	function it_does_not_allow_empty_strings_for_required_fields()
	{
		$this->beConstructedWith(
			['name' => '   '],
			['name' => 'required']
		);

		$this->passes()->shouldBe(false);

		$this->messages()->shouldBe(['The name field is required.']);
	}

	function it_does_not_allow_null_values_for_required_fields()
	{
		$this->beConstructedWith(
			['name' => null],
			['name' => 'required']
		);

		$this->passes()->shouldBe(false);

		$this->messages()->shouldBe(['The name field is required.']);
	}

	function it_passes_validation_when_all_required_attributes_are_valid()
	{
		$this->beConstructedWith(
			['first_name' => 'Kelly', 'last_name' => 'Kiernan'],
			['first_name' => 'required', 'last_name' => 'required']
		);

		$this->passes()->shouldBe(true);
	}

	function it_validates_email_addresses()
	{
		$this->beConstructedWith(
			['email' => 'kelly@kellykiernan.com'],
			['email' => 'email']
		);

		$this->passes()->shouldBe(true);
	}

	function it_does_not_allow_invalid_email_addresses()
	{
		$this->beConstructedWith(
			['email' => 'not a valid address'],
			['email' => 'email']
		);

		$this->passes()->shouldBe(false);

		$this->messages()->shouldBe(['The email field must be an email address.']);
	}

	function it_validates_a_boolean()
	{
		$this->beConstructedWith(
			['foo' => true],
			['foo' => 'boolean']
		);

		$this->passes()->shouldBe(true);
	}

	function it_does_not_allow_an_invalid_boolean()
	{
		$this->beConstructedWith(
			['foo' => 'not a valid bool'],
			['foo' => 'boolean']
		);

		$this->passes()->shouldBe(false);

		$this->messages()->shouldBe(['The foo field must be true or false.']);
	}

	function it_validates_a_url()
	{
		$this->beConstructedWith(
			['website' => 'http://www.google.com'],
			['website' => 'url']
		);

		$this->passes()->shouldBe(true);
	}

	function it_does_not_allow_an_invalid_url()
	{
		$this->beConstructedWith(
			['website' => 'google.com'],
			['website' => 'url']
		);

		$this->passes()->shouldBe(false);

		$this->messages()->shouldBe(['The website field must be a URL.']);
	}

	function it_validates_an_ip_address()
	{
		$this->beConstructedWith(
			['my_ip' => '192.168.0.1'],
			['my_ip' => 'ip']
		);

		$this->passes()->shouldBe(true);
	}

	function it_does_not_allow_an_invalid_ip_address()
	{
		$this->beConstructedWith(
			['my_ip' => '192.168'],
			['my_ip' => 'ip']
		);

		$this->passes()->shouldBe(false);

		$this->messages()->shouldBe(['The my_ip field must be an ip address.']);
	}

	function it_validates_a_required_email_address()
	{
		$this->beConstructedWith(
			['email' => 'kelly@kellykiernan.com'],
			['email' => 'required|email']
		);

		$this->passes()->shouldBe(true);
	}

	function it_does_not_required_optional_fields()
	{
		$this->beConstructedWith(
			[],
			['email' => 'email']
		);

		$this->passes()->shouldBe(true);
	}

	function it_validates_a_float()
	{
		$this->beConstructedWith(
			['pi' => 3.14],
			['pi' => 'float']
		);

		$this->passes()->shouldBe(true);
	}

	function it_does_not_allow_invalid_floats()
	{
		$this->beConstructedWith(
			['pi' => 'not even a number...'],
			['pi' => 'float']
		);

		$this->passes()->shouldBe(false);

		$this->messages()->shouldBe(['The pi field must be a float.']);
	}

	function it_validates_an_integer()
	{
		$this->beConstructedWith(
			['age' => 26],
			['age' => 'integer']
		);

		$this->passes()->shouldBe(true);
	}

	function it_does_not_allow_invalid_integers()
	{
		$this->beConstructedWith(
			['age' => 'not even a number...'],
			['age' => 'integer']
		);

		$this->passes()->shouldBe(false);

		$this->messages()->shouldBe(['The age field must be an integer.']);
	}

	function it_validates()
	{
		$this->beConstructedWith(
			[
				'name' => 'Kelly Kiernan',
				'ip' => '192.168',
				'email' => 'kelly.com',
				'url' => 'google.com',
				'is_admin' => 'no',
			],
			[
				'name' => 'required',
				'ip' => 'required|ip',
				'email' => 'required|email',
				'url' => 'url',
				'is_admin' => 'boolean',
			]
		);

		$this->passes()->shouldBe(false);

		$this->messages()->shouldBe([
			'The ip field must be an ip address.',
			'The email field must be an email address.',
			'The url field must be a URL.',
			'The is_admin field must be true or false.'
		]);
	}

}
