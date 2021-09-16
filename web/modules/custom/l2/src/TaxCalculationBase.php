<?php

namespace Drupal\l2;

use Drupal\Core\Plugin\PluginBase;

/**
 * The base plugin for tax calculation plugins.
 */
abstract class TaxCalculationBase extends PluginBase implements TaxCalculationInterface {

  /**
   * {@inheritDoc}
   */
  public function description(): string {
    return $this->pluginDefinition['description'];
  }

  /**
   * Gets the percent value.
   *
   * @return int
   *   Percent value.
   */
  protected function percent(): int {
    return $this->pluginDefinition['percent'];
  }

  /**
   * {@inheritDoc}
   */
  abstract public function calcTax(int $income_value = 0, int $outcome_value = 0): float;

}
