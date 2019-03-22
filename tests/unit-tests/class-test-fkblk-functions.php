<?php
/**
 * Test functions.
 *
 * @since    [version]
 * @version  [version]
 */
class FKBLK_Functions extends FKBLK_Unit_Test_Case {

	public function test_option_get_set() {

		$options = array(
			'wut' => 'test',
			'fake' => 123,
			'test' => 'Dh889izA09N9C78xld1GrvLiN4nauqLn',
			'sz7a3CpvUmj8E6oZ56YlyC3wRD6HnFz4' => 'arst',
		);

		foreach ( $options as $key => $val ) {

			$this->assertTrue( fkblk_set( $key, $val ) );
			$this->assertFalse( fkblk_set( $key, $val ) );

			$this->assertEquals( $val, fkblk_get( $key ) );
			$this->assertEquals( $val, get_option( 'fkblk_' . $key ) );

		}

	}

	public function test_option_get_defaults() {

		$this->assertEquals( 'no', fkblk_get( 'doesntexit' ) );
		$this->assertEquals( 'no', fkblk_get( 'doesntexit', 'no' ) );
		$this->assertEquals( 'yes', fkblk_get( 'doesntexit', 'yes' ) );
		$this->assertEquals( 'whatever', fkblk_get( 'doesntexit', 'whatever' ) );
		$this->assertEquals( false, fkblk_get( 'doesntexit', false ) );

	}

	public function test_set_unblock() {

		$hash = fkblk_set_unblock();
		$data = fkblk_get( $hash, array() );
		var_dump( $data );
		var_dump( $hash, wp_hash( $data[0] . ':::' . $data[1] ) );
		// var_dump( fkblk_set_unblock() );


	}

}
