<!DOCTYPE html>
<html>
<head>
	<title><?php echo $site_tagline; ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="<?php echo $homeURL; ?>/css/style.css?v=<?php echo time(); ?>">
	
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

	<?php if ($homeURL == "http://localhost/purewallet") { ?>
			<link rel="stylesheet" href="http://localhost/fontawesome/css/all.css">
			<script src="http://localhost/js/jquery.js"></script>
		<?php } else { ?>
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<?php } ?>

</head>

<body class="<?php if($isLoggedIn){ echo "loged-in"; } else { echo "not-loged-in"; } ?>">

<div class="form-page-wrapper">
	<div class="page-header">
		<h2><a href="<?php echo $homeURL; ?>"><?php echo $site_title; ?></a></h2>
	</div>
	<div class="form-wrapper">
		<form method="POST" action="<?php echo $homeURL; ?>/signup">
			<div class="form-response"><?php echo isset($data->message) ? $data->message : ""; ?></div>
			<div class="form-head">
				<h4>Create your account</h4>
			</div>
			<label>First Name</label>
			<div class="input-wrapper">
				<input type="text" name="first_name" placeholder="Enter your first name">
			</div>
			<label>Last Name</label>
			<div class="input-wrapper">
				<input type="text" name="last_name" placeholder="Enter your last name">
			</div>
			<label>Email address</label>
			<div class="input-wrapper">
				<input type="email" name="user_email" placeholder="Enter your email address">
			</div>
			<label>Phone Number</label>
			<div class="input-wrapper">
				<input type="text" name="user_phone" placeholder="Enter your phone number">
			</div>
			<label>Country</label>
			<div class="input-wrapper">
				<select name="country">
					<option>Nigeria</option>
				</select>
			</div>
			<label>Password</label>
			<div class="input-wrapper password-input-wrapper">
				<input type="password" name="user_password" placeholder="Enter your password">
				<span class="material-icons-outlined">visibility</span>
			</div>
			<label>Confirm Password</label>
			<div class="input-wrapper password-input-wrapper">
				<input type="password" name="confirm_password" placeholder="Enter your password">
				<span class="material-icons-outlined">visibility</span>
			</div>
			<div class="consent">
				<span>By clicking the “Create your account” button, you agree to Mypaywave </span> <a href="#">privacy policy</a> <span>and</span> <a href="">terms and conditions</a>
			</div>
			<button>Create your account</button>
			<div class="form-foot">
				<span>Already have an account ? </span>
				<a href="<?php echo $homeURL; ?>/login">Login</a>
			</div>
		</form>
	</div>

	<div class="chat-toggle">
		<img src="<?php echo $homeURL; ?>/assets/svg/chat-icon.svg">
	</div>
</div>


<style type="text/css">
	.form-page-wrapper {
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		background: rgb(176,21,86,1);
		background: linear-gradient(77deg, rgba(228,117,34,1) 0%, rgba(218,25,107,1) 63%, rgba(176,21,86,1) 100%); 
		padding: 40px 8%;
		height: 100vh;
		overflow-y: auto;
	}
	.page-header {
		margin-bottom: 40px;
	}
	.page-header h2 a {
		color: #fff;
		font-size: 20px;
		font-weight: 600;
	}
	.form-wrapper {
		display: flex;
		align-items: center;
		justify-content: center;
		flex: 1;
	}
	.form-wrapper .items-content {
		display: flex;
		justify-content: center;
		flex-direction: column;
	}
	.form-wrapper form {
		display: flex;
		align-items: flex-start;
		flex-direction: column;
		width: 100%;
		background: #fff;
		padding: 4% 5%;
		border-radius: 8px;
		max-width: 700px;
	}
	.form-wrapper form .form-head h4 {
		font-size: 25px;
		font-weight: 600;
		margin-bottom: 40px;
		color: var(--primary-color);
	}
	.form-wrapper form label {
		display: block;
		font-size: 14px;
		font-weight: 500;
		color: #909090;
		margin-bottom: 8px;
	}
	.form-page-wrapper .input-wrapper {
		display: flex;
		align-items: center;
		width: 100%;
		margin-bottom: 35px;
		position: relative;
	}
	.form-wrapper form input, .form-wrapper form select {
		display: block;
		background: #fff;
		height: 50px;
		font-size: 13px;
		font-weight: 300;
		color: var(--text-color);
		width: 100%;
		padding: 10px;
		border-radius: 4px;
		border: 1px solid rgba(145, 145, 145, 0.3);
	}
	.form-wrapper .password-input-wrapper input {
		padding-right: 50px;
	}
	.form-wrapper .password-input-wrapper span {
		position: absolute;
		right: 20px;
		color: #ccc;
		font-size: 18px;
	}
	
	.form-wrapper form input::placeholder {
		color: #959393;
	}
	.form-wrapper form input:focus {
		border: 1px solid var(--light-primary-color);
		outline: none;
	}
	.form-wrapper form button {
		width: 100%;
		height: 50px;
		background: var(--primary-color);
		color: #fff;
		border: none;
		border-radius: 4px;
		margin-top: 20px;
		cursor: pointer;
	}
	.form-wrapper form .consent {
		padding: 0px 20px;
		text-align: center;
		line-height: 25px;
		font-size: 14px;
		color: var(--text-color);
	}
	.form-wrapper form .form-foot {
		display: flex;
		justify-content: center;
		align-items: center;
		margin-top: 20px;
		width: 100%;
	}
	.form-wrapper form .form-foot span {
		margin-right: 10px;
		font-size: 13px;
		color: var(--light-text-color);
		font-weight: 500;
	}
	.form-wrapper form .form-foot a {
		color: var(--secondary-color);
		font-size: 13px;
		font-weight: 500;
	}
	.chat-toggle {
		display: flex;
		justify-content: center;
		align-items: center;
		width: 60px;
		height: 60px;
		border-radius: 50%;
		background: #fff;
		box-shadow: 0px 0px 20px -5px #ccc;
		position: fixed;
		bottom: 40px;
		right: 40px;
		cursor: pointer;
	}
	.chat-toggle img {
		width: 30px;
	}


	@media screen and (min-width:  720px) {
		
	}

	@media screen and (min-width:  960px) {
		
	}
</style>

</body>
</html>