=== Plugin Name ===
Contributors: Pedro Candeias
Donate link: https://sigarra.up.pt/up/pt/vld_entidades_geral.entidade_pagina?pct_id=892200
Tags: vouchers, custom post type
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple plugin to create a Custom Post Type, add a QR Code to the Custom Post Type articles and allow for download of a PDF.

== Description ==

The plugin creates a Custom Post Type (vouchers). For every post a QR Code using Google Charts is generated, download and converted to JPG (the original is PNG).
For the Custom Post Type a custom dropdown with 3 states is create as a custom field for every post. The states are "active", "used" and inactive.
This custom field is used as a validation mechanism. It dosen't do much more than change the content of the custom field.
WP-MPDF is integrated on the plugin to allow a PDF to be generated and downloaded.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `uportovouchers.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

== Changelog ==

= 1.0.1 =
* QR Codes are now downloaded and placed as a featured image

= 1.0.0 =
* Release
