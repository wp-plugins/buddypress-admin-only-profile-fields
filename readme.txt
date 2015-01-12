=== BuddyPress Admin Only Profile Fields ===
Contributors: A5hleyRich
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=95AQB5DP83XAU
Tags: buddypress, admin, hidden, profile, field, visibility
Requires at least: 4.1
Tested up to: 4.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily set the visibility of BuddyPress profile fields to hidden, allowing only admin users to edit and view them.

== Description ==

Easily set the visibility of BuddyPress profile fields to hidden, allowing only admin users to edit and view them.

== Installation ==

1. Upload `bp-admin-only-profile-fields` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= How do I change who can view and edit the hidden field? =

Add the following filter to your theme’s functions.php file, substituting *manage_options* with the desired capability:
`add_filter( 'bp_admin_only_profile_fields_cap', 'edit_others_posts' ); // Editors`

== Screenshots ==

1. Edit field BuddyPress screen.

== Changelog ==

= 1.0 =

* Initial release.

== Upgrade Notice ==

= 1.0 =

* Initial release.