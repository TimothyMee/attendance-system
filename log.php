<?php
    	include 'include/DB.php';
		 include 'include/queries.php';

		 $queriesObject = new queries();

	if (isset($_GET['action']) && $_GET['action'] == 'index') {
?>
		<script type="text/javascript">

			$('title').html('Log');
		
		</script>
<?php


		$log = $queriesObject->getLog();

		if (count($log) > 0) {

			echo	"<div class='row'>"
					."<div class='col-md-12'>"
						."<table class='table table-bordered table-hover'>"
								."<thead>"
									."<tr>"
										."<th class=''>Log Time</th>"
										."<th class=''>Username</th>"
										."<th class=''>Data</th>"
									."</tr>"
								."</thead>"
								."<tbody>";

			foreach ($log as $row) {

				echo					"<tr>"
				 					."<td>".$row['log_time']."</td>"
				 					."<td>".$row['user_name']."</td>"
				 					."<td><code>".$row['data']."</code></td>"
				 					."</tr>";

			}

			echo
								"</tbody>"
						."</table>"
					."</div>"
				."</div>";

		} else {

			echo 'Log Empty';

		}

	}
?>