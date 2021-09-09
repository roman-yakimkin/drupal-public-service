<?php

namespace Drupal\public_service;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\PluginBase;

/**
 * The base class for public service plugins.
 */
abstract class PublicServiceBase extends PluginBase implements PublicServiceInterface {

  /**
   * {@inheritdoc}
   */
  public function getServiceCategory() {
    return $this->pluginDefinition['serviceCategory'];
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return $this->pluginDefinition['label'];
  }

  /**
   * {@inheritdoc}
   */
  public function getRegion() {
    return $this->pluginDefinition['region'];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfigProperty($property_name) {
    return 1000;
  }

  /**
   * {@inheritdoc}
   */
  abstract public function amount($customer_id, $year, $month);

  /**
   * {@inheritdoc}
   */
  abstract public function buildConfigForm(array &$form, FormStateInterface $form_state);

}
