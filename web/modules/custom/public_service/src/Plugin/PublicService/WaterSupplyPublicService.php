<?php

namespace Drupal\public_service\Plugin\PublicService;

use Drupal\Core\Form\FormStateInterface;
use Drupal\public_service\PublicServiceBase;

/**
 * A plugin for water supply.
 *
 * @Plugin (
 *   id = "public_service_water_supply",
 *   label = @Translation("Water supply by indications.")
 *   serviceCategory = "water"
 *   deriver = "Drupal\public_service\Plugin\Derivative\PublicServiceDeriver"
 * )
 */
class WaterSupplyPublicService extends PublicServiceBase {

  /**
   * {@inheritDoc}
   */
  public function amount($customer_id, $year, $month) {
  }

  /**
   * {@inheritDoc}
   */
  public function buildConfigForm(array &$form, FormStateInterface $form_state) {
    $form['water_price'] = [
      '#type' => 'textfield',
      '#description' => $this->t('Default payment for one cubic meter of water'),
      '#size' => 20,
      '#default_value' => $this->getConfigProperty('water_price'),
    ];

    return $form;

  }

}
