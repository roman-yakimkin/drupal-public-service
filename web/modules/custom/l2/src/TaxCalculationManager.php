<?php

namespace Drupal\l2;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\l2\Annotation\TaxCalculation;

/**
 * Plugin manager for tax calculation plugins.
 */
class TaxCalculationManager extends DefaultPluginManager {

  /**
   * {@inheritDoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    $subdir = 'Plugin/TaxCalculation';
    $plugin_interface = 'Drupal\l2\TaxCalculationInterface';
    $annotation_name = TaxCalculation::class;
    parent::__construct($subdir, $namespaces, $module_handler, $plugin_interface, $annotation_name);
    $this->alterInfo('tax_calculation_info');
    $this->setCacheBackend($cache_backend, 'tax_calculation_info');
  }

}
