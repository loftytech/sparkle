<?php
	function use_custom_slide($homeURL) { ?>
		<div class="slide-wrapper">
			<img class="slide-overlay" src="<?php echo  $homeURL; ?>/assets/svg/contact-slide-vector.svg">
			<div class="text-content">
				<h1>A simplier way to transact</h1>
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
					<div class="img-content">
						<img src="<?php echo $homeURL; ?>/assets/img/contact-sec-1.jpg">
					</div>
					<div class="text-content">
						<h4>Company Story</h4>
						<p>
							Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="sec-wrapper sec-2">
		<div class="sec-content">
			<div class="items-wrapper">
				<div class="items-content">
					<div class="img-content">
						<img src="<?php echo $homeURL; ?>/assets/img/contact-sec-2.jpg">
					</div>
					<div class="text-content">

						<h4>Our Company Core Values</h4>
						<p>
							Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam .
						</p>

						<ul>
							<li><span class="material-icons">check_circle</span><span>Diversity and inclusion</span></li>
							<li><span class="material-icons">check_circle</span><span>Accountability</span></li>
							<li><span class="material-icons">check_circle</span><span>Customer obsession</span></li>
							<li><span class="material-icons">check_circle</span><span>Integrity</span></li>
							<li><span class="material-icons">check_circle</span><span>Top quality</span></li>
							<li><span class="material-icons">check_circle</span><span>Teamwork</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="sec-wrapper sec-3">
		<div class="sec-content">
			<div class="items-wrapper">
				<div class="items-content">
					<div class="text-content">

						<h4>Create An Account Under 10 Minutes</h4>
						<p>
							Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam .
						</p>
						<a class="button" href="#">Create Account</a>
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
	.sec-1 .img-content {
		display: flex;
		justify-content: center;
		align-items: center;
		width: 100%;
		max-width: 640px;
		height: 400px;
		border-radius: 10px;
		margin: 0px 0px 60px 0px;
		overflow: hidden;
	}
	.sec-1 .img-content img {
		width: 100%;
	}
	.sec-1 .text-content {
		flex: 1;
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


	/* Section 2 */
	.sec-2 {
		width: 100%;
		padding: 120px 8%;
		background: var(--bg-color);
	}
	.sec-2 .items-content {
		display: flex;
		justify-content: center;
		flex-direction: column;
	}
	.sec-2 .img-content {
		display: flex;
		justify-content: center;
		align-items: center;
		width: 100%;
		max-width: 640px;
		height: 400px;
		border-radius: 10px;
		margin: 0px 0px 60px 0px;
		overflow: hidden;
	}
	.sec-2 .img-content img {
		width: 100%;
		border-radius: 5px;
	}
	.sec-2 .text-content {
		flex: 1;
	}
	.sec-2 .text-content h4 {
		font-size: 25px;
		font-weight: 600;
		color: var(--text-color);
		margin-bottom: 20px;
	}
	.sec-2 .text-content p {
		font-size: 14px;
		font-weight: 300;
		line-height: 25px;
		margin-bottom: 40px;
		color: var(--light-text-color);
	}
	.sec-2 .text-content ul li {
		display: flex;
		align-items: center;
		margin-bottom: 20px;
	}
	.sec-2 .text-content ul li span:first-child {
		margin-right: 10px;
		font-size: 19px;
		color: var(--secondary-color);
	}
	.sec-2 .text-content ul li span:last-child {
		margin-right: 10px;
		font-size: 14px;
		font-weight: 300;
		color: var(--secondary-color);
	}


	/* Section 3 */
	.sec-3 {
		width: 100%;
		padding: 120px 8%;
		background: #ffcee2;
	}
	.sec-3 .items-wrapper {
		display: flex;
		justify-content: center;
	}
	.sec-3 .items-content {
		display: flex;
		justify-content: center;
		flex-direction: column;
		max-width: 880px;
		padding: 40px;
		border-radius: 10px;
		background: var(--primary-color);
	}
	.sec-3 .text-content h4 {
		font-size: 25px;
		font-weight: 800;
		color: #fff;
		text-align: center;
		margin-bottom: 20px;
	}
	.sec-3 .text-content p {
		font-size: 14px;
		font-weight: 300;
		line-height: 25px;
		margin-bottom: 40px;
		color: #f7f7f7;
		text-align: center;
	}
	.sec-3 .text-content a.button {
		display: flex;
		justify-content: center;
		align-items: center;
		width: 150px;
		height: 50px;
		font-size: 14px;
		font-weight: 400;
		border-radius: 5px;
		background: #fff;
		margin: 0px auto;
		color: var(--primary-color);
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
		.sec-1 .items-content .items {
			max-width: 480px;
			margin: 0px auto 40px auto;
		}
	}

	@media screen and (min-width:  960px) {
		.sec-1 .items-content {
			flex-direction: row;
		}
		.sec-1 .img-content {
			margin: 0px 40px 0px 0px;
		}
		.sec-1 .text-content {
			margin: 40px 0px 0px 0px;
		}

		.sec-2 .items-content {
			flex-direction: row;
		}

		.sec-2 .img-content {
			margin: 0px 40px 0px 0px;
		}

		.sec-3 .items-content {
			flex-direction: row-reverse;
		}
		.sec-3 .img-content {
			margin: 0px 0px 0px 40px;
		}
	}
</style>

<?php
	include "widgets/footer.php"
?>