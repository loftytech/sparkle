<!DOCTYPE html>
	<html>
	<head>
		<title><?php echo $site_tagline; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="<?php echo $homeURL; ?>/css/style.css?v=<?php echo time(); ?>">
		
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	</head>

	<body class="not-loged-in">

	<header class="site-header">
		<div class="header-banner-wrapper">
			<div class="banner-header">
				<h1><a href="<?php echo $homeURL; ?>" class="custom-logo-link" rel="home" itemprop="url">{data: site_title }</a></h1>

				<?php include __DIR__ . "/../../views/widgets/nav.php"; ?>
				<div class="head-meta">
					<div class="head-links">
						<a href="<?php echo $homeURL; ?>/login">Sign In</a>
						<a href="<?php echo $homeURL; ?>/signup">Sign up</a>
					</div>
					<div class="toggle-menu"><span></span></div>
				</div>
			</div>
		</div>

		<?php if (function_exists('use_custom_slide')) { ?>
				<?php use_custom_slide($homeURL); ?>
		<?php } else { ?>
			<div class="slide-wrapper">
				<div class="slide-content">
					<div class="slides">
						<div class="text-content">
							<h1>A simplier way to transact {data:  homeURL   }</h1>
							<p>
								Purewallet provides a platform where you can make any transaction quickly without sacrificing quality for simplicity. 
								We provide a safe and secure platform to perform transactions.
							</p>
							<div class="links">
								<a href="#">Learn More</a>
								<a href="#">Get Started</a>
							</div>
						</div>
						<img src="<?php echo $homeURL; ?>/assets/svg/welcome.svg">
					</div>
				</div>
			</div>
		<?php } ?>
	</header>
	<script type="text/javascript">
		let toggleBar = document.querySelector(".toggle-menu")
		let menu = document.querySelector(".site-nav")
		let menuBody = document.querySelector(".site-nav ul")

		toggleBar.addEventListener('click', () => {
			menu.style.display = "block"
		})

		menu.addEventListener('click', (e) => {
			if (e.target != menuBody) {
				menu.style.display = "none"	
			}
		})
	</script>

	<script type="text/javascript">
		window.onscroll = function() {
			if (window.pageYOffset > 90) {
				document.body.classList.add('floating-body');
			} else {
				document.body.classList.remove("floating-body");
			}
		}
	</script>

	<script type="text/javascript">
		let windowHeight
		window.onLoad = loftyHeight

		function loftyHeight() {
			windowHeight = window.innerHeight
		}
		loftyHeight()
	</script>

	<div class="site-wrapper"> <!-- wrapper -->
			<!-- container-->
			<div class="container">

	<style type="text/css">
		.site-header {
			display: block;
			position: relative;
			background: rgb(176,21,86,1);
			background: linear-gradient(77deg, rgba(228,117,34,1) 0%, rgba(218,25,107,1) 63%, rgba(176,21,86,1) 100%); 
			min-height: 100vh;
			overflow: hidden;
		}
		.header-banner-wrapper {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			height: 90px;
			position: absolute;
			top: 0px;
			left: 0px;
			background: transparent;
			z-index: 9999999;
		}
		.floating-body .header-banner-wrapper {
			position: fixed;
			background: #fff;
			box-shadow: 0px 0px 20px -5px #ccc;
			animation: slideHeader 0.7s ease-in-out;
		}
		@keyframes slideHeader {
			0% {
				top: -90px;
			}
			100% {
				top: 0px;
			}
		}
		.header-banner-wrapper h1 {
			font-size: 18px;
			font-weight: 600;
			letter-spacing: 1px;
		}
		.header-banner-wrapper h1 a {
			color: #fff;
			font-size: 18px;
			font-weight: 600;
		}
		.floating-body .header-banner-wrapper h1 a {
			color: #6e6d7a;
		}
		.banner-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			height: 90px;
			padding: 0px 8%;
			width: 100%;
		}
		.head-meta {
			display: flex;
			align-items: center;
		}
		.head-meta .head-links {
			display: flex;
			align-items: center;
		}
		.head-meta .head-links a {
			display: flex;
			justify-content: center;
			align-items: center;
			background: #dd1f6f;
			color: #f7f7f7;
			height: 40px;
			width: 90px;
			font-size: 13px;
			border-radius: 4px;
			margin-right: 10px;
		}
		.head-meta .head-links a:first-child {
			border: 1px solid #ea79a3;
			background: transparent;
			color: #f7f7f7;
		}
		.floating-body .head-links a:first-child {
			color: #dd1f6f;
		}
		.toggle-menu {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			height: 28px;
			width: 28px;
			padding: 3px;
			border-radius: 2px;
			cursor: pointer;
		}
		.toggle-menu span, .toggle-menu::before, .toggle-menu::after {
			content: "";
			display: block;
			width: 16px;
			height: 1px;
			background: #fff;
		}
		.floating-body .toggle-menu span, .floating-body .toggle-menu::before, .floating-body .toggle-menu::after {
			background: #6e6d7a;
		}
		.toggle-menu span {
			margin: 3px 0px;
		}
		.slide-wrapper {
			display: flex;
			justify-content: center;
			align-items: center;
			position: absolute;
			top: 0px;
			left: 0px;
			width: 100%;
			min-height: 100vh;
			padding-top: 90px;
			position: relative;
			overflow: hidden;
		}
		.slide-wrapper .slide-content {
			width: 100%;
			height: 100%;
			z-index: 2;
		}
		.slide-wrapper .slide-content .slides {
			display: flex;
			align-items: center;
			flex-direction: column;
			padding: 0px 8%;
			height: 100%;
		}
		.slide-wrapper .slides img {
			width: 320px;
		}
		.slide-wrapper .slides span {
			display: block;
			font-size: 14px;
			font-weight: 400;
			color: #6e6d7a;
			text-transform: capitalize;
		}
		.slide-wrapper .slides .text-content {
			max-width: 640px;
			margin: 50px 0px 60px 0px;
		}
		.slide-wrapper .slides .text-content h1 {
			font-size: 34px;
			color: #fff;
			font-weight: 600;
			margin-bottom: 60px;
		}
		.slide-wrapper .text-content .links {
			display: flex;
		}
		.slide-wrapper .text-content .links a {
			display: flex;
			justify-content: center;
			align-items: center;
			color: #fff;
			width: 130px;
			height: 50px;
			border-radius: 3px;
			font-weight: 400;
			margin-right: 10px;
			border: 1px solid #ccc;
		}
		.slide-wrapper .text-content .links a:last-child {
			width: 160px;
			background: #fff;
			border: none;
			margin-left: 10px;
			color: var(--secondary-color);
		}
		.slide-wrapper .slides .text-content p {
			color: #f7f7f7;
			font-size: 18px;
			line-height: 28px;
			font-weight: 300;
			margin: 0px 0px 50px 0px;
		}

		@media (min-width: 720px) {
			.head-meta {
				display: none;
			}
			
			.slide-wrapper .slides .text-content h1 {
				font-size: 40px;
			}
			.slide-wrapper .slides .text-content p {
				font-size: 16px;
			}
			.slide-wrapper .slides img {
				width: 100%;
				max-width: 640px;
			}
			.slide-wrapper .slide-content .slides {
				display: flex;
				justify-content: space-between;
				flex-direction: row;
			}
			.slide-wrapper .slide-content .text-content {
				max-width: 640px;
				margin: 0px 0px 20px 0px;
			}
		}
	</style>


	{{content}}


	</div>
		</div> <!-- wrapper -->

		<footer>
			<div class="footer-wrapper">
				<div class="footer-logo">
					<a class="logo-text" href="<?php echo $homeURL; ?>"><?php echo $site_title; ?></a>
					<div class="social-icons">
						<a href="#"><i class="fab fa-facebook-f"></i></a>
						<a href="#"><i class="fab fa-instagram"></i></a>
						<a href="#"><i class="fab fa-whatsapp"></i></a>
					</div>
				</div>
				<div class="footer-sec-2">
					<div class="footer-nav-wrapper">
						<?php include __DIR__ . "/../../views/widgets/nav-footer.php"; ?>
					</div>
					<div class="address-wrapper">
						<div class="address-item">
							<h4>Lagos</h4>
							<p>8, Amazement street, Victoria Island, Lagos, Nigeria.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-meta">
				<span><?php echo $site_title; ?> - &copy; 2022</span>
				<div class="social-link">
					<a href="#">Facebook</a>
					<a href="#">Twitter</a>
					<a href="#">Instagram</a>
					<a href="#">LinkedIn</a>
				</div>
			</div>
		</footer>

		<style type="text/css">
			footer {
				padding: 80px 8% 50px 8%;
				background: var(--light-bg-color);
			}
			footer .social-icons a:last-child {
				margin-right: 0px;
			}
			.footer-wrapper {
				display: flex;
				flex-direction: column;
			}
			.footer-logo {
				width: 25%;
				display: flex;
				flex-direction: column;
				margin-bottom: 50px;
			}
			.footer-logo a.logo-text {
				font-size: 20px;
				font-weight: 600;
			}
			.footer-logo .social-icons {
				display: flex;
				margin-top: 20px;
			}
			.footer-logo .social-icons a {
				display: block;
				color: #5d5b5b;
				font-size: 20px;
				margin-right: 15px;
			}
			.footer-sec-2 {
				flex: 1;
			}
			.footer-nav-wrapper {
				display: flex;
				flex: 1;
				flex-wrap: wrap;
				flex-direction: column;
				margin: 0px auto;
			}
			.footer-nav-wrapper .links {
				margin-bottom: 50px;
			}
			.footer-nav-wrapper .links h4 {
				color: var(--text-color);
				text-transform: capitalize;
				font-size: 14px;
				font-weight: 600;
				margin-bottom: 14px;
			}
			.footer-nav-wrapper ul li {
				display: block;
				margin-bottom: 5px;
			}
			.footer-nav-wrapper ul li a {
				display: inline-block;
				color: var(--light-text-color);
				font-size: 12px;
			}
			.address-wrapper {
				display: block;
				margin-bottom: 20px;
			}
			.address-wrapper .address-item {
				display: block;
				max-width: 320px;
			}
			.address-wrapper .address-item h4 {
				color: var(--text-color);
				margin-bottom: 8px;
				font-size: 14px;
				font-weight: 400;
			}
			.address-wrapper .address-item p {
				color: var(--light-text-color);
				font-size: 13px;
				line-height: 24px;
				font-weight: 300;
			}
			.footer-meta {
				display: flex;
				justify-content: space-between;
				align-items: center;
				flex-direction: column;
				color: #fff;
				font-size: 14px;
				margin-top: 60px;
			}
			.footer-meta span {
				color: #8e8e8e;
				margin-bottom: 20px;
			}
			.footer-meta .social-link a {
				color: var(--light-text-color);
				font-size: 14px;
				margin-left: 20px;
				font-weight: 300;
			}

			@media (min-width: 480px) {
				.footer-nav-wrapper {
					flex-direction: row;
				}
				.footer-nav-wrapper .links {
					width: 40%;
					margin-bottom: 50px;
				}
			}

			@media (min-width: 720px) {
				.footer-wrapper {
					flex-direction: row;
				}
				.footer-nav-wrapper {
					flex-direction: row;
				}
				.footer-nav-wrapper .links {
					width: 40%;
					margin-bottom: 50px;
				}

				.footer-meta {
					flex-direction: row;
				}
				.footer-meta span {
					margin-bottom: 0px;
				}
			}

			@media (min-width: 960px) {
				.footer-wrapper .links {
					width: 22%;
				}
			}
		</style>
	</body>
</html>