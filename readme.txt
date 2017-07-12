=== Property Drive ===
Contributors: jaythegeek, 4pm.ie, property_drive
Tags: properties, property, real estate, estate agents, importer
Requires at least: 4.0
Tested up to: 4.8
Stable tag: 5.4.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Properties management system for Wordpress. Import properties from Property Drive, search, display, mapping.

== Description ==

Property Drive can add properties to virtually any Wordpress website in just a few clicks. Built with theme compatibility in mind from the start, Property Drive gives you the freedom to use your favourite theme and control the styling of your property pages from within the plugin. An advanced & easy to use options area provides you with an intuitive & modern user experience unchallenged by any other property or real estate plugin out there.

If you have a Property Drive account, you can hook up to the API and sync your properties straight from your listing portals or property management system straight to your Wordpress website.
[Find out more here.](http://propertydrive.io/)

**Features**

* Create & Manage Properties
* Search Properties
* Properties Grid / List Pages
* Column Options for Display (2, 3, 4)
* 4 Styles of Property Box (more to come)
* 3 Styles of Search Shortcode (more to come)
* Add Agency Details for Property Sidebar
* Property Grid / Featured Listing Grid Shortcode
* Single Property Page Template
* Customisable settings for Single Property
* Google Maps per Property
* Brochure / Floor Plan Handling
* Property Analytics
* Disable Property as a Taxonomy - Importer Only
* Disable Styling for compatibility with other property plugin / theme styles
* Import / Sync Properties from Property Drive (API see below for more info)
* Ajax Admin Area / Property Admin - Inline Editing / Updating
* Currency Support - Euro / British Pounds / Dollars

**Themes - Compatibility Tested with Property Drive Importer**

* Avada
* Jupiter
* BeTheme
* WP Residence
* Javo Home
* Realty
* Javo Home / Lava Real Estate Manager

New features and functionality are being added to Property Drive daily, if there are things you think should be included, send an email to [info@propertydrive.io](mailto:info@propertydrive.io), we are open to suggestions. Equally if you have any issues with theme compatibility please head to the Wordpress [support forum to get some help](https://wordpress.org/support/plugin/property-drive) :)

**Getting a 404 error page? Visit your permalink settings and set them to Post Name, that'll do the trick!**

= Connecting to Property Drive API =
If you wish to use this plugin to connect to your Property Drive account, please enter your API Key into the Importer Settings and turn Auto Sync on.

Property Drive is a portal that enables you to connect your Estate Agency software to the cloud and sync your properties in real time to a host of 3rd party property listing platforms around the globe. The importer functionality included in this plugin, **does not send any information**, save for your unique API Key, to the Property Drive servers or any 3rd party services. It is merely an import functionality that pulls an XML feed directly from your Property Drive account, this is then read by the plugin, sorted, compared with current listings and then stored, updated or removed, depending on the settings you choose. No private information is disclosed or stored that has not been provided by yourself & explicitly made public from within your Property Drive account.

If you have any questions relating to the use of data, the information, sent or received, please direct your queries to [info@propertydrive.io](mailto:info@propertydrive.io)

To view information relating to the Property Drive API please visit [http://api2.4pm.ie/](http://api2.4pm.ie/) - incidentally this is also the server used to fetch the Propery Drive feed.

If you discover that your properties are not importing at the selected, scheduled time, please ensure you have a Cron job correctly running on the wp-cron.php - Ideally for low traffic websites, this should be set to run between every 5 and 30 minutes.

== Screenshots ==

== Installation ==
* Upload the Property Drive zip file through the Wordpress Plugin screen and install
* Otherwise please upload the uncompressed Property Drive folder to the wp-content/plugins directory
* Activate the plugin from the Plugin page within WP
* Fill out your Agency details and API Key for Property Drive on the plugin options page 

== Frequently Asked Questions ==

= How do I perform a backend fetch =
Please add your API Key to the plugin settings, turn Auto Sync on. 
Visit the plugins page and deactivate Property Drive, then simply reactivate the plugin and a backend fetch will be performed.


== Changelog ==
= 5.4.7 =
* Fixed pagination

= 5.4.6 =
* Added Template 3
* Auto Draft imported properties
* email auto draft
* email link with approval from frontend
* email preview link
* updated templates to bootstrap
* fixed styling issues template 1 / search templates


= 5.4.5 =
* Fixed style issues

= 5.4.4 =
* Property Map Shortcode
* Fix CSS styling
* Template 2 re-written to Bootsrap 4
* Sticky nav jumping fixed
* No sticky nav on mobile


= 5.4.3 =
* Style Fixes

= 5.4.2 =
* Files Update

= 5.4.1 =
* Files Update

= 5.4.0 =
* Added residential / commercial of the week shortcodes
* New Search Type with Image Background
* Fixed Page Styilng
* Corrected Enqueue of files
* Fixed grid layout for shortcodes
* Added AJAX Update of Irish Counties / Areas on Search Type 3
* Added related properties to single page style 1
* Added share single property to multiple social platforms
* Added featured properties - importer and normal
* Single Property Page Inline Colours + Styles
* User Dashboard Inline Colours + Styles
* Full Screen Search with Image / Video Slider
* Added Optional Plugin Analytical Tracking - Phones Home Once a Week


= 5.3.9 =
* Fixes to Property Card Style 3

= 5.3.8 =
* New Single Property Page layout
* New Property Box Style

= 5.3.7 =
* Added duplicates checker after import process

= 5.3.6 =
* Pro Added property searcher login / register form
* Pro Added seaved searches
* Pro Added Request Property Viewing
* Pro Added Favourites
* Pro Added API call back to check Purchase License for Pro version
* Pro Email function on request viewing
* Pro Email function for search alert
* Pro Added email alert frequency
* Pro Added Registration page
* Pro Added Login Page
* Pro Added User Dashboard Area
* Pro Added frontend management of Favourites / Search Alerts / Viewings

= 5.3.5 =
* Update to pro version detection as add on

= 5.3.4 =
* Updated Single Property Slider to jQuery LightSlider + LightGallery
* Fixed Mobile responsiveness of sliders
* CSS Breakpoints added
* PriceTerm CSS Fix
* Single Property title position changed inline with slider

= 5.3.3 =
* Bug fix

= 5.3.2 =
* Updated comparison feature with flagged status from Property Drive API
= 5.3.1 =
* JSON Cache Fix for Lava Real Estate Importer

= 5.3.0 =
* Added Javo Home / Lava Real Estate Importer compatibility

= 5.2.9 =
* Fixed rewrite rule

= 5.2.6 =
* Readme updates
= 5.2.5 =
* Adding in Analytics for property views
* Added Search Alert Capapbilities
* Added Property Search Role
* Block Dashboard for property searcher
* Hide admin bar property searcher
* Search Alert as CPT
* Saving Search via Ajax from Property result page
* Began property searcher front end profile page for search alerts
* Extended pro version detection

= 5.2.4 =
* Fixed Brochure not displaying on single property

= 5.2.3 =
* Minor Bug Fixes

= 5.2.2 =
* Build out the Custom Post Type Admin Page
* Add new meta fields
* Ajax updating of new post meta
* Added new Gallery Tab to Property for attaching / removing media
* URL Rewrite for Properties listing page from property to properties
* Single Property page CSS fixes
* Single Property Slider fix
* Single Property dynamic distance from top
* Added County / Area as Taxonomy
* Added Pro version detection

= 5.2.1 =
* Updated default settings for first time install
* Fixed duplication in Importer function
* Updated comparison module for importer
* Added notices for Admin area
* Removed Custom CSS / Replacing with better version in next update

= 5.1.6 =
* Added Agent Details to side bar from importer feed / settings
* CSS Admin Page Fix
= 5.1.5 =
* Admin Area Meta Boxes on Properties
* Ajax Property Details Updating
* Fixed Importer Duplication issue

= 5.1.4 = 
* Importer - Updating WP Residence Compatibility to v 1.20.2
* Importer - Fixed Properties not displaying on WP Residence map
* Importer - Full compatibility with WP Residence v1.20.2
* Importer - Comparison WP Residence v1.20.2

= 5.1.3 =
* Added Property Card Style 3 as Available 

= 5.1.2 =
* BeTheme Compatibility CSS Fixes

= 5.1.1 =
* FA Icons Fix

= 5.1.0 =
* Added WP Residence Compatibility
= 5.0.2 =
* Bug Fixes

= 5.0.1 =
* Ajax Admin Panel
* Backend filters for front end visuals
* Bug fixes

= 4.5 =
* Extend Mapping
* Fix Importer status updates

= 4.2 =
* Add custom templates override
* Add custom shortcodes include
* Split settings pages and settings for ease of use
* Added CSS Controls / Options to Admin Area
* Added Layout options
* Added Agency Details
* Fixed Log file creation / check
* Hide bedrooms in header if 0
* If there is a brochure attached hide area / display PDF link
* Fixed scripts / styles enqueue
* Added inline styles
* Added custom css section
* Updated prefix on classes / functions
* Added Image Gallery with full screen responsive slider

= 4.0 =
* Bug Fixes and file restructuring
* Add Property Search
* Add Property Map
* Add Property Listing
* Add Single Property View

= 3.0 =
* Add property management to 4pm Properties Manager

= 2.0 =
* Add property drive connection

= 1.0 =
* Initial Release
* Daft Importer version - No property drive connection, dependant on Lava Real Estate Manager