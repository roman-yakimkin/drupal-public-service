<?php

namespace Drupal\l2\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * An example of block that displays current time.
 *
 * @Block(
 *   id = "l2_current_time_block",
 *   admin_label = @Translation("L2 Current Time")
 * )
 */
class CurrentTimeBlock extends BlockBase {

  /**
   * {@inheritDoc}
   */
  public function build(): array {
    return [
      '#markup' => $this->t('Current time is <span class="l2-current-time">...</span>'),
      '#attached' => [
        'library' => ['l2/l2.current_time'],
      ],
    ];
  }

}
