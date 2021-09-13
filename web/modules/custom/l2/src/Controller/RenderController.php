<?php

namespace Drupal\l2\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\l2\Element\NumberTransform;

/**
 * Test controller for rending elements.
 */
class RenderController extends ControllerBase {

  /**
   * Simple controller to output render arrays.
   *
   * @return array
   *   Rendered array as an associative array.
   */
  public function simple(): array {
    $output = [];

    $output[] = [
      '#markup' => $this->t('Examples of render elements'),
    ];

    $output[] = [
      '#type' => 'number_transform',
      '#number' => 65534,
      '#to' => NumberTransform::BIN,
    ];

    $output[] = [
      '#type' => 'number_transform',
      '#number' => 65523,
      '#to' => NumberTransform::OCT,
    ];

    $output[] = [
      '#type' => 'number_transform',
      '#number' => 65434,
      '#to' => NumberTransform::HEX,
    ];

    return $output;
  }

  /**
   * A controller of cached render element.
   *
   * @return array
   *   Rendered array as an associative array.
   */
  public function cached(): array {
    $value = rand(0, 1000);
    return [
      '#markup' => $value,
      '#cache' => [
        'max-age' => 20,
      ],
    ];
  }

}
