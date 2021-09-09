<?php

namespace Drupal\public_service\Plugin\PublicService;

use Drupal\Core\Form\FormStateInterface;
use Drupal\public_service\PublicServiceBase;

/**
 * A plugin for apartment renting.
 *
 * @Plugin (
 *   id = "public_service_apartment_payment",
 *   label = @Translation("Rent appartment.")
 *   serviceCategory = "rent"
 *   deriver = "Drupal\public_service\Plugin\Derivative\PublicServiceDeriver"
 * )
 */
class ApartmentPaymentPublicService extends PublicServiceBase {

  /**
   * {@inheritDoc}
   */
  public function amount($customer_id, $year, $month) {
  }

  /**
   * {@inheritDoc}
   */
  public function buildConfigForm(array &$form, FormStateInterface $form_state) {
    $form['rent_cost_default'] = [
      '#type' => 'textfield',
      '#description' => $this->t('Default payment for apartment per month'),
      '#size' => 20,
      '#default_value' => $this->getConfigProperty('rent_cost_default'),
    ];

    return $form;
  }

}
