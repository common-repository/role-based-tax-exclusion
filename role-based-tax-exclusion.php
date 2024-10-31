<?php
/**
 * Plugin Name:       Role Based Tax Exclusion
 * Description:       With this plugin administrator can define which user roles see prices in store and cart pages of WooCommerce without taxes
 * Version:           1.0.11
 * Requires at least: 5.8
 * Requires PHP:      8.0
 * Author:            Orwokki <info@orwokki.com>
 * Author URI:        https://orwokki.com
 * Developer:         Orwokki <info@orwokki.com>
 * Developer URI:     https://orwokki.com
 * Text Domain:       role-based-tax-exclusion
 * Domain Path:       /languages
 * Requires Plugins:  woocommerce
 *
 * WC requires at least: 7.0
 * WC tested up to: 9.4
 *
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

// If this file is called directly, abort.
if ( ( ! defined( 'WPINC' ) ) || ( ! defined( 'ABSPATH' ) ) ) {
	exit;
}

// Test to see if WooCommerce and WooCommerce Services are active (including network activated).
$wc_plugin_path          = trailingslashit( WP_PLUGIN_DIR ) . 'woocommerce/woocommerce.php';

if (
	in_array( $wc_plugin_path, wp_get_active_and_valid_plugins() )
	|| in_array( $wc_plugin_path, wp_get_active_network_plugins() )
) {
	function do_role_based_tax_exclusion( $value ) {
		$roles_to_exclude = get_option( 'role_based_tax_exclusion_selected_roles' );
		foreach ( $roles_to_exclude as $role ) {
			if ( current_user_can( $role ) ) {
				return 'excl';
			}
		}

		return $value;
	}

	add_filter( 'pre_option_woocommerce_tax_display_shop', 'do_role_based_tax_exclusion' );
	add_filter( 'pre_option_woocommerce_tax_display_cart', 'do_role_based_tax_exclusion' );

	add_filter( 'woocommerce_get_sections_tax', 'role_based_tax_exclusion_add_section' );
	function role_based_tax_exclusion_add_section( $sections ) {
		$sections['role_based_tax_exclusion'] = __( 'Role Based Tax Exclusion', 'role-based-tax-exclusion' );

		return $sections;
	}

	add_filter( 'woocommerce_get_settings_tax', 'role_based_tax_exclusion_all_settings', 10, 2 );
	function role_based_tax_exclusion_all_settings( $settings, $current_section ) {
		global $wp_roles;

		/**
		 * Check the current section is what we want
		 **/
		if ( $current_section == 'role_based_tax_exclusion' ) {
			$roles_for_option = [];
			foreach ( $wp_roles->roles as $role_id => $role_data ) {
				$roles_for_option[ $role_id ] = $role_data['name'] ?? $role_id;
			}

			$role_based_tax_exclusion_settings = [];

			$role_based_tax_exclusion_settings[] = [
				'name' => __( 'Role Based Tax Exclusion Settings', 'role-based-tax-exclusion' ),
				'type' => 'title',
				'desc' => __( 'The following options are used to configure role based tax exclusion. Taxes are not shown to the selected roles in shop or cart.',
					'role-based-tax-exclusion' ),
				'id'   => 'role_based_tax_exclusion'
			];

			$role_based_tax_exclusion_settings[] = [
				'name'     => __( "Don't show taxes to these roles", 'role-based-tax-exclusion' ),
				'desc_tip' => __( "Select roles which you don't want to see taxes in shop or cart",
					'role-based-tax-exclusion' ),
				'id'       => 'role_based_tax_exclusion_selected_roles',
				'type'     => 'multiselect',
				'options'  => $roles_for_option,
				'desc'     => __( 'Using Shift and/or Ctrl buttons you can select multiple roles',
					'role-based-tax-exclusion' ),
			];

			$role_based_tax_exclusion_settings[] = [ 'type' => 'sectionend', 'id' => 'role_based_tax_exclusion' ];

			return $role_based_tax_exclusion_settings;
			/**
			 * If not, return the standard settings
			 **/
		} else {
			return $settings;
		}
	}
}
