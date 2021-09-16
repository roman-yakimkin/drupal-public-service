<?php

namespace Drupal\l2\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a TaxCalculation annotation object.
 *
 * @Annotation
 */
class TaxCalculation extends Plugin {

  /**
   * A brief description of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   */
  public $description;

  /**
   * Percent value for calculation of tax.
   *
   * @var int
   */
  public $percent;

  /**
   * Should be outcomes used or not upon tax calculation.
   *
   * @var bool
   */
  public $use_outcomes;
}
