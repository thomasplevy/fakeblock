<?php
/**
 * Fakeblock Functions.
 *
 * @since    [version]
 * @version  [version]
 */

defined( 'ABSPATH' ) || exit;

/**
 * Retrieve a Fakeblock option.
 *
 * @since [version]
 * @version [version]
 *
 * @param string $name Option name (unprefixed).
 * @param mixed $default Default value.
 * @return mixed
 */
function fkblk_get( $name, $default = 'no' ) {
	return get_option( 'fkblk_' . $name, $default );
}

/**
 * Update a Fakeblock option.
 *
 * @since [version]
 * @version [version]
 *
 * @param string $name Option name (unprefixed).
 * @param mixed $val Option value.
 * @return bool True on success, false if option is unchanged or failed.
 */
function fkblk_set( $name, $val ) {
	return update_option( 'fkblk_' . $name, $val );
}

function fkblk_set_unblock() {

	$expires = current_time( 'timestamp' ) + apply_filters( 'fkblk_unblock_time', DAY_IN_SECONDS );
	$key = apply_filters( 'fkblk_unblock_key', uniqid( wp_generate_password( 8, false ) ) );
	$hash = fkblk_make_code( $key, $expires );
	fkblk_set( $hash, array( $key, $expires ) );
	return $hash;

}

function fkblk_make_code( $key, $expires ) {
	return wp_hash( sprintf( '%1$s:::%2$d', $key, $expires ) );
}

/**
 * Determine if a given unblock code is valid.
 *
 * A valid code exists and is not expired.
 *
 * @since [version]
 * @version [version]
 *
 * @param string $code Unblock code.
 * @return bool
 */
function fkblk_verify_unblock( $code ) {

	$data = fkblk_get( $code, array() );

	if ( empty( $data ) ) {
		return false;
	} elseif ( ! is_array( $data ) || 2 !== count( $data ) ) {
		return false;
	} elseif ( $code !== fkblk_make_code( $data[0], $data[1] ) ) {
		return false;
	}

	return ( $data[1] > current_time( 'timestamp' ) );

}

/**
 * Determine if the visitor is fakeblocked.
 *
 * @since [version]
 * @version [version]
 *
 * @return bool
 */
function is_fkblkd() {

	$cookie = filter_input( INPUT_COOKIE, 'fkblk' );

	// No cookie set.
	if ( empty( $cookie ) ) {
		return true;
	}

	return ! fkblk_verify_unblock( $cookie );

}
