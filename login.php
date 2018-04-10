<?php
    	 include 'include/DB.php';
		 include 'include/head.php'; 
		 include 'include/queries.php';

		 $queriesObject = new queries();


	if (isset($_GET['action']) && $_GET['action'] == 'index') {
?>

		<script type="text/javascript">

			$('title').html('Login');

			function login_selectuser(device_name, sn) {

			    user_id = $("#select_scan option:selected").attr("user_id");
			    $("#hiddenUserID").val(user_id);
			
				$("#button_login").attr("href","finspot:FingerspotVer;"+$('#select_scan').val())
				
			};

			function continueLogin() {
                userid = $("#hiddenUserID").val();

                $(location).attr('href', 'codeVerification.php' +
                    '?user_id='+userid);
            }

		</script>
		
		<div class="row">
			<div class="col-md-4">

			</div>
			<div class="col-md-4">
				<div class="form-group">

                    <!--Modal trigger-->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" style="float: right;">
                        <i class="fa info-circle" style="float: right;"></i>
                    </button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Verification Process</h4>
                                </div>
                                <div class="modal-body">
                                    <p><h5>Click on Login After selecting your name</h5></p>
                                    <p><h5>Scan Finger</h5></p>
                                    <p><h5>Green indicator shows successful scan, while red shows fingerprints do not match.. try again</h5></p>
                                    <p><h5>If successful, a code will be sent to your registered phone number. You click on Continue Login and enter the Code.</h5></p>
                                    <p><h5>Whaala... You have successfully logged in.</h5></p>

                                    <br>
                                    <p><h5>................................................................................................................................</h5></p>
                                    <p><h5>The verification code should be sent to you within 10 mins. if not restart process again. or contact the Head of IT.</h5></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <br>
                    <br>
                    <label for="user_name">Username</label>

					<select class="form-control" onchange="login_selectuser()" id='select_scan'>
						<option selected disabled="disabled"> -- Select Username -- </option>
							<?php				
								/*$strSQL = "SELECT a.* FROM demo_user AS a JOIN demo_finger AS b ON a.user_id=b.user_id";
								$result = mysql_query($strSQL);*/

								$result = $queriesObject->selectFinger();
								$base_path = 'http://localhost/myWork/fingerprintSample/code/';

								foreach ($result as $row){

									$value = base64_encode($base_path."verification.php?user_id=".$row['user_id']);
								
									echo "<option value=$value id='option' user_id='".$row['user_id']."' user_name='".$row['user_name']."'>$row[user_name]</option>";
								}
							?>
					</select>


                        <input type='hidden' value='' name='userid' id='hiddenUserID'>
				</div>
				<a href="" id="button_login" type="submit" class="btn btn-primary" name="login">Login</a>

<!--                <h5 style="float: right">Got Confirmation Code? <a href="#" onclick="continueLogin()">Continue Login</a></h5>-->
			</div>
			<div class="col-md-4">

			</div>
		</div>

<?php
	}
?>