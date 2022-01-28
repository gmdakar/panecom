<?php
/**
 * @file
 * Install, update and uninstall functions for the panecom install profile.
 */

/**
 * Implements hook_cron().
 *
 * Queues news feeds for updates once their refresh interval has elapsed.
 */
function panecom_cron() {
  \Drupal::logger('panecom')->notice("PROFILE_ panecom hook_cron..");
  \Drupal::logger('panecom')->notice("PROFILE_install_tasks: install mydefaultcontent start");
  \Drupal::service('module_installer')->install(['default_content', 'mydefaultcontent' ], TRUE);
  \Drupal::logger('panecom')->notice("PROFILE_install_tasks: install mydefaultcontent end");
}