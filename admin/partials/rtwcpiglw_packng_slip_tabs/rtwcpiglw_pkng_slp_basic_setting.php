<?php

if(isset(($_POST['rtwcpiglw_submit'])))
	{ 
?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e('Settings saved.','rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce'); ?></strong></p>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text"><?php esc_html_e('Dismiss this notices.','rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce'); ?></span>
			</button>
		</div>
		<?php

		update_option( 'rtwcpiglw_pkngslp_basic_stng_opt', sanitize_post( $_POST['rtwcpiglw_pkngslp_basic_stng_opt'] ));
	}

	$rtwcpiglw_get_setting = get_option('rtwcpiglw_pkngslp_basic_stng_opt');
	?>

	<table class="wp-list-table form-table rtw-table">
		<tbody>
			<tr>
				<th class="descr"><?php esc_html_e( 'Enable Packing Slip', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce' ); ?></th>
				<td class="descr_2">
					<input type="checkbox" name="rtwcpiglw_pkngslp_basic_stng_opt[rtwcpiglw_enable_pkng_slp]" value="1" <?php checked( $rtwcpiglw_get_setting['rtwcpiglw_enable_pkng_slp'], 1 ); ?> />
					<div class="descr"><?php esc_html_e( 'Check it if you want generate packing slip for orders.', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce' );?></div>
				</td>
			</tr>
			<tr>
				<th class="descr"><?php esc_html_e( 'Download Packing Slip', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce' ); ?></th>
				<td class="descr_2">
					<input type="checkbox" name="rtwcpiglw_pkngslp_basic_stng_opt[rtwcpiglw_download_pkng_slp]" value="1" <?php checked( $rtwcpiglw_get_setting['rtwcpiglw_download_pkng_slp'], 1 ); ?> />
					<div class="descr"><?php esc_html_e( 'Check it if you want to download packing slip of an order from Order List Page', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce' );?></div>
				</td>
			</tr>
			<tr>
				<th class="descr"><?php esc_html_e( 'Rtl Support', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce' ); ?></th>
				<td class="descr_2">
					<input type="checkbox" name="rtwcpiglw_pkngslp_basic_stng_opt[rtwcpiglw_pkng_slp_page_no]" value="1" <?php checked( $rtwcpiglw_get_setting['rtwcpiglw_pkng_slp_page_no'], 1 ); ?> />
					<div class="descr"><?php esc_html_e( 'Check it if you want generate packing slip in Arabic or languages which start from right align.', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce' );?></div>
				</td>
			</tr>
			<tr>
				<th class="descr"><span class="rtwcpiglw_pro_image"><img src="<?php echo esc_url( RTWCPIGLW_URL.'assets/pro.png' ); ?>" alt="pro_feature"></span><span class="rtwcpiglw_pro_text"><?php esc_html_e( 'Hide Page No.', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce' ); ?></span></th>
				<td class="descr_2">
					<input type="checkbox" />
					<div class="rtwcpiglw_pro_descr"><?php esc_html_e('This Feature Is Available in PRO.', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce');?></div>
				</td>
			</tr>
			<tr>
				<th class="descr"><span class="rtwcpiglw_pro_image"><img src="<?php echo esc_url( RTWCPIGLW_URL.'assets/pro.png' ); ?>" alt="pro_feature"></span><span class="rtwcpiglw_pro_text"><?php esc_html_e('Set background Image for Packing Slip PDF', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce');?></span></th>
				<td>
					<?php $rtwcpiglw_src_img = isset($rtwcpiglw_get_setting['bck_img_url'] ) ? $rtwcpiglw_get_setting['bck_img_url'] : '';?>
					<div id="rtwcpiglw_bckgrnd_img">
						<img id="rtwcpiglw_bckgrnd_img_btn" src="<?php echo esc_url($rtwcpiglw_src_img); ?>"/>
					</div>
					<div id="rtwcpiglw_bck_img">
						<input type="hidden" id="rtwcpiglw_bck_img_url"
						name="rtwcpiglw_pkngslp_basic_stng_opt[bck_img_url]"
						value="<?php echo esc_attr($rtwcpiglw_src_img); ?>" />
						<button disabled="disabled" type="button" class="rtwcpiglw_btn_bckgrnd_img_upload button"><?php esc_html_e( 'Upload/Add image', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce'); ?></button><br>
						<?php if($rtwcpiglw_src_img != ''){ ?>
							<button type="button" class="rtwcpiglw_btn_remove_bckgrnd_img button"><?php esc_html_e( 'Remove image', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce'); ?></button>
						<?php } ?>
					</div>
					<div class="rtwcpiglw_pro_descr"><?php esc_html_e('This Feature Is Available in PRO.', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce');?></div>
				</td>
			</tr>
			<tr>
				<th class="descr"><?php esc_html_e('Select Background color For Packing Slip PDF', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce');?></th>
				<td>
					<?php $rtwcpiglw_back_color = isset($rtwcpiglw_get_setting['back_color'] ) ? $rtwcpiglw_get_setting['back_color'] : ''; ?>
					<div class="wp-picker-container">
						<input class="color-field" type="text" name="rtwcpiglw_pkngslp_basic_stng_opt[back_color]" value="<?php echo esc_attr($rtwcpiglw_back_color); ?>" />
					</div>
					<div class="descr"><?php esc_html_e('Choose the color for your packing slip pdf background.', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce');?></div>
				</td>
			</tr>
		</tbody>
	</table>