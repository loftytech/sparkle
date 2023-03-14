<template>
	<div class="index-page-wrapper">
		<input type="text" value="{inputData}" onkeydown="changeText(this)">
		<p>text: {inputData}</p>
		<div class="sec-wrapper sec-1">
			<div class="sec-content">
				<h1 onclick="changeCount()">Our Key Features {counter}</h1>
				<ul for-each="product in products">
					<li onclick="updateItemList()" style="color: #f0f; font-size: 13px;"><h3>{{item}}</h3></li>
					<h4 for-each="item in newListItems">{{item}}</h4>
				</ul>
				<h5>Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar.</h5>

				<div class="items-wrapper">
					<div class="items-content">
						<div class="items">
							<div class="icon-box">
								<img src="<?php echo $homeURL; ?>/assets/svg/shield-icon.svg">
							</div>

							<h4>Security</h4>

							<p>
								Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar.
							</p>
						</div>
						<div class="items">
							<div class="icon-box">
								<img src="<?php echo $homeURL; ?>/assets/svg/sun-icon.svg">
							</div>

							<h4>Latest Technology</h4>

							<p>
								Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar.
							</p>
						</div>
						<div class="items">
							<div class="icon-box">
								<img src="<?php echo $homeURL; ?>/assets/svg/swift-icon.svg">
							</div>

							<h4>Swift Transaction</h4>

							<p>
								Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="sec-wrapper sec-2">
			<div class="sec-content">
				<h1>A Simplier Way To Transact</h1>
				<h5>Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar.</h5>

				<div class="items-wrapper">
					<div class="items-content">
						<div class="img-content">
							<img src="<?php echo $homeURL; ?>/assets/img/sec2-img.jpg">
							<img src="<?php echo $homeURL; ?>/assets/img/sec2-img-2.png">
						</div>
						<div class="text-content">

							<h4>Make That Transaction The Comfort Of Your Home</h4>
							<p>
								Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . 
							</p>

							<ul>
								<li><span class="material-icons">check_circle</span><span>Lorem Ipsum Lorem Ipsum</span></li>
								<li><span class="material-icons">check_circle</span><span>Lorem Ipsum Lorem Ipsum</span></li>
								<li><span class="material-icons">check_circle</span><span>Lorem Ipsum Lorem Ipsum</span></li>
								<li><span class="material-icons">check_circle</span><span>Lorem Ipsum Lorem Ipsum</span></li>
								<li><span class="material-icons">check_circle</span><span>Lorem Ipsum Lorem Ipsum</span></li>
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
						<div class="img-content">
							<img src="<?php echo $homeURL; ?>/assets/img/sec3-img.jpg">
						</div>
						<div class="text-content">

							<h4>Make That Transaction The Comfort Of Your Home</h4>
							<p>
								Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="sec-wrapper sec-4">
			<img class="sec-vector" src="<?php echo $homeURL; ?>/assets/svg/sec4-top-vector.svg">
			<img class="sec-vector" src="<?php echo $homeURL; ?>/assets/svg/sec4-bottom-vector.svg">
			<div class="sec-content">
				<h1>How To Get Started</h1>
				<h5>Get started in 3 easy steps</h5>

				<div class="items-wrapper">
					<div class="items-content">
						<div class="img-content">
							<img src="<?php echo $homeURL; ?>/assets/svg/sec4-vector.svg">
						</div>
						<div class="text-content">
							<ul>
								<li>
									<div><b>Step 1: </b><span>Create an account</span></div>
									<p>First step is step is to create an account. You can do this by clicking the signup button and filling your details into the form.</p>
								</li>
								<li>
									<div><b>Step 2: </b><span>Verify your account</span></div>
									<p>If you entered the correct details, a verification link would sent to your email and phone number. Make sure to verify them</p>
								</li>
								<li>
									<div><b>Step 3: </b><span>Start transacting</span></div>
									<p>Upon verificatio, you should be able to start making transactions. You would need to top up your wallet to make transactions suct has airtime purchase, transfers and much more.</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="sec-wrapper sec-5">
			<div class="sec-content">
				<h1>Feedback from our users</h1>
				<h5>Check out these testimonies from users using our services to ease their daily finantoial transactions</h5>

				<div class="items-wrapper">
					<div class="items-content">
						<div class="items">
							<div class="content-head">
								<div class="img-box">
									<img src="<?php echo $homeURL; ?>/assets/img/sec5-img-1.jpg">
								</div>
								<div class="head-text">
									<h4>Nwanchukwu Sandra</h4>
									<span>Lagos, Nigeria</span>
								</div>
							</div>
							<p>
								Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .  Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . 
							</p>
						</div>
						<div class="items">
							<div class="content-head">
								<div class="img-box">
									<img src="<?php echo $homeURL; ?>/assets/img/sec5-img-2.jpg">
								</div>
								<div class="head-text">
									<h4>Olamide Kehinde</h4>
									<span>Ogun, Nigeria</span>
								</div>
							</div>
							<p>
								Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .  Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . 
							</p>
						</div>
						<div class="items">
							<div class="content-head">
								<div class="img-box">
									<img src="<?php echo $homeURL; ?>/assets/img/sec5-img-3.jpg">
								</div>
								<div class="head-text">
									<h4>James Tolani</h4>
									<span>Abuja, Nigeria</span>
								</div>
							</div>
							<p>
								Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .  Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . 
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>


<style type="text/css">
	.sec-1 {
		width: 100%;
		padding: 120px 8%;
		background: var(--bg-color);
	}

	.sec-content h1 {
		text-align: center;
		font-size: 25px;
		font-weight: 700;
		margin-bottom: 20px;
		color: var(--text-color);
		position: relative;
		z-index: 2;
	}
	.sec-content h5 {
		text-align: center;
		margin-bottom: 80px;
		font-size: 16px;
		font-weight: 300;
		max-width: 640px;
		line-height: 25px;
		margin: 0px auto 100px auto;
		color: var(--text-color);
		position: relative;
		z-index: 2;
	}
	.sec-1 .items-content {
		display: flex;
		justify-content: space-between;
		flex-direction: column;
	}
	.sec-1 .items-content .items {
		width: 100%;
		margin-bottom: 40px;
	}
	.sec-1 .items-content .items .icon-box {
		display: flex;
		justify-content: center;
		align-items: center;
		width: 80px;
		height: 80px;
		border-radius: 4px;
		margin-bottom: 20px;
		background: var(--primary-color);
	}
	.sec-1 .items-content .items .icon-box img {
		width: 30px;
	}
	.sec-1 .items-content .items h4 {
		font-size: 17px;
		font-weight: 600;
		margin-bottom: 8px;
		color: var(--text-color);
	}
	.sec-1 .items-content .items p {
		font-size: 14px;
		font-weight: 300;
		margin-bottom: 8px;
		line-height: 24px;
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
		width: 100%;
		max-width: 640px;
		margin: 0px 0px 60px 0px;
		overflow: hidden;
		position: relative;
	}
	.sec-2 .img-content img:first-child {
		width: 90%;
		border-radius: 5px;
		margin: 0px 0px 100px 0px;
	}
	.sec-2 .img-content img:last-child {
		width: 350px;
		position: absolute;
		bottom: -80px;
		right: 0px;
		margin: 0px 0px 100px 0px;
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
		color: var(--primary-color);
	}
	.sec-2 .text-content ul li span:last-child {
		margin-right: 10px;
		font-size: 14px;
		font-weight: 300;
		color: var(--dark-primary-color);
	}


	/* Section 3 */
	.sec-3 {
		width: 100%;
		padding: 120px 8%;
		background: var(--bg-color);
	}

	.sec-3 .items-content {
		display: flex;
		justify-content: center;
		flex-direction: column;
	}
	.sec-3 .img-content {
		width: 100%;
		max-width: 640px;
		margin-bottom: 60px;
		overflow: hidden;
	}
	.sec-3 .img-content img {
		width: 100%;
		border-radius: 5px;
	}
	.sec-3 .text-content {
		flex: 1;
	}
	.sec-3 .text-content h4 {
		font-size: 25px;
		font-weight: 600;
		color: var(--text-color);
		margin-bottom: 20px;
	}
	.sec-3 .text-content p {
		font-size: 14px;
		font-weight: 300;
		line-height: 25px;
		margin-bottom: 40px;
		color: var(--light-text-color);
	}


	/* Section 4 */
	.sec-4 {
		width: 100%;
		padding: 120px 8%;
		position: relative;
		background: var(--light-bg-color);
	}
	.sec-4::after {
		content: "";
		display: block;
		width: 100%;
		height: 30vh;
		position: absolute;
		bottom: 0px;
		left: 0px;
		z-index: 1;
		background: #fff;
	}
	.sec-4 .sec-vector:first-of-type {
		position: absolute;
		top: 0;
		right: 0;
		z-index: 1;
	}
	.sec-4 .sec-vector:last-of-type {
		position: absolute;
		bottom: 30vh;
		right: 0;
		z-index: 1;
	}
	.sec-4 .items-content {
		display: flex;
		flex-wrap: wrap;
		flex-direction: column-reverse;
		justify-content: space-between;
		position: relative;
		z-index: 2;
	}
	.sec-4 .img-content {
		width: 100%;
		max-width: 640px;
		overflow: hidden;
	}
	.sec-4 .img-content img {
		width: 100%;
		max-height: 80vh;
		border-radius: 5px;
	}
	.sec-4 .text-content {
		flex: 1;
		max-width: 640px;
	}
	.sec-4 .text-content h4 {
		font-size: 25px;
		font-weight: 600;
		color: var(--text-color);
		margin-bottom: 20px;
	}
	.sec-4 .text-content p {
		font-size: 14px;
		font-weight: 300;
		line-height: 25px;
		margin-bottom: 40px;
		color: var(--light-text-color);
	}
	.sec-4 .text-content ul li div {
		display: flex;
		align-items: center;
		margin-bottom: 15px;
	}
	.sec-4 .text-content ul li p {
		line-height: 25px;
		font-weight: 300;
		font-size: 15px;
		color: var(--light-text-color);
	}
	.sec-4 .text-content ul li b {
		margin-right: 10px;
		font-size: 15px;
		font-weight: 600;
		text-transform: capitalize;
		color: var(--text-color);
	}
	.sec-4 .text-content ul li span {
		margin-right: 10px;
		font-size: 15px;
		font-weight: 500;
		text-transform: capitalize;
		color: var(--text-color);
	}


	/* Section 5 */
	.sec-5 {
		width: 100%;
		padding: 120px 8%;
		background: var(--bg-color);
	}

	.sec-5 .sec-content h1 {
		text-align: center;
		font-size: 25px;
		font-weight: 700;
		margin-bottom: 20px;
		color: var(--text-color);
	}
	.sec-5 .sec-content h5 {
		text-align: center;
		margin-bottom: 80px;
		font-size: 16px;
		font-weight: 300;
		max-width: 640px;
		line-height: 25px;
		margin: 0px auto 100px auto;
		color: var(--text-color);
	}
	.sec-5 .items-content {
		display: flex;
		justify-content: center;
		align-items: center;
		flex-direction: column;
	}
	.sec-5 .items-content .items {
		width: 100%;
		max-width: 480px;
		padding: 25px;
		background: #fff;
		border-radius: 8px;
		margin-bottom: 40px;
		box-shadow: 0px 3px 8px -4px #ccc;
	}
	.sec-5 .items-content .content-head {
		display: flex;
		align-items: center;
	}
	.sec-5 .items-content .items .img-box {
		display: flex;
		justify-content: center;
		align-items: center;
		width: 80px;
		height: 80px;
		border-radius: 8px;
		margin-bottom: 20px;
		margin-right: 13px;
		overflow: hidden;
	}
	.sec-5 .items-content .items .img-box img {
		display: block;
		width: unset;
		max-width: unset;
		min-width: 100%;
		min-height: 100%;
	}
	.sec-5 .items-content .items h4 {
		font-size: 16px;
		font-weight: 600;
		margin-bottom: 8px;
		color: var(--text-color);
	}
	.sec-5 .items-content .items span {
		font-size: 14px;
		font-weight: 300;
		margin-bottom: 8px;
		color: var(--text-color);
	}
	.sec-5 .items-content .items p {
		font-size: 13px;
		font-weight: 300;
		margin-bottom: 8px;
		line-height: 24px;
		color: var(--light-text-color);
	}


	@media screen and (min-width:  720px) {
		.sec-1 .items-content .items {
			max-width: 480px;
			margin: 0px auto 40px auto;
		}
	}

	@media screen and (min-width:  960px) {
		.sec-1 .items-content {
			display: flex;
			justify-content: space-between;
			flex-direction: row;
		}
		.sec-1 .items-content .items {
			width: calc(33.33% - 30px);
			max-width: 380px;
			margin-bottom: 0px;
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

		.sec-4 .items-content {
			flex-direction: row-reverse;
			justify-content: space-between;
		}
		.sec-4 .img-content {
			margin-left: 40px;
		}

		.sec-5 .items-content {
			justify-content: space-between;
			align-items: unset;
			flex-direction: row;
		}
		.sec-5 .items-content .items {
			margin-bottom: 0px;
			width: calc(33.33% - 20px);
		}
	}
</style>


<script>
	let inputData = "";
	let counter = 1;
	let products = [
		"Rice",
		"Beans",
		"Garri",
		"Ewa",
		"Moi moi",
	]
	let newListItems = [
		"life",
		"life",
	]

	const changeCount = () => {
		setState(() => {
			counter++
		})
	}

	const updateItemList = () => {
		setState(() => {
			listItems.push("omo")
		})
	}

	const changeText = (e) => {
		setState(() => {
			inputData = e.value;
		})
	}
	
</script>