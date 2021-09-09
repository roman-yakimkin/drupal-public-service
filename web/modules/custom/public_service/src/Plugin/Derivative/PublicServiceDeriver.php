<?php

namespace Drupal\public_service\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
use Drupal\public_service\PluginConfigServiceInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Deriver to generate many public service plugins for different regions.
 */
class PublicServiceDeriver extends DeriverBase implements ContainerDeriverInterface {

  /**
   * The instance of the plugin config service.
   *
   * @var \Drupal\public_service\PluginConfigServiceInterface
   */
  protected $pluginConfigService;

  /**
   * The constructor of the instance.
   *
   * @param \Drupal\public_service\PluginConfigServiceInterface $plugin_config_service
   *   The instance of the plugin config service.
   */
  public function __construct(PluginConfigServiceInterface $plugin_config_service) {
    $this->pluginConfigService = $plugin_config_service;
  }

  /**
   * Creates an instance of deriver.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The sercvice container instance.
   * @param string $base_plugin_id
   *   The base plugin id.
   *
   * @return \Drupal\public_service\Plugin\Derivative\PublicServiceDeriver
   *   The instance of service deriver.
   */
  public static function create(ContainerInterface $container, $base_plugin_id) {
    return new static(
      $container->get('public_service.config_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
//    $properties = $this->pluginConfigService->getAllProperties()
  }

}
