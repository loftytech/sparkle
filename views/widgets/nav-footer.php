<?php

use App\Framework\Database\Database as DB;

	$menu_items = explode(',', strip_tags(DB::query('SELECT title, content FROM posts WHERE title=:menu_name AND post_type="menu"', array(':menu_name'=>"footer menu"))[0]['content']));
?>
<?php
	// foreach ($menu_items as $menu_item) {
	// 	$navs = DB::query('SELECT id, title, permalink FROM posts WHERE id=:postid', array(':postid'=>$menu_item))[0];

	// 	$permalink = $homeURL . "/post/".$navs['permalink']."";
?>
	<!-- <li><a href="<?php // echo $permalink; ?>"><?php // echo $navs['title']; ?></a></li> -->
<?php //} ?>

<div class="links company">
	<h4>company</h4>
	<ul>
		<li><a href="#">About us</a></li>
		<li><a href="#">Contact us</a></li>
		<li><a href="#">Careers</a></li>
	</ul>
</div>
<div class="links services">
	<h4>Services</h4>
	<ul>
		<li><a href="#">Bank transfer</a></li>
		<li><a href="#">Airtime</a></li>
		<li><a href="#">Bill payments</a></li>
	</ul>
</div>
<div class="links quick-links">
	<h4>quick links</h4>
	<ul>
		<li><a href="#">API</a></li>
		<li><a href="#">Blog</a></li>
	</ul>
</div>
<div class="links legal">
	<h4>Legal</h4>
	<ul>
		<li><a href="#">Privacy policy</a></li>
		<li><a href="#">Terms and conditions</a></li>
	</ul>
</div>