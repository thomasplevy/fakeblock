<!doctype html>
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

	<?php wp_nonce_field( 'fkblk-unblk', 'fkblk_nonce' ); ?>

	<button type="submit"><?php _e( 'Unblock Me', 'fakeblock' ); ?></button>

</form>

<?php wp_footer(); ?>

</body>
</html>
