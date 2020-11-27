## Overview

This is a starter pack for getting started with Silverstripe testing. This covers [unit testing](https://docs.silverstripe.org/en/4/developer_guides/testing/) and [behat](https://github.com/silverstripe/silverstripe-behat-extension)

## Prerequisites ##

This installation is known to work in bare-metal Linux and a Linux VM under VirtualBox. It is tested on Ubuntu with Apache web server. You will need a full GUI Linux install (with Chrome or Chromium browser).

You will need [composer](https://getcomposer.org/), [sspak](https://github.com/silverstripe/sspak) and [Chromedriver](https://chromedriver.chromium.org/). Make sure to get the version of Chromedriver that matches your version of Chrome/Chromium and unzip it into `/usr/local/bin`

## Installation ##

Rename the file `.env.example` in root folder as `.env` and edit it as per your development environment. Run `composer install` which will install the base system. The database dump is in the file `site.sspak` is needs to be loaded by doing `sspak load site.sspak`. Adjust your folder permissions as needed: Silverstripe requires `public/assets/` to be writable by the web server.

Finally do a `vendor/bin/sake dev/build flush=all`. The site is now ready. Configure your webserver to point at the folder and it should be accessible through a web browser.

You can login to the CMS by going to /admin url with the username/password as admin/admin. Make sure the website is browsable using an IP address or local domain (e.g. http://127.0.0.1 or http://testsite.test) before proceeding further.

## Running unit tests ##

A simple helper for adding two numbers is located in `app\src\CalculationHelper.php` and the corresponding test file is in `app\tests\unit\AddTwoNumbersTest.php`. To run the test do a `vendor/bin/phpunit` (use sudo if you're getting permission errors). The configuration file is `phpunit.xml` in the root folder.

## Running behat tests ##

If the Silverstripe installation is setup with a domain name like testsite.test, edit `/etc/hosts` file and add an entry like below:

`127.0.0.1     testsite.test`

A simple web page that uses the aforementioned helper helper to allow for input of two numbers and perfom the addition is available in the /add-numbers url (also linked in the top navigation). Start by typing in `chromedriver` in a terminal window on your Linux GUI instance. Then on a new terminal, type in `SS_BASE_URL="http://testsite.test" php ./vendor/bin/behat --config=behat-local.yml`

Behat tests are located on `app\tests\behat` and the configuration file is `behat-local.yml` in the root folder.

## Quickstart ##

If you have followed along with a quick start guide and have a Silverstripe setup on an Ubuntu 16 VM, see the file [QUICKSTART.md](QUICKSTART.md)