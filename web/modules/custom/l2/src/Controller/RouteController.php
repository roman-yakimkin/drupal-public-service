<?php

namespace Drupal\l2\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * The controller for routing.
 */
class RouteController extends ControllerBase {

  /**
   * The controller method for routing controller.
   *
   * @param int $arg_1
   *   The first argument.
   * @param int $arg_2
   *   The second argument.
   *
   * @return array
   *   The associative array with results.
   */
  public function index(int $arg_1 = 0, int $arg_2 = 0): array {
    return [
      '#markup' => $this->t('The sum of :arg_1 and :arg_2 is :sum', [
        ':arg_1' => $arg_1,
        ':arg_2' => $arg_2,
        ':sum' => ($arg_1 + $arg_2),
      ]),
    ];
  }

}
