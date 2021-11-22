<?php
/**
 * Contribution Product class.
 *
 * Provides a CiviCRM Contribution Product.
 *
 * @package WPCV_Woo_Civi
 * @since 3.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * CiviCRM Contribution Product class.
 *
 * @since 3.0
 */
class WC_Product_CiviCRM_Contribution extends WC_Product_Simple {

	/**
	 * WooCommerce Product Type.
	 *
	 * @since 3.0
	 * @access public
	 * @var str $product_type The WooCommerce Product Type.
	 */
	public $product_type = 'civicrm_contribution';

	/**
	 * Class constructor.
	 *
	 * @since 3.0
	 *
	 * @param WC_Product|int $product Product instance or ID.
	 */
	public function __construct( $product = 0 ) {
		parent::__construct( $product );
	}

	/**
	 * Gets the internal Product Type name.
	 *
	 * @since 3.0
	 *
	 * @param str $product_type The internal Product Type name.
	 */
	public function get_type() {
		return $this->product_type;
	}

	/**
	 * Cannot be stock managed.
	 *
	 * @since 3.0
	 *
	 * @param bool $manage_stock If manage stock.
	 */
	public function set_manage_stock( $manage_stock ) {
		$this->set_prop( 'manage_stock', false );
 		if ( true === $manage_stock ) {
 			$this->error(
				'product_' . $this->product_type . '_invalid_manage_stock',
				__( 'CiviCRM Contributions cannot be stock managed.', 'wpcv-woo-civi-integration' )
			);
 		}
	}

	/**
	 * Cannot be stock managed.
	 *
	 * @since 3.0
	 *
	 * @param string $stock_status Stock status.
	 */
	public function set_stock_status( $stock_status = '' ) {
		$this->set_prop( 'stock_status', 'instock' );
		if ( 'instock' !== $stock_status ) {
 			$this->error(
				'product_' . $this->product_type . '_invalid_stock_status',
				__( 'CiviCRM Contributions cannot be stock managed.', 'wpcv-woo-civi-integration' )
			);
		}
	}

	/**
	 * Cannot be backordered.
	 *
	 * @since 3.0
	 *
	 * @param string $backorders Options: 'yes', 'no' or 'notify'.
	 */
	public function set_backorders( $backorders ) {
		$this->set_prop( 'backorders', 'no' );
		if ( 'no' !== $backorders ) {
			$this->error(
				'product_' . $this->product_type . '_invalid_backorders',
				__( 'CiviCRM Contributions cannot be backordered.', 'wpcv-woo-civi-integration' )
			);
		}
	}

	/**
	 * Always define as Virtual Product. No shipping.
	 *
	 * @since 3.0
	 *
	 * @return boolean
	 */
	public function is_virtual() {
		return true;
	}

	/**
	 * Is never a Downloadable Product.
	 *
	 * @since 3.0
	 *
	 * @return boolean
	 */
	public function is_downloadable() {
		return false;
	}

	/**
	 * Checks if the Product is purchasable.
	 *
	 * We may wish to prevent this if the Customer already has a current Contribution.
	 *
	 * @since 3.0
	 *
	 * @return boolean
	 */
	public function is_purchasable() {
		return true;
	}

}
