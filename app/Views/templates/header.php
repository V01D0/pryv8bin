<!doctype html>
<html>

<head>
    <?php
        if(isset($title))
            echo '<title>'.$title.'</title>';
        else
            echo '<title>Pryv8bin</title>';
    ?>
    <meta name="description" content="Self-hosted pastebin alternative">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= link_tag('css/style.css', 'stylesheet') ?>
    <?= script_tag('js/index.js') ?>
    <?= script_tag('bootstrap/js/bootstrap.bundle.js') ?>
    <?= link_tag('bootstrap/css/bootstrap.min.css', 'stylesheet') ?>
    <?= link_tag('icons/apple-touch-icon.png', 'apple-touch-icon') ?>
    <?= link_tag('icons/apple-touch-icon.png', 'apple-touch-icon', 'image/png') ?>
    <?= link_tag('icons/favicon-32x32.png', 'icon', 'image/png') ?>
    <?= link_tag('icons/favicon-16x16.png', 'icon', 'image/png') ?>
    <?= link_tag('icons/site.webmanifest', 'manifest') ?>
</head>

<body>
    <div class="flex-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <!-- <li id="nav__brand"></li> -->
                <a class="navbar-brand" href="<?= base_url() ?>">Pryv8bin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../docs">API</a>
                            <!-- NOT USING VIEW ^^^ -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../faq">FAQ</a>
                            <!-- NOT USING VIEW ^^^ -->
                        </li>
                    </ul>
                </div>
                <div class="d-flex">
				<?php if(!session()->has('loggedin'))
				{
					?>
					<button class="btn btn-success" type="button" onclick="location.href='/login'">Login</button>
					<button class="btn btn-primary" type="button" onclick="location.href='/register'">Register</button>
				<?php
				}
				else
				{ ?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= session('username') ?> </a>
						<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
							<li><a class="dropdown-item" href="#">Profile</a></li>
							<li><a class="dropdown-item" href="/settings">Settings</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="/logout">Logout</a></li>
						</ul>
               		</li>					
				<?php
				}
                ?>
			</div>
            </div>
        </nav>