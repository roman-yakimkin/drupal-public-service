<?php

namespace Drupal\l2\Plugin\TaxCalculation;

use Drupal\l2\TaxCalculationBase;

/**
 * Provides a plugin for tax calculation on 6%.
 *
 * @TaxCalculation(
 *   id="tax_calculation_15_percent",
 *   description = @Translation("Tax 15% of difference between income and outcome"),
 *   percent = 15
 * )
 */
class TaxFifteenPercent extends TaxCalculationBase {

  /**
   * {@inheritDoc}
   */
  public function calcTax(int $income_value = 0, int $outcome_value = 0): float {
    $tax = ($income_value - $outcome_value) * $this->percent() / 100;
    return max($tax, 0);
  }

}
