<?php

namespace Drupal\l2;

/**
 * An interface for all tax calculation plugin types.
 */
interface TaxCalculationInterface {

  /**
   * Provide a description of calculation.
   *
   * @return string
   *   A string description of calculation.
   */
  public function description(): string;

  /**
   * Provide a tax amount.
   *
   * @param int $income_value
   *   Income value.
   * @param int $outcome_value
   *   Outcome value.
   *
   * @return float
   *   Amount of tax.
   */
  public function calcTax(int $income_value = 0, int $outcome_value = 0): float;
}