<?php
	include "header.php";
	include 'classes/activity.php';

	$message = "";

	if (isset($_GET['post']) && DB::query('SELECT id FROM posts WHERE permalink=:permalink', array(':permalink'=>$_GET['post']))) {
		$post_id = DB::query('SELECT id FROM posts WHERE permalink=:permalink', array(':permalink'=>$_GET['post']))[0]['id'];
?>
<div class="single-page-wrapper">
	<div class="single-page">
	<?php
		$posts = DB::query('SELECT * FROM posts WHERE id=:postid  ORDER BY id DESC', array(':postid'=>$post_id));
		if (Login::isLoggedIn()) {
			// Activity::post_views($userid, $post_id);
		}
		foreach ($posts as $post) {
			$date = strtotime($post['date']);
	?>
		<article class="<?php if ($post['featured_image'] != "none") { echo 'has-thumbnail'; } else { echo 'no-thumbnail'; } ?> ">
			<div class="single-post-header">
				<div class="post-thumbnail">
					<?php if ($post['featured_image'] != "none") { ?>
						<img src="<?php echo $homeURL . "/img/" . $post['featured_image']; ?>" alt="featured image">
					<?php } ?>
				</div>

				<h2 class="post-title"><?php echo $post['title']; ?></h2>
				<div class="post-meta">
					<?php if($post['post_type'] != 'page'){ ?>
						<span class="site-author">Posted by Admin</span>
						<span class="entry-date"><i class="far fa-clock"></i> <?php echo date('jS M Y', $date) . ', ' . date('H:ia', $date); ?></span>
					<?php } ?>
				</div>
			</div>

				<div class="entry-content">
					<p><?php echo $post['content']; ?></p>
					<?php
						if (Login::isLoggedIn()) {
							if ($post['post_type'] == "sponsored") {
								Activity::sponsored_points($userid, $post_id);
							}
						}	
					?>
				</div>
				<?php
					if (Login::isLoggedIn()) {
						if ($post['post_type'] == "post") {
							if (isset($_POST['comment'])) {
								if (!empty($_POST['comment-body']) && strlen($_POST['comment-body']) > 3) {
									DB::query('INSERT INTO comments VALUES (null, :user_id, :post_id, :comment, now())', array(':post_id'=>$post_id, ':user_id'=>$userid, ':comment'=>$_POST['comment-body']));
									// Activity::post_comment($userid, $post_id);
									$message = "<span class='success'>comment posted successfully!</span>";
								} else {
									$message = "<span class='error'>comment too short!</span>";
								}
							 } ?>
							 <div class="form-wrapper">
								<form method="POST" action="<?php echo $homeURL . "/post/" . $_GET['post']; ?>">
									<div class="form-response"><?php if($message != "") { echo $message; } ?></div>
									<textarea name="comment-body" placeholder="Type a comment ..."></textarea>
									<button type="submit" name="comment">comment</button>
								</form>
							</div>

							<?php if (DB::query('SELECT id FROM comments WHERE post_id=:post_id', array(':post_id'=>$post_id))) { ?>
								<div class="comment-wrapper">
									<?php
										$comments = DB::query('SELECT * FROM comments WHERE post_id=:post_id ORDER BY id DESC LIMIT 15', array(':post_id'=>$post_id));
										foreach ($comments as $comment) {
											$comment_user = DB::query('SELECT user_login FROM wpzs_users WHERE ID=:user_id', array(':user_id'=>$comment['user_id']))[0]['user_login'];
											?>
											<div class="comment-content">
												<img alt="photo" src="<?php echo $homeURL; ?>/img/theme/avatar-default.jpeg" />
												<div class="body">
													<div class="comment-head">
														<h4><?php echo $comment_user; ?></h4>
														<h6>- <?php echo date('jS M Y', strtotime($comment['date_posted'])); ?></h6>
													</div>
													<p>
														<?php echo $comment['body']; ?>
													</p>
												</div>
											</div>
									<?php } ?>
								</div>
						<?php }
						}
					}
				?>
			</article>
		<?php } ?>
		<?php include 'sidebar.php'; ?>
	</div>
</div>
<?php
	}
	include "footer.php";
?>