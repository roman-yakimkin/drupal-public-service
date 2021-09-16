<?php

namespace Drupal\l2\Plugin\TaxCalculation;

use Drupal\l2\TaxCalculationBase;

/**
 * Provides a plugin for tax calculation on 6%.
 *
 * @TaxCalculation(
 *   id="tax_calculation_6_percent",
 *   description = @Translation("Tax 6% of income"),
 *   percent = 6
 * )
 */
class TaxSixPercent extends TaxCalculationBase {

  /**
   * {@inheritDoc}
   */
  public function calcTax(int $income_value = 0, int $outcome_value = 0): float {
    return $income_value * $this->percent() / 100;
  }

}
