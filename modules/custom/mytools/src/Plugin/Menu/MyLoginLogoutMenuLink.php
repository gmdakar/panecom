<?php

namespace Drupal\mytools\Plugin\Menu;

use Drupal\user\Plugin\Menu\LoginLogoutMenuLink;

class MyLoginLogoutMenuLink extends LoginLogoutMenuLink {

  public function getTitle() {
    if (!$this->currentUser->isAuthenticated()) {
      return $this->t('Member area');
    }
  }

}