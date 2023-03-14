<?php
	function use_custom_slide($homeURL) { ?>
		<div class="slide-wrapper">
			<img class="slide-overlay" src="<?php echo  $homeURL; ?>/assets/svg/contact-slide-vector.svg">
			<div class="text-content">
				<h1>Contact us</h1>
				<p>
					Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . r . 
				</p>
			</div>
		</div>
	<?php }
?>

<?php
	include "widgets/header.php"
?>
<div class="index-page-wrapper">
	<div class="sec-wrapper sec-1">
		<div class="sec-content">
			<div class="items-wrapper">
				<div class="items-content">
					<div class="text-content">
						<h4>Are You Looking For Something !</h4>
						<p>
							Get answers to your questions by exploring our Frequently Asked Questions, and if you have other questions that we haven’t covered.
						</p>
						<ul>
							<li><span class="material-icons">check_circle</span><span>+234 702 0000 554</span></li>
							<li><span class="material-icons">check_circle</span><span>contact@mypaywave.com</span></li>
							<li><span class="material-icons">check_circle</span><span>Contact address : 8, Amazement street, Victoria Island,Lagos, Nigeria.</span></li>
						</ul>
					</div>
					<div class="form-content">
						<form>
							<label>Full Name</label>
							<input type="text" name="first-name" placeholder="E.g. John Doe">
							<label>Phone Number</label>
							<input type="text" name="phone" placeholder="+234809274858">
							<label>Email Address</label>
							<input type="email" name="email" placeholder="E.g. johndoe@gmail.com">
							<label>Subject</label>
							<input type="text" name="subject" placeholder="Enter enquiry">
							<label>Message</label>
							<textarea placeholder="Description of subject"></textarea>
							<button>Send Message</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<style type="text/css">
	.site-header {
		min-height: unset;
	}
	.slide-wrapper {
		min-height: unset;
	}
	.slide-wrapper {
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.slide-wrapper .text-content {
		display: flex;
		justify-content: center;
		align-items: center;
		flex-direction: column;
		max-width: 880px;
		padding: 20px 8%;
		position: relative;
		z-index: 4;
	}
	/*.slide-wrapper::before {
		content: "";
		width: 100%;
		height: 100%;
		position: absolute;
		background: #0002;
		top: 0px;
		left: 0px;
		z-index: 3;
	}*/

	.slide-overlay {
		min-width: 100%;
		position: absolute;
		/*top: 0px;
		left: 0px;*/
		/*transform: scale(1.1);*/
		mix-blend-mode: luminosity;
		z-index: 1;
	}

	.slide-wrapper .text-content h1 {
		font-size: 40px;
		color: #fff;
		font-weight: 800;
		margin-bottom: 25px;
		text-align: center;
	}
	.slide-wrapper .text-content p {
		font-size: 14px;
		color: #fff;
		font-weight: 300;
		line-height: 28px;
		text-align: center;
	}

	.sec-1 {
		width: 100%;
		padding: 120px 8%;
		background: var(--bg-color);
	}
	.sec-1 .items-content {
		display: flex;
		justify-content: center;
		flex-direction: column;
	}
	.sec-1 .text-content {
		margin-bottom: 40px;
	}
	.sec-1 .text-content h4 {
		font-size: 25px;
		font-weight: 600;
		color: var(--text-color);
		margin-bottom: 20px;
	}
	.sec-1 .text-content p {
		font-size: 14px;
		font-weight: 300;
		line-height: 25px;
		margin-bottom: 40px;
		color: var(--light-text-color);
	}
	.sec-1 .text-content ul li {
		display: flex;
		align-items: center;
		margin-bottom: 20px;
	}
	.sec-1 .text-content ul li span:first-child {
		margin-right: 10px;
		font-size: 19px;
		color: var(--secondary-color);
	}
	.sec-1 .text-content ul li span:last-child {
		margin-right: 10px;
		font-size: 14px;
		font-weight: 300;
		color: var(--secondary-color);
	}

	.sec-1 .form-content {
		width: 100%;
		max-width: 720px;
	}
	.sec-1 form {
		display: flex;
		align-items: flex-start;
		flex-direction: column;
		width: 100%;
	}
	.sec-1 form label {
		display: block;
		font-size: 14px;
		font-weight: 500;
		color: #5A5A5A;
		margin-bottom: 8px;
	}
	.sec-1 form input, .sec-1 form textarea {
		display: block;
		background: #F7F7F7;
		height: 50px;
		font-size: 13px;
		font-weight: 300;
		color: var(--text-color);
		border: none;
		width: 100%;
		padding: 10px;
		margin-bottom: 30px;
		border-radius: 4px;
	}
	.sec-1 form textarea {
		resize: none;
		height: 200px;
	}
	.sec-1 form input::placeholder, .sec-1 form textarea::placeholder {
		color: #959393;
	}
	.sec-1 form input:focus, .sec-1 form textarea:focus {
		outline: 1px solid var(--light-primary-color);
	}
	.sec-1 form button {
		width: 150px;
		height: 50px;
		background: var(--primary-color);
		color: #fff;
		border: none;
		border-radius: 4px;
		align-self: flex-end;
		cursor: pointer;
	}


	@media screen and (min-width:  720px) {
		.site-header {
			min-height: 100vh;
		}
		.slide-wrapper {
			min-height: 100vh;
		}
		.slide-wrapper .text-content h1 {
			font-size: 60px;
		}
		.slide-wrapper .text-content p {
			font-size: 18px;
		}
	}

	@media screen and (min-width:  960px) {
		.sec-1 .items-content {
			flex-direction: row;
		}
		.sec-1 .text-content {
			margin: 0px 20px 0px 0px;
		}
	}
</style>

<?php
	include "widgets/footer.php"
?>