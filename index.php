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
<!--style="background-image: url('assets/image/black_paper.png')"-->
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
            </ul>
        </nav>

                <!--        <nav class="navbar navbar-dark bg-dark" role="navigation">-->
<!--			<div class="container">-->
<!--				<div class="navbar-header">-->
<!--					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">-->
<!--					<span class="sr-only">Toggle navigation</span>-->
<!--					<span class="icon-bar"></span>-->
<!--					<span class="icon-bar"></span>-->
<!--					<span class="icon-bar"></span>-->
<!--					</button>-->
<!--					<a class="navbar-brand" href="#">Attendance System</a>-->
<!--				</div>-->
<!--				<div id="navbar" class="collapse navbar-collapse">-->
<!--					<ul class="nav navbar-nav">-->
<!--						<li><a href="#" onclick="load('device.php?action=index')">Device</a></li>-->
<!--						<li><a href="#" onclick="load('user.php?action=index')">User</a></li>-->
<!--						<li><a href="#" onclick="load('login.php?action=index')">Login</a></li>-->
<!--						<li><a href="#" onclick="load('log.php?action=index')">Log</a></li>-->
<!--					</ul>-->
<!--				</div>-->
<!--			</div>-->
<!--		</nav>-->

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

		});
	</script>
	</body>
</html>