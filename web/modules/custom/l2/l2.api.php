<?php

/**
 * @file
 */

use Drupal\node\NodeInterface;

/**
 * Actions after a node of test_content type has been updated.
 *
 * @param \Drupal\node\NodeInterface $node
 *   The updated node.
 */
function hook_test_content_updated(NodeInterface $node) {
  \Drupal::messenger()->addMessage('Node "@title" has been updated', [
    '@title' => $node->getTitle(),
  ]);
}
