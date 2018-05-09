

<?php
	session_start();

$cookie_name = "cookieUser2";
$cookie_value = "new cookie2";
$sessionID=session_id();


	if (empty($_SESSION['key'])) 
	{

    	$_SESSION['key'] = base64_encode(openssl_random_pseudo_bytes(32));
	}


//create CSRF token
  $csrf_to = hash_hmac('sha256', $sessionID, $_SESSION['key']);


	setcookie($cookie_name, $sessionID,time() + (86400 * 30), "/","localhost",false,true); // 86400 = 1 day


 	setcookie("csrf_token",$csrf_to,time()+3600,"/","localhost",false,true); //csrf token cookie

?>

<!DOCTYPE HTML>
<html>

	<?php
		
	if(!isset($_COOKIE[$cookie_name])) {
    
     	$msg = "Cookie is not Created";
		 echo "<script type='text/javascript'>alert('$msg')</script>";
	} 
	else {

     $msg = "Cookie Created";
	 echo "<script type='text/javascript'>alert('$msg')</script>";
	}
	
	

	?>
<body>
</br>

	<form method="POST" action="csrf.php">

		Username:<br/>
		<input type="text" placeholder="Enter Username" name="username" required>
		</br>

		Password:<br/>
		<input type="password" placeholder="Enter Password" name="password" required>
		
		<br/> <br/>

		<input type="hidden" id="cst" name="token" value="<?php echo $_COOKIE['csrf_token'];?>"> 

		<input type="submit" name="submit" value="submit"/>

		</form>

<div id="fb-root"></div>

<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="true">
	
</div>


<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>
<script>document.getElementById("cst").value = '<?php echo $csrf_to; ?>'</script>
</body>
</html>