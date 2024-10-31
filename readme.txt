=== Role Based Tax Exclusion ===
Contributors: orwokki
Tags: woocommerce, tax, roles
Stable tag: 1.0.11
Requires at least: 5.8
Tested up to: 6.7
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Plugin for defining which user roles see prices in shop and cart pages of WooCommerce without taxes

== Description ==

With this plugin administrator can define which user roles see prices in  store and cart pages of WooCommerce without taxes. At checkout page taxes are shown to these roles.

== Installation ==

This section describes how to install the plugin and get it working. To use this plugin you have to have WooCommerce and WooCommerce Tax and Shipping plugins installed.

1. Upload the plugin files to the `/wp-content/plugins/role-based-tax-exclusion` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Navigate to WooCommerce -> Settings -> Tax -> Role Based Tax Exclusion
   1. NOTE: You should have prices entered to products without tax and also setting `Prices entered with tax` set to `No, I will enter prices exclusive of tax`
   1. NOTE 2: You should also have `Display prices in the shop` and `Display prices during cart and checkout` set to `Including tax`
   1. NOTE 3: If you exclude tax from Administrator role settings mentioned in NOTE 2 above are showing value `Excluding tax`
1. Select one or multiple roles to be excluded from seeing prices with taxes from the multiple selection
1. Click `Save changes` button to save your selection
1. Now users with the roles you selected won't be seeing prices with taxes in Shop and Cart pages

== Screenshots ==
Role Based Tax Exclusion Settings
1. Settings page for plugin under WooCommerce taxes

== Changelog ==

= 1.0.11
* Tested to work with WordPress 6.7 and WooCommerce 9.4

= 1.0.10 =
* Tested to work with WordPress 6.6 and WooCommerce 9.1
* Removed support for PHP 7.4, only PHP 8.x version are supported in the future

= 1.0.9 =
* Tested to work with WordPress 6.5 and WooCommerce 8.7
* Added new Requires Plugins header with value woocommerce

= 1.0.8 =
* Tested to work with WordPress 6.4 and WooCommerce 8.3
* Finnish translation file locale corrected

= 1.0.7 =
* Fix to readme.txt

= 1.0.6 =
* Tested to work with WordPress 6.3 and WooCommerce 8.0

= 1.0.5 =
* Tested to work with WooCommerce 7.8
* Added some more installation instructions to get the plugin working smoothly

= 1.0.4 =
* Tested to work with WordPress 6.2 and WooCommerce 7.5

= 1.0.3 =
* Testing to work with WooCommerce 7.4

= 1.0.2 =
* Bugfix to showing menu in common installation scenarios
* Naming translation files correctly

= 1.0.1 =
* Bugfix to activating the plugin in certain environments

= 1.0 =
* Initial production version

== Upgrade notice ==

= 1.0 =
Initial version
