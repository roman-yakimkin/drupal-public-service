<?php

namespace Drupal\l2\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * An example of Route Subscriber.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritDoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    foreach (['d2.simple_form', 'd2.simple_form_controller', 'd2.ajax_form'] as $route_name) {
      if ($route = $collection->get($route_name)) {
        $title = $route->getDefault('_title');
        $route->setDefault('_title', strtoupper($title));
      }
    }

  }

}
