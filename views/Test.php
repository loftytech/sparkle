<div class="wrapper">
	<h2>Welcome to <?php echo env("APP_NAME"); ?></h2>
	<p>This is a demo page for illustration purposes. You can edit or remove the file in the views directory. </p>

	<div class="counter-box">
		<span>counter: {counter} lol</span>
		<button class="james-lol" onclick="loftyVest()">update</button>
	</div>

	<input type="text" oninput="updateName(event)" />
	<p>{userName}</p>


	<div currency="naira" class="meta-links">
		<ul id="lol">
			<li><a target="_blank" href="https://github.com/loftytech/sparkle"><i class="fa-brands fa-github"></i><span>github {counter} stars</span></a></li>
			<li><a target="_blank" href="https://twitter.com/loftycodes"><i class="fa-brands fa-twitter"></i><span>twitter</span></a></li>
			<li><a target="_blank" href="https://www.linkedin.com/in/gabriel-ikuejawa-60756b17a/"><i class="fa-brands fa-linkedin"></i><span>linkedin</span></a></li>
		</ul>
	</div>
</div>

<style lang="scss">
	* {
		padding: 0px;
		margin: 0px;
	}
	.wrapper {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		background-color: #222;
		padding: 20px;
		min-height: 100vh;
		gap: 20px;
		color: #fff;

		.counter-box {
			display: flex;
			align-items: center;
			gap: 20px;
			background-color: #000;
			padding: 20px;

			button {
				padding: 0px 20px;
				height: 40px;
				border: none;
			}
		}
	}
</style>

<script>
    let counter = useState(0)
    let userName = useState("felix")

	const loftyVest = () => {
		counter = counter + 1;
		updateState("counter")
		console.log("count: ", counter)
	}

	const updateName = (e) => {
		userName = e.target.value
		updateState("userName")
	}
	
	// document.querySelector(".james-lol").addEventListener('click', () => {
	// 	++counter
	// 	updateState("counter")
	// })
</script>

