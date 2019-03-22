<?php
$bpm = fkblk_get( 'bpm', 120 );
$bars = fkblk_get( 'bars', 2 );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<form action="" method="POST">

	<h1>YOU HAVE BEEN FAKEBLOCKED</h1>

	<h2><?php printf( _n( 'Keep time at %1$d bpm for %2$d bar to access this site.', 'Keep time at %1$d bpm for %2$d bars to access this site.', $bars, 'fakeblock' ), $bpm, $bars ); ?></h2>

	<div class="fkblk-visualizer" id="fkblk-visualizer">

		<div class="staff">

			<?php
				$i = 1;
				while ( $i <= $bars ) :
			?>
			<div class="bar">
				<div class="beat">1 <div class="bg"></div>
				</div>
				<div class="beat">2 <div class="bg"></div>
				</div>
				<div class="beat">3 <div class="bg"></div>
				</div>
				<div class="beat">4 <div class="bg"></div>
				</div>
			</div>
			<?php
				$i++;
				endwhile;
			?>

		</div>

		<div class="pad" id="fkblk-pad"><div class="text">TAP HERE</div><div class="bg"></div></div>

	</div>

	<div class="fkblk-results">
		<?php printf( __( 'You hit %1$s of %2$s beats.', 'fakeblock' ), '<span id="fkblk-hits-good"></span>', '<span id="fkblk-hits-total"></span>' ); ?>
	</div>

	<button type="submit" id="fkblk-unblock-start"><?php _e( 'Unblock Me', 'fakeblock' ); ?></button>
	<?php wp_nonce_field( 'fkblk-unblk', 'fkblk_nonce' ); ?>

</form>

<?php wp_footer(); ?>

</body>
</html>
