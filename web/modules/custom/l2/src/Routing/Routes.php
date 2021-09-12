<?php

namespace Drupal\l2\Routing;

use Drupal\Component\Plugin\Exception\PluginException;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Menu\MenuLinkManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Route;

/**
 * The class to declare routes dynamically.
 */
class Routes implements ContainerInjectionInterface {

  use StringTranslationTrait;

  /**
   * Menu link manager service.
   *
   * @var \Drupal\Core\Menu\MenuLinkManagerInterface
   */
  protected $menuLinkManager;

  /**
   * The constructor of the object.
   *
   * @param \Drupal\Core\Menu\MenuLinkManagerInterface $menu_link_manager
   *   The instance of the menu link manager service.
   */
  public function __construct(MenuLinkManagerInterface $menu_link_manager) {
    $this->menuLinkManager = $menu_link_manager;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.menu.link')
    );
  }

  /**
   * Declaration of routes dynamically.
   *
   * @return array
   *   The routes array.
   */
  public function routesList(): array {
    $routes = [];

    $routes['d2.routing.simple'] = new Route(
      '/routing-simple',
      [
        '_title' => 'Simple routing title',
        '_controller' => '\Drupal\l2\Controller\RouteController::index',
      ],
      [
        '_permission' => 'access content',
      ],
      []
    );
    $routes['d2.routing.one_arg'] = new Route(
      '/routing-one-arg/{arg_1}',
      [
        '_title' => 'One-arg routing title',
        '_controller' => '\Drupal\l2\Controller\RouteController::index',
        'arg_1' => 10,
      ],
      [
        '_permission' => 'access content',
      ],
      []
    );
    $routes['d2.routing.two_args'] = new Route(
      '/routing-two-args/{arg_1}/{arg_2}', [
        '_title' => 'Two-args routing title',
        '_controller' => '\Drupal\l2\Controller\RouteController::index',
        'arg_1' => 10,
        'arg_2' => 20,
      ],
      [
        '_permission' => 'access content',
      ],
      []
    );

    $menu_items = [
      'd2.menu.routing.simple' => [
        'title' => $this->t('Simple routing menu'),
        'route_name' => 'd2.routing.simple',
        'menu_name' => 'main',
        'weight' => 30,
      ],
      'd2.menu.routing.simple.one_arg' => [
        'title' => $this->t('Routing menu (one arg)'),
        'route_name' => 'd2.routing.one_arg',
        'menu_name' => 'main',
        'parent' => 'd2.menu.routing.simple',
        'weight' => 20,
      ],
      'd2.menu.routing.simple.two_args' => [
        'title' => $this->t('Routing menu (two args)'),
        'route_name' => 'd2.routing.two_args',
        'menu_name' => 'main',
        'parent' => 'd2.menu.routing.simple',
        'weight' => 30,
      ],
    ];

    foreach ($menu_items as $item_id => $item_definition) {
      try {
        $this->menuLinkManager->addDefinition($item_id, $item_definition);
      }
      catch (PluginException $e) {
      }
    }

    return $routes;
  }

}