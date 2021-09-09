<?php

namespace Drupal\public_service\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller class for editing public service settings.
 */
class PublicServiceSettingsController extends ControllerBase {

  /**
   * Default settings for plugins.
   *
   * @return array
   *   The rendering array.
   */
  public function default() {
    return [
      '#markup' => $this->t('Default settings'),
    ];
  }

  /**
   * Regional settings for plugins (with plugin derivatives).
   *
   * @return array
   *   The rendering array.
   */
  public function regional() {
    return [
      '#markup' => $this->t('Regional settings'),
    ];
  }

}
