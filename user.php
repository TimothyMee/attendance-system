<?php
    	include 'include/DB.php';
		 include 'include/queries.php';

		 $queriesObject =  new queries();
		 /*echo $result = "<a href='finspot:FingerspotReg;aHR0cDovLzU0LjE2OS4yMzEuMTQyL2RlbW9fZmxleGNvZGVzZGsvcmVnaXN0ZXIucGhwP3VzZXJfaWQ9MjUwNQ=='>
                    Click and lets see
                </a>";*/

    /*$verification2 = base64_encode("http://localhost/myWork/fingerprintSample/code/register.php?user_id=4");

echo "<a href='finspot:FingerspotReg;$verification2'>
            Click and lets see
        </a>";*/

	if (isset($_GET['action']) && $_GET['action'] == 'index') {
?>

		<script type="text/javascript">

			$('title').html('User');

			function user_delete(user_id, user_name) {

				var r = confirm("Delete user "+user_name+" ?");

				if (r == true) {

					push('user.php?action=delete&user_id='+user_id);

				}
			}
			
			function user_register(user_id, user_name) {
				
				$('body').ajaxMask();
			
				regStats = 0;
				regCt = -1;
				try
				{
					timer_register.stop();
				}
				catch(err)	
				{
					console.log('Registration timer has been init');
				}
				
				
				var limit = 4;
				var ct = 1;
				var timeout = 5000;
				
				timer_register = $.timer(timeout, function() {					
					console.log("'"+user_name+"' registration checking...");
                    console.log($("#user_finger_"+user_id).html());

					user_checkregister(user_id,$("#user_finger_"+user_id).html());
					if (ct>=limit || regStats==1) 
					{
						timer_register.stop();
						console.log("'"+user_name+"' registration checking end");
						if (ct>=limit && regStats==0)
						{
							/*alert("'"+user_name+"' registration fail!");*/
							load('#');
							$('body').ajaxMask({ stop: true });
						}						
						if (regStats>0)
						{
							$("#user_finger_"+user_id).html(regCt);
							alert("'"+user_name+"' registration success!");
							$('body').ajaxMask({ stop: true });
							load('user.php?action=index');
						}
					}
					ct++;
				});
			}
			
			function user_checkregister(user_id, current) {
				$.ajax({
					url			:	"user.php?action=checkreg&user_id="+user_id+"&current="+current,
					type		:	"GET",
					success		:	function(data)
									{
										try
										{
											var res = jQuery.parseJSON(data);	
											if (res.result)
											{
												regStats = 1;
												$.each(res, function(key, value){
													if (key=='current')
													{														
														regCt = value;
													}
												});
											}
										}
										catch(err)
										{
											alert(err.message);
										}
									}
				});
			}

		</script>

		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-primary" onclick="load('user.php?action=create')">Add</button>
			</div>
		</div>
		<br>

<?php

		$user = $queriesObject->getUser();

		if (count($user) > 0) {

			echo	"<div class='row'>"
					."<div class='col-md-12'>"
						."<table class='table table-bordered table-hover'>"
								."<thead>"
									."<tr>"
										."<th class=''>User ID</th>"
										."<th class=''>Username</th>"
										."<th class=''>Template</th>"
										."<th class=''>Action</th>"
									."</tr>"
								."</thead>"
								."<tbody>";

			foreach ($user as $row) {

				$finger 			= $queriesObject->getUserFinger($row['user_id']);
				$register			= '';
				$verification		= '';
				$url_register		= base64_encode("http://localhost/myWork/fingerprintSample/code/register.php?user_id=".$row['user_id']);
				$url_verification	= base64_encode("http://localhost/myWork/fingerprintSample/code/verification.php?user_id=".$row['user_id']);

				if (count($finger) == 0) {

					$register = "<a href='finspot:FingerspotReg;$url_register' class='btn btn-xs btn-primary' onclick=\"user_register('".$row['user_id']."','".$row['user_name']."')\">Register</a>";
				} else {
					
					$verification = "<a href='#' onclick=\"load('login.php?action=index')\" class='btn btn-xs btn-success'>Login</a>";
					
				}

				echo					"<tr>"
				 					."<td>".$row['user_id']."</td>"
				 					."<td>".$row['user_name']."</td>"
				 					."<td><code id='user_finger_".$row['user_id']."'>".count($finger)."</code></td>"
				 					."<td>"
										."<button type='button' class='btn btn-xs btn-danger' onclick=\"user_delete('".$row['user_id']."','".$row['user_name']."')\">Delete</button>"
										."&nbsp"
										."$register"
										."$verification"
									."</td>"
				 					."</tr>";

			}

			echo
								"</tbody>"
						."</table>"
					."</div>"
				."</div>";

		} else {

			echo 'User Empty';

		}

	} elseif (isset($_GET['action']) && $_GET['action'] == 'create') {
?>

		<script type="text/javascript">

			$('title').html('Add user');

			function user_store() {

                email	= $('#email').val();
                user_name	= $('#user_name').val();
				telephone	= $('#telephone').val();

				push('user.php?action=store&user_name='+user_name+'&email='+email+'&telephone='+telephone);

			}

		</script>

		<div class="row">
			<div class="col-md-4">

			</div>
			<div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Add User</div>
                </div>
                <hr>
				<div class="form-group">
					<label for="user_name">Username</label>
					<input type="text"  id="user_name" class="form-control" placeholder="Enter Username">
				</div>

                <div class="form-group">
                    <label for="user_name">email</label>
                    <input type="text"  id="email" class="form-control" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label for="user_name">Telephone</label>
                    <input type="text"  id="telephone" class="form-control" placeholder="Enter valid telephone number">
                </div>


				<a class="btn btn-default" onclick="load('user.php?action=index')">Back</a>
				<button type="submit" class="btn btn-primary" onclick="user_store()">Save</button>
			</div>
			<div class="col-md-4">

			</div>
		</div>

<?php
	} elseif (isset($_GET['action']) && $_GET['action'] == 'store') {

		$res = array();
        		$res['result'] 	= false;

		if ($_GET['user_name'] == '' || !isset($_GET['user_name']) || empty($_GET['user_name'])) {

			$res['user_name'] = "username can't be empty";

		}
        if ($_GET['email'] == '' || !isset($_GET['email']) || empty($_GET['email'])) {

            $res['email'] = "Email can't be empty";

        }
        if ($_GET['telephone'] == '' || !isset($_GET['telephone']) || empty($_GET['telephone'])) {

            $res['telephone'] = "Telephone can't be empty";

        }
        elseif (isset($_GET['user_name']) && !empty($_GET['user_name']) && isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['telephone']) && !empty($_GET['telephone'])) {

			$user_name = $queriesObject->checkUserName($_GET['user_name']);

			if ($user_name != 1) {

				$res['user_name'] = $user_name;

			}

		}

		if (count($res) > 1) {

			echo json_encode($res);

		} else {

			$data = [
					'user_name' => $_GET['user_name'],
					'email' => $_GET['email'],
					'telephone' => $_GET['telephone']
			];

			$result = $queriesObject->insertNewUser($data);
			
			if ($result) {

				$res['result']	= true;
				$res['reload'] 	= "user.php?action=index";
			} else {

                $res['reload'] 	= "user.php?action=index";

			}

			echo json_encode($res);

		}

	} elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {


		$result	= $queriesObject->deleteUser($_GET['user_id']);

		if ($result) {

			$res['result'] 	= true;
			$res['reload'] 	= "user.php?action=index";

		} else {

			$res['server'] 	= "Error delete data!#".$sql1;

		}

		echo json_encode($res);

	} elseif (isset ($_GET['action']) && $_GET['action'] == 'checkreg') {

		/*echo $data = [
					'user_id' => $_GET['user_id'],
				];*/

		/*echo $_GET['user_id'];*/

        $data1 = $queriesObject->selectCountOfExistingFinger($_GET['user_id']);

		$test = intval($data1['ct']);

		/*echo "<script>console.log($test);</script>";*/

		if (intval($data1['ct']) > intval($_GET['current'])) {
			echo $res['result'] = true;
            echo $res['current'] = intval($data1['ct']);
		}
		else
		{
			$res['result'] = false;
		}
		echo json_encode($res);
		
	} else {

		echo "Parameter invalid..";

	}
?>