<?php
/**
 * Fakeblock Admin Options panel
 *
 * @package Fakeblock/Admin/Views
 *
 * @since [version]
 * @version [version]
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="wrap fkblk">

	<h1><?php _e( 'Fakeblock', 'fakeblock' ); ?></h1>

	<form action="<?php echo esc_url( admin_url( 'admin.php?page=fkblk' ) ); ?>" method="POST">

		<table class="form-table">
			<tbody>

				<tr>
					<th scope="row"><?php _e( 'Privacy Mode', 'fakeblock' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'Privacy Mode', 'fakeblock' ); ?></span>
							</legend>
							<label for="fkblk_privacy_mode">
								<input name="fkblk_privacy_mode" type="checkbox" id="fkblk_privacy_mode" value="yes" <?php checked( 'yes', fkblk_get( 'privacy_mode' ) ); ?>>
								<?php _e( 'Enable Privacy Mode', 'fakeblock' ); ?>
							</label>
						</fieldset>
						<p class="description"><?php _e( 'Enable the unpatented Fakeblock privacy algorithms to prevent internet attention, traffic, and other common online annoyances.', 'fakeblock' ); ?></p>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="fkblk_bpm"><?php _e( 'Unlock BPM', 'fakeblock' ); ?></label></th>
					<td>
						<input name="fkblk_bpm" type="number" id="fkblk_bpm" value="<?php echo fkblk_get( 'bpm', 120 ); ?>" class="regular-text" step="1" min="1">
						<p class="description"><?php _e( 'The beats per minute required to bypass a Fakeblock.', 'fakeblock' ); ?></p>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="fkblk_bars"><?php _e( 'Unlock Bars', 'fakeblock' ); ?></label></th>
					<td>
						<input name="fkblk_bars" type="number" id="fkblk_bars" value="<?php echo fkblk_get( 'bars', 2 ); ?>" class="regular-text" step="1" min="1">
						<p class="description"><?php _e( 'The number of bars to be played when bypassing a Fakeblock.', 'fakeblock' ); ?></p>
					</td>
				</tr>

				<tr>
					<th scope="row"><?php _e( 'Anti-Piracy', 'fakeblock' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'Anti-Piracy', 'fakeblock' ); ?></span>
							</legend>
							<label for="fkblk_anti_piracy">
								<input name="fkblk_anti_piracy" type="checkbox" id="fkblk_anti_piracy" value="yes" <?php checked( 'yes', fkblk_get( 'anti_piracy' ) ); ?>>
								<?php _e( 'Enable Anti-Piracy Protection', 'fakeblock' ); ?>
							</label>
						</fieldset>
						<p class="description"><?php _e( '"Fakeblock is also anti-piracy? That\'s awesome!" ~ A fake user', 'fakeblock' ); ?></p>
					</td>
				</tr>

			</tbody>
		</table>

		<p class="submit">
			<?php wp_nonce_field( 'fkblk-options', 'fkblk_nonce' ); ?>
			<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'fakeblock' ); ?>">
		</p>

	</form>

</div>

