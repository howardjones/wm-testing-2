# PHP Network Weathermap 1.0.0 (dev)

## Current Status (2017-11-03)

I decided it would be useful to add this section to the top of the README, while things are moving around a lot. Here
is what is working, and what is being worked on:

### General goals

By the time 1.0.0 is done, near enough everything will have had some kind of rewrite work, even it's just
tidying up the naming. A lot of it will have significantly more change, including stuff
that was originally written before 0.98 a few years ago, and never used. The aim of all of that
is to break the code up between the UI, the map-drawing, and data-collecting parts, and make
it a generally more pleasant place for someone to work, in the hopes of getting some additional contributors.

To make it easier to deal with multiple contributors, __automated testing__ is pretty essential. You
should be able to quickly tell if your changes have broken anything. Lots of code has been pulled into
smaller testable classes to make that easier (and tests written!). Previously, most of the stuff that
appeared on a web page was not at all easy to test, and that's improving now. The editor has tests for
the first time, for example, and a lot of the database manipulation that used to be buried in the cacti
plugin does, too.

### Current Status/Usability

* __Core__ - passing all tests (but one database-related). All code modified to use namespaces, one class per file, most PSR-2 standards.

* __CLI__ - should be working OK

* __Editor__ - Partly (75%) implemented class/template-based version of editor (same UI) currently named `editor16.php`. Old `editor.php` is probably broken, since its files have been moved around. BUT PARTS THAT DON'T YET WORK CAN MANGLE YOUR MAP! (e.g. tidy recently deleted links) 

* __Cacti 0.8 Plugin__ - broken UI, broken poller. Code has all been moved and not even run once yet.

* __Cacti 1.0 Plugin__ - broken UI, broken poller. Code has all been moved and not even run once yet.


### Work currently in progress:

* ~~Move to namespaces - PHP Namespaces help keep our code out of your code. Especially important for something that sits inside other software~~

* ~~Remove dependency on PEAR - CLI uses a Composer module now for options~~

* Move to React for Cacti UI, with only JSON/API type stuff in the PHP code

* Update Editor to use same UI classes as Cacti (input validation, one method per 'command', testability)

* Update Editor Data Picker to use same UI classes as Cacti (input validation, one method per 'command', testability)

* Break down 'monster methods' into simpler ones. Identify groups within the larger classes for refactoring (e.g. plugin-related stuff in Map)

* Move as much generic database-related stuff out of the Cacti plugin and into MapManager - MapManager is testable, whereas 
the Cacti plugin is not (easily).  

* Make an abstraction layer for things like `read_config_option` in the UI, so it doesn't depend on Cacti being underneath. When someone wants to make a plugin/integration for a new
application, it'll be a lot 'thinner' this way, too.

## Normal README

This is PHP Network Weathermap, version 1.0.0 by Howard Jones (howie@thingy.com)

See the docs sub-directory for full HTML documentation, FAQ and example config.

See CHANGES for the most recent updates, listed by version.

See COPYING for the license under which php-weathermap is released.

There is much more information, tutorials and updates available at:
    http://www.network-weathermap.com/

## Project Admin 

For news and updates, see http://www.network-weathermap.com/
(also twitter @netweathermap and Facebook)

For issue tracking and bug reports use the Github issue tracker: https://github.com/howardjones/network-weathermap/issues  

I'm trying managing feature requests with FeatHub. You can add features here, and vote for them too:

[![Feature Requests](http://feathub.com/howardjones/network-weathermap?format=svg)](http://feathub.com/howardjones/network-weathermap)

## Using the dev version

This git repo deliberately DOES NOT contain third party libraries (and if it does now, it won't soon).

Dependencies are managed with bower. If you have never used it before, you will need to:

* Install nodejs (and npm - which should come with it)
* Install bower: `npm install -g bower`
* Install [composer](https://getcomposer.org/)
* Go to the weathermap checkout directory
* `bower install` should install all the necessary javascript dependencies to the vendor/ directory.
* `composer update` will grab the PHP dependencies for both the runtime and testing environments
The release process collects up these files and puts them in the zip file, via the packing.list file(s). You only need to do this if you are working with the current development code.

## Credits

PHP Weathermap contains components from other software developers:

overlib.js is part of Overlib 4.21, copyright Erik Bosrup 1998-2004. All rights reserved.
See http://www.bosrup.com/web/overlib/?License

The Bitstream Vera Open Source fonts (Vera*.ttf) are copyright Bitstream, Inc.
See http://www.bitstream.com/font_rendering/products/dev_fonts/vera.html

The manual uses the Kube CSS Framework - http://imperavi.com/kube/
and ParaType's PT Sans font: http://www.fontsquirrel.com/fonts/PT-Sans

jquery-latest.min.js is the jQuery javascript library - written by John Resig and collaborators.
http://docs.jquery.com/Licensing

Some of the icons used in the editor, and also supplied in the images/ folder are
from the excellent Fam Fam Fam Silk icon collection by Mark James: 
   http://www.famfamfam.com/lab/icons/silk/
These are released under the Creative Commons Attribution 2.5 License
   http://creativecommons.org/licenses/by/2.5/

Other libraries in the vendor/ directory are provided by third-parties. `composer info` will
provide licensing information per component.
