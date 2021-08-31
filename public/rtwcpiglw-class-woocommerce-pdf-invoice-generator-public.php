<?php
/**
 * The public-specific functionality of the plugin.
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    rtwcpiglw_Woocommerce_Pdf_Invoice_Generator
 * @subpackage rtwcpiglw_Woocommerce_Pdf_Invoice_Generator/public
 */
/**
 * The public-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-specific stylesheet and JavaScript.
 *
 * @package    rtwcpiglw_Woocommerce_Pdf_Invoice_Generator
 * @subpackage rtwcpiglw_Woocommerce_Pdf_Invoice_Generator/public
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class rtwcpiglw_Woocommerce_Pdf_Invoice_Generator_Public {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rtwcpiglw_plugin_name    The ID of this plugin.
	 */
	private $rtwcpiglw_plugin_name;
	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rtwcpiglw_version    The current version of this plugin.
	 */
	private $rtwcpiglw_version;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $rtwcpiglw_plugin_name       The name of this plugin.
	 * @param      string    $rtwcpiglw_version    The version of this plugin.
	 */
	public function __construct( $rtwcpiglw_plugin_name, $rtwcpiglw_version ) {
		$this->rtwcpiglw_plugin_name = $rtwcpiglw_plugin_name;
		$this->rtwcpiglw_version = $rtwcpiglw_version;
		$this->rtwcpiglw_allow_html = array(
						      'a' => array(
						        'href' => array(),
						        'title' => array(),
						        'class' => array(),
						        'data' => array(),
						        'rel'   => array(),
						      ),
						      'br' => array(),
						      'em' => array(),
						      'ul' => array(
						          'class' => array(),
						      ),
						      'ol' => array(
						          'class' => array(),
						      ),
						      'li' => array(
						          'class' => array(),
						      ),
						      'strong' => array(),
						      'div' => array(
						        'class' => array(),
						        'data' => array(),
						        'style' => array(),
						      ),
						      'span' => array(
						        'class' => array(),
						        'style' => array(),
						      ),
						      'img' => array(
						          'alt'    => array(),
						          'class'  => array(),
						          'height' => array(),
						          'src'    => array(),
						          'width'  => array(),
						      ),
						      'select' => array(
						          'id'   => array(),
						          'class' => array(),
						          'name' => array(),
						      ),
						      'option' => array(
						          'value' => array(),
						          'selected' => array(),
						      ),
	    					);
	}

	/**
	 * Register the stylesheets for the public area.
	 *
	 * @since    1.0.0
	 */
	public function rtwcpiglw_enqueue_styles() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the rtwwcfp_run() function
		 * defined in Wordpress_Contact_Form_7_Pdf_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Contact_Form_7_Pdf_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->rtwcpiglw_plugin_name, plugin_dir_url( __FILE__ ) . 'css/rtwcpiglw-woocommerce-pdf-invoice-generator-public.css', array(), $this->rtwcpiglw_version, 'all' );
	}
	/*
	* function to download PDF Invoice.
	*/
	function rtwcpiglw_invoice_download_callback(){
		if( isset( $_GET[ 'rtwcpiglw_order_id' ] ) ){
			$rtwcpiglw_file_name = 'rtwcpiglw_'.sanitize_text_field($_GET[ 'rtwcpiglw_order_id' ]).'.pdf';
			$rtwcpiglw_file_url 	= RTWCPIGLW_PDF_URL.'/'. $rtwcpiglw_file_name;
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"".$rtwcpiglw_file_name."\""); 
			readfile( $rtwcpiglw_file_url );
			exit;
		}
	}
    
	/**
	 * function for generate invoice.
	 *
	 * @since    1.0.0
	 */
	function rtwcpiglw_generate_invoice($rtwcpiglw_odr_id, $rtwcpiglw_posted_data, $rtwcpiglw_odr_objct)
	{
		$rtwcpiglw_pdf_invoice = rtwcpiglw_make_invoice($rtwcpiglw_odr_id, $rtwcpiglw_odr_objct);
	}

	/**
	 * function for create packing slip for an order.
	 *
	 * @since    1.0.0
	 */
	function rtwcpiglw_create_packng_slip($rtwcpiglw_ordr_no,$rtwcpiglw_adrss,$rtwcpiglw_ordr_obj)
	{
		$rtwcpiglw_pkngslp_pdf = rtwcpiglw_create_pdf_packngslip($rtwcpiglw_ordr_no,$rtwcpiglw_ordr_obj);
	}
	/**
	 * function for provide download invoice link in order detail page to the user.
	 *
	 * @since    1.0.0
	 */
	public function rtwcpiglw_user_invoice_link($rtwcpiglw_order)
	{
		$pdf_name = get_option( 'rtwcpiglw_custm_pdf_name' );
		if ( $pdf_name == '' ) {
		$pdf_name = 'rtwcpiglw_';
		}
		global $wp;
		$rtwcpiglw_order_id = apply_filters( 'rtwcpiglw_change_order_id_for_invoice', $rtwcpiglw_order->get_id() );
		$rtwcpiglw_url = RTWCPIGLW_PDF_URL.$pdf_name.$rtwcpiglw_order_id.'.pdf';
		$rtwcpiglw_dir = RTWCPIGLW_PDF_DIR.$pdf_name.$rtwcpiglw_order_id.'.pdf';
		$rtw_permalink = add_query_arg ( array( 'rtwcpiglw_order_id' => $rtwcpiglw_order_id ) , home_url( $wp->request ) );
		if(file_exists($rtwcpiglw_dir))
		{
			$btn_txt = get_option( 'rtwcpiglw_custm_btn_txt' );
			if ( $btn_txt == '' ) {
				$btn_txt = 'Download PDF Invoice';
			}
			$rtwcpiglw_status = $rtwcpiglw_order->get_status();
			if($rtwcpiglw_status == 'completed' )
			{
				if(get_option('rtwcpiglw_regular_invoice') =='yes' && (is_user_logged_in() == true ) && get_option('rtwcpiglw_dsply_dwnlod_on_ordr_detail_page') =='yes')
				{
					$rtwcpiglw_button = '<p id="rtwcpiglw_img_btn"><a href="'.esc_url($rtw_permalink).'" target="_blank" data-tip="'.esc_attr__('Download Normal Invoice', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce').'">' .
					'<img src="'.esc_url(RTWCPIGLW_URL.'assets/download_pdf.png').'" width="22px;" height="22px;" alt="'.esc_attr__( $btn_txt, 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce').'" >' .
					'<span>'. esc_html__($btn_txt ,'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce').'</span>' .
					'</a></p>';
					/** This is for displaying the button **/
					echo wp_kses($rtwcpiglw_button,$this->rtwcpiglw_allow_html);
				}
			}
			else
			{
				if (get_option('rtwcpiglw_proforma_invoice') =='yes' && get_option('rtwcpiglw_dwnld_prfrma_order_detail') == 'yes') 
				{
					$rtwcpiglw_button = '<p id="rtwcpiglw_img_btn"><a href="'.esc_url($rtw_permalink).'" target="_blank" data-tip="'.esc_attr__('Download Normal Invoice', 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce').'">' .
					'<img src="'.esc_url(RTWCPIGLW_URL.'assets/download_pdf.png').'" alt="'.esc_attr__($btn_txt, 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce').'" >' .
					'<span>'. esc_html__($btn_txt, 'rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce').'</span>' .
					'</a></p>';
					/** This is for displaying the button **/
					echo wp_kses($rtwcpiglw_button,$this->rtwcpiglw_allow_html);
				}
			}
		}
	}
	/**
	 * function for provide download link in my_account page.
	 *
	 * @since    1.0.0
	 */
	public function rtwcpiglw_orders_actions($rtwcpiglw_action, $rtwcpiglw_odr)
	{
		$pdf_name = get_option( 'rtwcpiglw_custm_pdf_name' );
		if ( $pdf_name == '' ) {
		$pdf_name = 'rtwcpiglw_';
		}
		$btn_txt = get_option( 'rtwcpiglw_custm_btn_txt' );
		if ( $btn_txt == '' ) {
			$btn_txt = 'Download PDF Invoice';
		}
		$rtwcpiglw_order_id = $rtwcpiglw_odr->get_id();
		if ( $rtwcpiglw_odr->get_status() == 'completed' ) 
		{
			if (get_option('rtwcpiglw_allow_dwnlod_frm_my_acnt') == 'yes' && get_option('rtwcpiglw_regular_invoice') == 'yes') 
			{
				$rtwcpiglw_url = RTWCPIGLW_PDF_URL.$pdf_name.$rtwcpiglw_order_id.'.pdf';
				$rtwcpiglw_title = $btn_txt;
			}	
		}
		else
		{
			if (get_option('rtwcpiglw_allow_proforma_dwnlod_frm_my_accnt') == 'yes' && get_option('rtwcpiglw_proforma_invoice') == 'yes') 
			{
				$rtwcpiglw_url = RTWCPIGLW_PDF_URL.$pdf_name.$rtwcpiglw_order_id.'.pdf';
				$rtwcpiglw_title = $btn_txt;
			}
		}
		if (isset($rtwcpiglw_url) && isset($rtwcpiglw_title)) 
		{
			$rtwcpiglw_action['rtwcpiglw-invoice'] = array(
				'url' => $rtwcpiglw_url,
				'name' => $rtwcpiglw_title,
			);
		}
		return $rtwcpiglw_action;
	}

	public function render_btn_for_mltivndr($rtwcpiglw_btn, $rtwcpiglw_order_obj)
    {
		$rtwcpiglw_dir = RTWCPIGLW_PDF_DIR."rtwcpiglw_".$rtwcpiglw_order_obj->get_id().'.pdf';
		$status = get_option( 'rtwcpiglw_when_gnrate_invoice' , array() );
		if ( empty($status) ) {
			$status = 'processing';
		}
		if( $rtwcpiglw_order_obj->get_status() == $status || $rtwcpiglw_order_obj->get_status() == 'completed'){
			if ( file_exists($rtwcpiglw_dir) ) {
	    		$rtwcpiglw_url = RTWCPIGLW_PDF_URL."rtwcpiglw_".$rtwcpiglw_order_obj->get_id().'.pdf';
	    		$rtwcpiglw_btn .= "<a href='".esc_url($rtwcpiglw_url)."' data-id='" . $rtwcpiglw_order_obj->get_id() . "' class='rtwmer_order_invoice'><i class='fas fa-file-invoice rtwmer_tooltip' aria-hidden='true'><span class='rtwmer_tooltiptext'>" . esc_html__("Download invoice", "rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce") . "</span></i></a>";
	    		
	    	}else{
				$rtwcpiglw_btn .= "<a href='#' data-id='" . $rtwcpiglw_order_obj->get_id() . "' class='rtwmer_order_generate_invoice'><i class='fas fa-file-invoice rtwmer_tooltip' aria-hidden='true'><span class='rtwmer_tooltiptext'>" . esc_html__("Generate invoice", "rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce") . "</span></i></a>";	
			}
		}
		$rtwcpiglw_package_dir = RTWCPIGLW_PDF_PCKNGSLP_DIR."rtwcpiglw_".$rtwcpiglw_order_obj->get_id().'.pdf';
		if ( file_exists($rtwcpiglw_package_dir) ) {
			$rtwcpiglw_packaging_url = RTWCPIGLW_PDF_PCKNGSLP_URL."rtwcpiglw_".$rtwcpiglw_order_obj->get_id().'.pdf';
			$rtwcpiglw_btn .= "<a href='".esc_url($rtwcpiglw_packaging_url)."' data-id='" . $rtwcpiglw_order_obj->get_id() . "' class='rtwcpiglw_packing_slip'><i class='fas fa-receipt rtwmer_tooltip' aria-hidden='true'><span class='rtwmer_tooltiptext'>" . esc_html__("Packing Slip", "rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce") . "</span></i></a>";
			
		}else{
			$rtwcpiglw_btn .= "<a href='#' data-id='" . $rtwcpiglw_order_obj->get_id() . "' class='rtwcpiglw_generate_packing_slip'><i class='fas fa-receipt rtwmer_tooltip' aria-hidden='true'><span class='rtwmer_tooltiptext'>" . esc_html__("Generate Packing Slip", "rtwcpiglw-pdf-invoice-generator-lite-for-woocommerce") . "</span></i></a>";
		}
		return $rtwcpiglw_btn;
	}

	function rtwcpiglw_create_invoice_cb(){
		if (check_ajax_referer("rtwcpiglw-ajax-security-string", 'rtwcpiglw_nonce')) {
			$rtwcpiglw_order_id = sanitize_text_field($_POST["rtwcpiglw_order_id"]);
			$rtwcpiglw_order_obj = wc_get_order($rtwcpiglw_order_id);
			$rtwcpiglw_file = rtwcpiglw_make_invoice($rtwcpiglw_order_id,$rtwcpiglw_order_obj);
			$rtwcpiglw_file["status"] = true;
			echo json_encode($rtwcpiglw_file);
			die();
		}
	}

	function rtwcpiglw_create_packaging_cb(){
		if (check_ajax_referer("rtwcpiglw-ajax-security-string", 'rtwcpiglw_nonce')) {
			$rtwcpiglw_order_id = sanitize_text_field($_POST["rtwcpiglw_order_id"]);
			$rtwcpiglw_order_obj = wc_get_order($rtwcpiglw_order_id);
			$rtwcpiglw_file = rtwcpiglw_create_pdf_packngslip($rtwcpiglw_order_id,$rtwcpiglw_order_obj);
			$rtwcpiglw_file["status"] = true;
			echo json_encode($rtwcpiglw_file);
			die();
		}
	}
}
