<?php
	use App\Framework\Database\Database as DB;

	$menu_items = explode(',', strip_tags(DB::query('SELECT title, content FROM posts WHERE title=:menu_name AND post_type="menu"', array(':menu_name'=>"header menu"))[0]['content']));
?>
<nav class="site-nav">
	<ul>
		<li><a href="<?php echo $homeURL; ?>/">Home</a></li>
		<?php
			foreach ($menu_items as $menu_item) {
				$navs = DB::query('SELECT id, title, permalink FROM posts WHERE id=:postid', array(':postid'=>$menu_item))[0];

				$permalink = $homeURL . "/".$navs['permalink'].""; ?>
				<li><a href="<?php echo $permalink; ?>"><?php echo $navs['title']; ?></a></li>
		<?php } ?>
		<li><a class="nav-link" href="<?php echo $homeURL; ?>/login">Sign in</a></li>
		<li><a class="nav-link" href="<?php echo $homeURL; ?>/signup">Sign up</a></li>
	</ul>
</nav>

<style type="text/css">
	.site-nav {
		display: none;
		position: fixed;
		top: 0px;
		left: 0px;
		width: 100%;
		height: 100vh;
		z-index: 999999;
	}
	.site-nav::after {
		content: "";
		display: block;
		position: absolute;
		top: 0px;
		left: 0px;
		width: 100%;
		height: 100%;
		background: #0006;
		z-index: 2;
		cursor: pointer;
	}
	.site-nav ul {
		position: relative;
		background: #fff;
		height: 100%;
		width: 180px;
		z-index: 3;
	}
	.site-nav ul li a {
		display: block;
		padding: 10px 15px;
		font-size: 13px;
		color: #f7f7f7;
		text-transform: capitalize;
		position: relative;
	}
	.site-nav ul li a::after {
		content: "";
		display: block;
		position: absolute;
		bottom: 0px;
		left: 0px;
		height: 1px;
		width: 0px;
		background: #ccc;
		transition: all 0.2s ease-in-out;
	}
	.floating-body .site-nav ul li a::after {
		background: #c4c4c4;
	}
	.site-nav ul li a:hover::after {
		width: 100%;
	}
	.floating-body .site-nav ul li a {
		color: #6e6d7a;
	}


	@media (min-width: 720px) {
		.site-nav {
			display: block !important;
			background: unset;
			position: unset;
			height: unset;
			width: unset;
		}
		.site-nav::after {
			display: none;
		}
		.site-nav ul {
			display: flex;
			align-items: center;
			background: unset;
			height: unset;
			width: unset;
		}
		.site-nav ul li {
			margin-right: 20px;
		}
		.site-nav ul li a {
			display: block;
			white-space: nowrap;
			padding: 8px 0px;
			margin: 0px 8px;
			font-size: 13px;
			text-transform: capitalize;
		}
		.site-nav ul li a.nav-link {
			display: flex;
			justify-content: center;
			align-items: center;
			color: #fff;
			height: 40px;
			width: 90px;
			font-size: 13px;
			border: 1px solid #ea79a3;
			background: transparent;
			color: #f7f7f7;
			border-radius: 4px;
		}
		.floating-body .site-nav ul li a.nav-link {
			color: #dd1f6f;
		}
		.site-nav ul li a.nav-link::after {
			display: none;
		}
		.site-nav ul li:last-child a {
			border: none;
			background: #dd1f6f;
		}
		.floating-body .site-nav ul li:last-child a {
			color: #fff;
		}
	}
</style>