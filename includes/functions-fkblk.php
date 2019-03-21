<?php
/**
 * Fakeblock Functions.
 *
 * @since    [version]
 * @version  [version]
 */

/**
 * Retrieve a Fakeblock option.
 *
 * @since [version]
 * @version [version]
 *
 * @param string $name Option name.
 * @param mixed $default Default value.
 * @return mixed
 */
function fkblk_get( $name, $default = 'no' ) {
	return get_option( 'fkblk_' . $name, $default );
}

function is_fkblkd() {

	$cookie = filter_input( INPUT_COOKIE, 'fkblk' );
	if ( is_null( $cookie ) ) {
		return true;
	}

	return false;

}
