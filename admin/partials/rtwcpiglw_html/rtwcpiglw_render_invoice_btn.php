<?php
	global $post;

	if( $post->ID )
	{
		$pdf_name = get_option( 'rtwcpiglw_custm_pdf_name' );
		if ( $pdf_name == '' ) {
		$pdf_name = 'rtwcpiglw_';
		}
		$rtwcpiglw_order = wc_get_order( $post->ID );
		$rtwcpiglw_order_id = $rtwcpiglw_order->get_id();
		$rtw_permalink = get_admin_url().'post.php?post='.$rtwcpiglw_order_id.'&action=edit&rtwcpiglw_order_id='.$rtwcpiglw_order_id;

		$rtwcpiglw_url = RTWCPIGLW_PDF_URL.$pdf_name.$rtwcpiglw_order_id.'.pdf';
		$rtwcpiglw_dir = RTWCPIGLW_PDF_DIR.$pdf_name.$rtwcpiglw_order_id.'.pdf';
		
		$rtwcpiglw_order_status = $rtwcpiglw_order->get_status(); // Get the order status
		
		if (file_exists($rtwcpiglw_dir)) 
		{
			if ( $rtwcpiglw_order_status == 'completed' ) 
			{
				$btn_txt = get_option( 'rtwcpiglw_custm_btn_txt' );
				if ( $btn_txt == '' ) {
					$btn_txt = 'Download Normal Invoice';
					$other_txt = 'Invoice';
				}else{
					$other_txt = 'License';
				}
				?>
				
				<div class="rtwcpiglw_btn_wrap">

					<a class="rtwcpiglw_btn button button-primary" id="rtwcpiglw_nrml_btn" target="_blank" href="<?php echo esc_url($rtw_permalink); ?>" download><?php esc_html_e($btn_txt, 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce'); ?></a>
				</div>



				<?php 
			}
			else
			{
				$btn_txt = get_option( 'rtwcpiglw_custm_btn_txt' );
				if ( $btn_txt == '' ) {
					$btn_txt = 'Download Proforma Invoice';
					$other_txt = 'Invoice';
				}else{
					$other_txt = 'License';
				}
				if( get_option('rtwcpiglw_allow_proforma_dwnlod') == 'yes' ){
				?>
					<div class="rtwcpiglw_btn_wrap">
						<a class="rtwcpiglw_btn button button-primary" id="rtwcpiglw_prfrm_btn" target="_blank" href="<?php echo esc_url($rtw_permalink); ?>" download><?php esc_html_e($btn_txt, 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce'); ?>	
						</a>	
				<?php
				} 				
			}
		}
		else
		{
			if ( $rtwcpiglw_order_status == 'completed' && get_option('rtwcpiglw_dwnld_edit_ordr_page') == 'yes') 
			{
				$btn_txt = get_option( 'rtwcpiglw_custm_btn_txt' );
				if ( $btn_txt == '' ) {
					$btn_txt = 'Download Proforma Invoice';
					$other_txt = 'Invoice';
				}else{
					$other_txt = 'License';
				}
				?>
				
				<div class="rtwcpiglw_btn_wrap">

					<a class="rtwcpiglw_display_none rtwcpiglw_btn button button-primary" id="rtwcpiglw_nrml_btn" target="_blank" href="<?php echo esc_url($rtw_permalink); ?>" download><?php esc_html_e($btn_txt, 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce'); ?></a>
				
					<a class="button button-primary rtwcpiglw_btn" id="rtwcpiglw_regnrt_invoice" href="javascript:void(0);" data-order_id="<?php echo esc_attr($post->ID); ?>" data-order_status="<?php echo esc_attr($rtwcpiglw_order_status); ?>"><?php esc_html_e('Regenerate '.$other_txt, 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce'); ?></a>
				</div>



				<?php 
			}
			else
			{
				$btn_txt = get_option( 'rtwcpiglw_custm_btn_txt' );
				if ( $btn_txt == '' ) {
					$btn_txt = 'Download Proforma Invoice';
					$other_txt = 'Invoice';
				}else{
					$other_txt = 'License';
				}
				if( get_option('rtwcpiglw_allow_proforma_dwnlod') == 'yes' ){
				?>
					<div class="rtwcpiglw_btn_wrap">
						<a class="rtwcpiglw_display_none rtwcpiglw_btn button button-primary" id="rtwcpiglw_prfrm_btn" target="_blank" href="<?php echo esc_url($rtw_permalink); ?>" download><?php esc_html_e($btn_txt, 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce'); ?></a>
						
						<a class="button button-primary rtwcpiglw_btn" id="rtwcpiglw_regnrt_invoice" href="javascript:void(0);" data-order_id="<?php echo esc_attr($post->ID); ?>" data-order_status="<?php echo esc_attr($rtwcpiglw_order_status); ?>"><?php esc_html_e('Regenerate '.$other_txt, 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce'); ?></a>
					</div>
				<?php
				}			
			}
		}
	}
?>