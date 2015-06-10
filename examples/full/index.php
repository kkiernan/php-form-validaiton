<?php

use Kiernan\Session;

require '../../src/Kiernan/Session.php';

Session::create();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>kkiernan/validator</title>

		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1 class="text-center">Example Validation</h1>
			</div>

			<?php if (Session::has('errors')): ?>
				<ul class="list-unstyled alert alert-danger">
					<?php foreach (Session::get('errors') as $error): ?>
						<li><?php echo $error; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if (Session::has('success')): ?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<?php echo Session::get('success'); ?>
				</div>
			<?php endif; ?>

			<form method="POST" action="submit.php" novalidate>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" class="form-control" value="<?php echo Session::old('name') ?>" placeholder="Enter your full name">
				</div>

				<div class="form-group">
					<label for="name">Email</label>
					<input type="text" name="email" class="form-control" value="<?php echo Session::old('email') ?>" placeholder="Enter your email address">
				</div>

				<div class="form-group">
					<label for="name">IP Address</label>
					<input type="text" name="ip_address" class="form-control" value="<?php echo Session::old('ip_address') ?>" placeholder="Enter your ip address">
				</div>

				<div class="form-group">
					<label for="name">Website</label>
					<input type="text" name="website" class="form-control" value="<?php echo Session::old('website') ?>" placeholder="Enter your website URL">
				</div>

				<div class="form-group">
					<label for="name">Age</label>
					<input type="text" name="age" class="form-control" value="<?php echo Session::old('age') ?>" placeholder="Enter your age">
				</div>

				<div class="radio">
					<label>
						<input type="radio" name="is_admin" value="1" <?php echo Session::old('is_admin') === '1' ? 'checked' : '' ?>> This user is an admin
					</label>
				</div>

				<div class="radio">
					<label>
						<input type="radio" name="is_admin" value="0" <?php echo Session::old('is_admin') === '0' ? 'checked' : '' ?>> This user is a staff member
					</label>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Submit Form</button>
				</div>
			</form>
		</div>

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>

<?php

Session::clear();

?>