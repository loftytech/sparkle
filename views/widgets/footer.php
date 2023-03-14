
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
					<?php include "nav-footer.php"; ?>
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