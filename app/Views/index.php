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
	<script src="bootstrap/dist/js/bootstrap.bundle.js"></script>
	<script src="js/index.js"></script>
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
				<button class="btn btn-success" type="button">Login</button>
				<button class="btn btn-primary" type="button">Register</button>
			</div>
		</div>
	</nav>
	<div class="paste-form">
		<h1 class="paste__heading">New Paste</h1>
		<!-- <form action="Form_reader/getPOSTinput" method="post">
			<div class="col-10">
				<textarea class="form-control" id="paste-text"></textarea>
			</div>
			<br>
			<div>
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="dropdown">
								<label class="form-check-label">Paste expiration</label>
								<button class="btn btn-secondary dropdown-toggle" id="expiry" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
									Never
								</button>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
									<li><a class="dropdown-item" href="#">Burn after read</a></li>
									<li><button class="dropdown-item" type="button">Action</button></li>
									<li><a class="dropdown-item" href="#">Something else here</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="container">
					<div class="row">
						<div class="col">
							<div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="burn-after-read">
									<label class="form-check-label" for="burn-after-read">
										Burn after read?
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="password">
									<label class="form-check-label" for="password">
										Password?
									</label>
									<div class="form-group col-md-3">
										<div class="w-50">
											<label for="inputPassword2" class="visually-hidden">Password</label>
											<input class="form-control" hidden id="inputPassword2" placeholder="Password">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
					<button type="submit" id="paste__submit" class="btn btn-success">Submit</button>
				</div>
			</div>
		</form> -->
		<?= form_open('paste', 'onsubmit="validate()"') ?>
		<div class="col-10">
			<textarea class="form-control" id="paste-text" oninput="validate()"></textarea>
		</div>
		<br>
		<div>
			<div class="container">
				<div class="row">
					<div class="col">
						<br>
						<div class="dropdown">
							<label class="form-check-label">Paste expiration</label>
							<!-- <button class="btn btn-secondary dropdown-toggle" onclick="getOption()" value="Never" id="expiry" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
								Never
							</button> -->
							<!-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"> -->
							<!-- <li><a class="dropdown-item" href="#">Burn after read</a></li>
								<li><button class="dropdown-item" type="button">Action</button></li>
								<li><a class="dropdown-item" href="#">Something else here</a></li> -->
							<!-- TODO: FIX DROPDOWN MENU -->
							<!-- </ul> -->
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
			<br>
			<div class="container">
				<div class="row">
					<div class="col">
						<div>
							<div class="form-check">
								<input class="form-check-input" checked type="checkbox" value="" id="burn-after-read">
								<label class="form-check-label" for="burn-after-read">
									Burn after read?
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="password">
								<label class="form-check-label" for="password">
									Password?
								</label>
								<div class="form-group col-md-3">
									<div class="w-50">
										<label for="inputPassword2" class="visually-hidden">Password</label>
										<input class="form-control" hidden id="inputPassword2" placeholder="Password">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br>
				<button id="paste__submit" disabled class="btn btn-success">Submit</button>
			</div>
		</div>
		<?= form_close() ?>

		<br>
	</div>
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