<?php

namespace Drupal\l2\EventSubscriber;

use Drupal\l2\Event\TestContentSaveEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * A simple event subscriber class.
 */
class UpcaseEventSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritDoc}
   */
  public static function getSubscribedEvents() {
    return [
      TestContentSaveEvent::EVENT_NAME => 'onTestContentSaved',
    ];
  }

  /**
   * Subscribe to onTestContentSaved event.
   *
   * @param \Drupal\l2\Event\TestContentSaveEvent $event
   *   The instance of the event.
   */
  public function onTestContentSaved(TestContentSaveEvent $event) {
    $node = $event->getNode();
    $node->setTitle(strtoupper($node->getTitle()));
  }

}
