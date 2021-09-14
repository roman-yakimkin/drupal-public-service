<?php

namespace Drupal\l2\Event;

use Drupal\Component\EventDispatcher\Event;
use Drupal\node\NodeInterface;

/**
 * An event upon saving a node of type "test_content".
 */
class TestContentSaveEvent extends Event {

  const EVENT_NAME = 'custom_events_test_content_save';

  /**
   * The instance of node.
   *
   * @var \Drupal\node\NodeInterface
   */
  protected $node;

  /**
   * Constructs the object.
   *
   * @param \Drupal\node\NodeInterface $node
   *   The instance of the node.
   */
  public function __construct(NodeInterface $node) {
    $this->node = $node;
  }

  /**
   * Gets the node instance.
   *
   * @return \Drupal\node\NodeInterface
   *   The instance of the node.
   */
  public function getNode() {
    return $this->node;
  }

}
