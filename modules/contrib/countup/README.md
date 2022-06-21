CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Maintainers


INTRODUCTION
------------

The CountUp module integrates the CountUp.js library with CKeditor, allowing
to have nice and configurable animations on pages.

 * For a full description of the module visit:
   https://www.drupal.org/project/countup

 * To submit bug reports and feature suggestions, or to track changes visit:
   https://www.drupal.org/project/issues/countup


REQUIREMENTS
------------

This module requires the following outside of Drupal core:

 * CountUp.js library - https://inorganik.github.io/countUp.js/

This library should be installed in the Drupal "libraries" and named `countup.js`.
The main script should be located here: `libraries/countup.js/dist/countUp.umd.js`.

USING COMPOSER
--------------

There are several ways to install the module and its dependencies.

1.  You can use composer to install those libraries, by copying the
    repository definitions specified in the `composer.json` file, then
    you simply require the drupal module:

    ```shell
    composer require drupal/countup
    ```

2.  If you use "Asset Packagist", you can directly require the libraries:

    ```shell
    composer require npm-asset/countup.js:^2.0
    ```

3.  If you use the "Composer Merge Plugin", you can include the following
    file: `composer.libraries.json`. Or if you use Asset Packagist, you can
    include this one: `composer.asset-packagist.json`.

INSTALLATION
------------

 * Install the CountUp module as you would normally install a contributed Drupal
   module. Visit https://www.drupal.org/node/1897420 for further information.


CONFIGURATION
-------------

1. Navigate to Administration > Extend and enable the module.
2. Navigate to Administration > Configuration > Content Authoring > Text
   formats and editor > [format text to edit] to configure
3. Drag the Countup icon, looks like the number "13", into the Active
   toolbar into the Tools group.
4. Enable the countup filter in the filter list. It should run after the
   filters which limit the allowed HTML tags, or you need to add all
   the data attributes that may be used.
5. If you use a filter that limit the allowed HTMLtags and attributes, you
   need to add either `<span class data-*>` or the exact list od data
   attributes:
   ```
   <span class class data-start-val data-end data-duration data-decimal-places
   data-use-easing data-smart-easing-threshold data-smart-easing-amount
   data-use-grouping data-separator data-decimal data-prefix data-suffix>
   ```
6. Save configuration.
7. Now when using the CKEditor, select the countup icon and edit the
   animations. Enter the Start number, End number, Duration of animation,
   and prefix or suffix. Insert Animation.


MAINTAINERS
-----------

 * Fabien Leroux 'B-Prod' https://www.drupal.org/u/b-prod
 * Lucas Gratien 'Fonski' https://www.drupal.org/u/fonski
 * Boyan Kostov (Icon) : https://www.iconfinder.com/wH1spEr
 * Inorganik (Countup) : https://github.com/inorganik/countUp.js

Supporting organization:

 * Aïon Solutions - https://www.drupal.org/a%C3%AFon-solutions
