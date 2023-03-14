<?php
	function use_custom_slide($homeURL) { ?>
		<div class="slide-wrapper">
			<img class="slide-overlay" src="<?php echo  $homeURL; ?>/assets/svg/contact-slide-vector.svg">
			<div class="text-content">
				<h1>Frequently Asked Questions</h1>
				<p>
					Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . r . 
				</p>

				<form>
					<button><span class="material-icons-outlined">search</span></button>
					<input type="text" name="search" placeholder="Search">
				</form>
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
					<div class="items">
						<div class="item-head">
							<h4>Lorem ipsum ipsum atec cest</h4>
							<span class="material-icons-outlined">chevron_right</span>
						</div>
						<div class="item-body">
							<p>Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .</p>
						</div>
					</div>
					<div class="items">
						<div class="item-head">
							<h4>Lorem ipsum ipsum atec cest</h4>
							<span class="material-icons-outlined">chevron_right</span>
						</div>
						<div class="item-body">
							<p>Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .</p>
						</div>
					</div>
					<div class="items">
						<div class="item-head">
							<h4>Lorem ipsum ipsum atec cest</h4>
							<span class="material-icons-outlined">chevron_right</span>
						</div>
						<div class="item-body">
							<p>Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .</p>
						</div>
					</div>
					<div class="items">
						<div class="item-head">
							<h4>Lorem ipsum ipsum atec cest</h4>
							<span class="material-icons-outlined">chevron_right</span>
						</div>
						<div class="item-body">
							<p>Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .</p>
						</div>
					</div>
					<div class="items">
						<div class="item-head">
							<h4>Lorem ipsum ipsum atec cest</h4>
							<span class="material-icons-outlined">chevron_right</span>
						</div>
						<div class="item-body">
							<p>Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .</p>
						</div>
					</div>
					<div class="items">
						<div class="item-head">
							<h4>Lorem ipsum ipsum atec cest</h4>
							<span class="material-icons-outlined">chevron_right</span>
						</div>
						<div class="item-body">
							<p>Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .</p>
						</div>
					</div>
					<div class="items">
						<div class="item-head">
							<h4>Lorem ipsum ipsum atec cest</h4>
							<span class="material-icons-outlined">chevron_right</span>
						</div>
						<div class="item-body">
							<p>Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .</p>
						</div>
					</div>
					<div class="items">
						<div class="item-head">
							<h4>Lorem ipsum ipsum atec cest</h4>
							<span class="material-icons-outlined">chevron_right</span>
						</div>
						<div class="item-body">
							<p>Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar . Lorem ipsum Ipsum atec cest avec sont ipsum lorem ilsum sant ipsum avec cest lorem ipsum avec sont ipsum ilsam quest questar .</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	let itemBox = document.querySelectorAll(".sec-1 .items-content .items")
	for (let i = 0; i < itemBox.length; i++) {
		itemBox[i].addEventListener('click', (e) => {
			e.preventDefault();
			console.log(itemBox[i])
			let displayClass = itemBox[i].classList.contains('show-content')
			if (!displayClass) {
				itemBox[i].classList.add("show-content")
				itemBox[i].querySelector(".item-body").style.display = "block"
			} else {
				itemBox[i].classList.remove("show-content")
				itemBox[i].querySelector(".item-body").style.display = "none"
			}
			
		})
	}
</script>


<style type="text/css">
	.site-header {
		min-height: unset;
	}
	.slide-wrapper {
		display: flex;
		justify-content: center;
		align-items: center;
		min-height: unset;
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
	.slide-wrapper .text-content form {
		display: flex;
		align-items: stretch;
		background: #fff;
		width: 100%;
		max-width: 480px;
		height: 60px;
		margin-top: 20px;
		border-radius: 8px;
		overflow: hidden;
	}
	.slide-wrapper .text-content form input {
		flex: 1;
		border: none;
		padding: 10px 0px;
		outline: none;
		color: var(--text-color);
		font-size: 14px;
		font-weight: 400;
	}
	.slide-wrapper .text-content form input::placeholder {
		color: #959393;
	}
	.slide-wrapper .text-content form button {
		width: 60px;
		border: none;
		background: #fff;
	}
	.slide-wrapper .text-content form button span {
		color: var(--light-text-color);
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
		flex-wrap: wrap;
	}
	.sec-1 .items-content .items {
		width: 100%;
		margin-bottom: 40px;
		background: #fff;
		padding: 20px;
		/*border: 1px solid #f7f7f7;*/
		border-radius: 10px;
		cursor: pointer;
		box-shadow: 0px 5px 10px -5px #ccc;
	}
	.sec-1 .items .item-head {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 10px 0px;
	}
	.sec-1 .items .item-head h4 {
		color: var(--text-color);
		font-size: 15px;
		font-weight: 400;
	}
	.sec-1 .items .item-head span {
		color: var(--light-text-color);
		font-size: 22px;
		transition: all 0.2s ease-in-out;
	}
	.sec-1 .show-content .item-head span {
		transform: rotate(90deg);
	}
	.sec-1 .items .item-body {
		display: none;
		margin-top: 20px;
	}
	.sec-1 .items .item-body p {
		color: var(--text-color);
		font-size: 13px;
		font-weight: 300;
		line-height: 24px;
		color: var(--light-text-color);
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
			width: calc(50% - 20px);
			max-width: 480px;
			margin: 0px auto 40px auto;
		}
	}

	@media screen and (min-width:  960px) {
		.sec-1 .items-content {
			flex-direction: row;
			align-items: flex-start;
		}
		.sec-1 .img-content {
			margin: 0px 40px 0px 0px;
		}
		.sec-1 .text-content {
			margin: 40px 0px 0px 0px;
		}

	}
</style>

<?php
	include "widgets/footer.php"
?>