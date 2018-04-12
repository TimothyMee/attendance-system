<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
	<head>
		<?php include 'include/DB.php'; ?>
		<?php include 'include/head.php'; ?>
		<?php include 'include/queries.php'; ?>
	</head>
	<body>

        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Attendance System</a>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="load('device.php?action=index')">Device</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="load('user.php?action=index')">User</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="load('login.php?action=index')">Login</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="load('log.php?action=index')">Log</a>
                </li>
                <li class="nav-item">
                    <div class="col-md-2 dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            Theme
                        </button>
                        <div class="container dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" onclick="setTheme('dark')" id="dark">Dark</a>
                            <a class="dropdown-item" href="#" onclick="setTheme('light')" id="light">Light</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="content">

					</div>
				</div>
			</div>
		</div>

	<script>
		jQuery(document).ready(function() {

			console.log('ready to use...');

			load('device.php?action=index');

            var theme = localStorage.getItem('theme');

            if (theme == 'dark'){
                $('body').css('background-image', 'url("assets/image/black_paper.png")');
                $('body').css('color', 'white');
            }

		});
	</script>
	</body>
</html>