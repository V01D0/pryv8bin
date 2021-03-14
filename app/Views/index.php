<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Pryv8bin</title>
	<meta name="description" content="Self-hosted pastebin alternative">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
	<link rel="manifest" href="/icons/site.webmanifest">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
	<script src="/bootstrap/dist/js/bootstrap.bundle.js"></script>
	<script src="/js/index.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-info">
		<div class="container-fluid">
			<!-- <li id="nav__brand"></li> -->
			<a class="navbar-brand" href=".">Pryv8bin</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="docs">API</a>
						<!-- NOT USING VIEW ^^^ -->
					</li>
					<li class="nav-item">
						<a class="nav-link" href="faq">FAQ</a>
						<!-- NOT USING VIEW ^^^ -->
					</li>
				</ul>
			</div>
			<div class="d-flex">
				<button class="btn btn-success" type="button" onclick="location.href='./login'">Login</button>
				<button class="btn btn-primary" type="button" onclick="location.href='./register'">Register</button>

			</div>
		</div>
	</nav>
	<div class="paste-form">
		<h1 class="paste__heading">New Paste</h1>
		<?= form_open('paste', 'onsubmit="validate()"') ?>
		<div class="col-10">
			<textarea class="form-control" name="paste_content" id="paste-text" oninput="validate()"></textarea>
		</div>
		<br>
		<div>
			<div class="container">
				<div class="row">
					<div class="col">
						<br>
						<div class="dropdown">
							<br>
							<label class="form-check-label">Paste expiration</label>
							<?php
							$options = [
								'never' => 'Never',
								'bar' => 'Burn after read',
								'm10' => '10 Minutes',
								'd1' => '1 Day',
								'w1' => '1 Week',
								'w2' => '2 Weeks',
								'm1' => '1 Month',
								'm6' => '6 Months',
								'y1' => '1 Year'
							];
							echo form_dropdown('expiry', $options, 'bar', 'id=expiry onchange="uncheck()"');
							?>
							<br>
							<br>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col">
						<div>
							<div class="form-group col-md-3">
								<div class="w-50">
									<!-- <label class="form-check-label" for="Title">Title</label>
									<input class="form-control" id="Title" name="title" placeholder="Title"> -->
									<div class="form-group">
										<label for="title">Title</label>
										<input class="form-control" id="title" name="title">
									</div>
								</div>
							</div>
							<br>
							<div class="custom-control custom-checkbox">
								<!-- <div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="burn-after-read" checked>
									<label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
								</div> -->
								<!-- <input class="form-check-input" checked type="checkbox" value="" id="burn-after-read"> -->
								<!-- <input type="checkbox" class="custom-control-input" id="burn-after-read">
								<label class="form-check-label" for="burn-after-read">
									Burn after read?
								</label> -->
								<input type="checkbox" checked class="custom-control-input" id="burn-after-read">
								<label class="custom-control-label" for="burn-after-read">Burn after read?</label>
							</div>
							<!-- <div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="password">
								<label class="form-check-label" for="password">
									Password?
								</label> -->
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="password">
								<label class="custom-control-label" for="password">Password?</label>
							</div>
							<div class="form-group col-md-3">
								<div class="w-50">
									<input class="form-control" hidden id="inputPassword2" name="password" value="">
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="text-center"> -->
				<button id="paste__submit" name="submit" type="submit" value="Submit" disabled class="btn btn-success">Submit</button>
				<!-- </div> -->
			</div>
			<br>
			<?= form_close() ?>
			<br>
		</div>
		<br>
	</div>
	<footer class="bg-light text-center text-lg-start">
		<!-- Copyright -->
		<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
			© 2021 Copyright:
			<p>pryv8bin - made with ❤️ by <a class="text-dark" href="https://pryv8.org"> pryv8</a></p>
		</div>
		<!-- Copyright -->
	</footer>
	<script>
		function init() {
			document.getElementById("paste-text").focus();
		}
		let cb = document.getElementById("password")
		cb.addEventListener('change', function() {
			if (this.checked) {
				let passwordField = document.getElementById("inputPassword2");
				passwordField.removeAttribute('hidden');
				passwordField.value = generatePassword();
			} else {
				let passwordField = document.getElementById("inputPassword2");
				passwordField.setAttribute('hidden', '')
			}
		});

		cb = document.getElementById("burn-after-read");
		cb.addEventListener('change', function() {
			if (this.checked) {
				changeOption("bar");
			} else {
				changeOption("never");
			}
		});
		init();
	</script>
</body>

</html>