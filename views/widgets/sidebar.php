<?php
	use App\Controllers\Database as DB;
?>
<div class="videos-wrapper">
	<div class="video-content">
	<?php
		$posts = DB::query('SELECT id, title, featured_image, content, permalink, post_type, date FROM posts WHERE post_type="post"  ORDER BY id DESC  LIMIT 6');
		foreach ($posts as $post) {
			$content = strip_tags(DB::query('SELECT SUBSTRING_INDEX(content," ", 20) FROM posts WHERE id=:postid', array(':postid'=>$post['id']))[0][0]);
			$date = strtotime($post['date']);
			$content_length = str_word_count(strip_tags($post['content']));
			$permalink = $homeURL . "/video/".$post['permalink']."";
	?>

		<article>
			<?php if ($post['featured_image'] != "none") { ?>
				<div class="post-image">
					<a href="<?php echo $homeURL . '/post/'.$post['permalink'].''; ?>">
						<img src="<?php echo $homeURL . "/img/" . $post['featured_image']; ?>" alt="featured image">
					</a>
				</div>
			<?php } ?>
			<div class="post-body">
				<h2 class="video-title">
					<a href="<?php echo $homeURL . '/post/'.$post['permalink'].''; ?>">
						<?php echo $post['title'] ?>
					</a>
				</h2>
				<div class="entry-content">
					<p>
						<a href="<?php echo $homeURL . '/post/'.$post['permalink'].''; ?>">
							<?php
								if ($content_length > 20) {
									echo $content . " ...";
								} else {
									echo $content;
								}
							?>
						</a>
					</p>
				</div>
				<div class="post-meta">
					<span class="post-time">- posted at </i><?php echo date('jS M Y', $date); ?></span>
				</div>
			</div>
		</article>
	<?php } ?>
	</div>
</div>


<style type="text/css">
	.videos-wrapper {
		width: 100%;
		padding-top: 20px;
		border-top: 1px solid #eee;
	}
	.video-content article {
		display: flex;
		flex-wrap: wrap;
		flex-direction: column;
		margin-bottom: 20px;
		width: 100%;
		max-width: 640px;
	}
	.video-content article .post-image {
		width: 100%;
		height: 200px;
		border-radius: 8px;
		margin-right: 10px;
		margin-bottom: 10px;
		overflow: hidden;
	}
	.video-content article .post-image a {
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.video-content article .post-image a img {
		min-width: 100%;
		min-height: 180px;
	}
	.video-content article .post-body {
		flex: 1;
	}
	.video-content article .video-title {
		margin-bottom: 10px;
	}
	.video-content article .video-title a {
		display: block;
		color: var(--text-color);
		font-size: 16px;
		font-weight: 600;
	}
	.video-content article .entry-content p a {
		display: block;
		color: var(--text-color);
		font-size: 13px;
		font-weight: 400;
		line-height: 24px;
	}
	.video-content article .post-meta {
		display: flex;
		justify-content: flex-end;
		margin-top: 4px;
	}
	.video-content article .post-meta span {
		font-size: 12px;
		font-weight: 400;
		color: var(--text-color);
	}

	@media screen and (min-width: 720px) {
		.video-content article {
			max-width: 640px;
			flex-direction: row;
		}
		.video-content article .post-image {
			width: 185px;
			height: 160px;
		}
	}

	@media screen and (min-width: 960px) {
		.videos-wrapper {
			width: 40%;
			padding-top: 0px;
			border-top: none;
		}
		.video-content article {
			max-width: 640px;
			flex-direction: column;
		}
		.video-content article .post-image {
			width: 100%;
			height: 200px;
		}
	}

	@media screen and (min-width: 1080px) {
		.video-content article {
			max-width: 480px;
			flex-direction: row;
		}
		.video-content article .post-image {
			width: 185px;
			height: 160px;
		}
	}
</style>