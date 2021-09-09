<?php

namespace Drupal\public_service;

use Drupal\Core\Form\FormStateInterface;

/**
 * The base interface for public service plugins.
 */
interface PublicServiceInterface {

  /**
   * The type of the public service.
   *
   * @return string
   *   Public service type.
   */
  public function getServiceCategory();

  /**
   * The label of the plugin.
   *
   * @return string
   *   Plugin label.
   */
  public function getLabel();

  /**
   * The region of the plugin.
   *
   * @return string
   *   Plugin region.
   */
  public function getRegion();

  /**
   * Gets plugin property.
   *
   * @param string $property_name
   *   The name of the property.
   *
   * @return mixed
   *   The value of the property.
   */
  public function getConfigProperty($property_name);

  /**
   * Calculates amount of payment for a customer for several .
   *
   * @param int $customer_id
   *   The id of the customer.
   * @param int $year
   *   The year of payment.
   * @param int $month
   *   The month of payment.
   *
   * @return int
   *   The amount of the payment.
   */
  public function amount($customer_id, $year, $month);

  /**
   * Builds the config plugin form.
   *
   * @param array $form
   *   The form associative array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The instance of form_state object.
   *
   * @return array
   *   The configuration form.
   */
  public function buildConfigForm(array &$form, FormStateInterface $form_state);

}
