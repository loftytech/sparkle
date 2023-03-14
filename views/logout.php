<?php
	include "header.php";

 	if (!Login::isLoggedIn()) {
 		die('user not logged in!');
 	}

 	session_start();
	$cstrong = True;
	$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
	if (!isset($_SESSION['token'])) {
		$_SESSION['token'] = $token;
	}

 	if (isset($_POST['confirm'])) {
 		if ($_POST['nocsrf'] != $_SESSION['token']) {
			die("Invalid token");
		}
 		if (isset($_POST['alldevices'])) {
 			
 			DB::query('DELETE FROM login_token WHERE user_id=:userid', array(':userid'=>Login::isLoggedIn()));

 		} else {
 			
 			if (isset($_COOKIE['SNID'])) {

	 			DB::query('DELETE FROM login_token WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
	 		}
	 		setcookie('SNID', '1', time()-3600);
	 		setcookie('SNID_', '1', time()-3600);
 		}

 		session_destroy();
 		
 		header("Location: index.php");
		exit();	

 	}
 ?>
<div class="single-page-wrapper form-page">
	<div class="single-page">
		<article class="no-thumbnail">
			<h2 class="post-title">Logout</h2>
			<div class="entry-content">
				<div class="form-wrapper">
					<form method="POST" action="logout.php">
						<input type="hidden" name="nocsrf" value="<?php echo $_SESSION['token']; ?>">
						<p class="fields"><input type="checkbox" name="alldevices" id="logout-all-devices" value="alldevices"><span><label for="logout-all-devices">Logout of all devices?</label></span></p>
						<p class="fields"><button type="submit" name="confirm">confirm</button></p>
					</form>
				</div>
			</div>
		</article>
		<?php include 'sidebar.php'; ?>
	</div>
</div>
 <?php
	include "footer.php";
?>