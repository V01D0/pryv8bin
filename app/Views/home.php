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
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<!-- <li id="nav__brand"></li> -->
			<a class="navbar-brand" href=".">BRAND LOGO</a>
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
				<button class="btn btn-outline-success" type="button">Login</button>
				<button class="btn btn-outline-primary" type="button">Register</button>
			</div>
		</div>
	</nav>
	<div class="paste-form">
		<h1 class="paste__heading">New Paste</h1>
		<form action="" method="post">
			<div class="col-10">
				<textarea class="form-control" id="paste-text"></textarea>
			</div>
			<br>
			<div>
				<div class="dropdown">
					<label class="form-check-label" for="expiry">Paste expiration</label>
					<button class="btn btn-secondary dropdown-toggle" id="expiry" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
						Never
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
						<li><a class="dropdown-item" href="#">Action</a></li>
						<li><a class="dropdown-item" href="#">Another action</a></li>
						<li><a class="dropdown-item" href="#">Something else here</a></li>
					</ul>
				</div>
				<br>
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
				<br>
				<button type="submit" id="paste__submit" class="btn btn-success">Submit</button>
			</div>
		</form>
		<br>
	</div>
	<script>
		var cb = document.getElementById("password")
		cb.addEventListener('change', function() {
			if (this.checked) {
				var passwordField = document.getElementById("inputPassword2");
				passwordField.removeAttribute('hidden');
				passwordField.value = generatePassword();
			} else {
				var passwordField = document.getElementById("inputPassword2");
				passwordField.setAttribute('hidden', '')
			}
		});
	</script>
</body>

</html>