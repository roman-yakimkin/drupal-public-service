<?php

namespace Drupal\public_service;

/**
 * Interface for work with plugin config data.
 */
interface PluginConfigServiceInterface {

  /**
   * Gets a regional property value.
   *
   * @param string $plugin_id
   *   The id of the plugin.
   * @param string $region_id
   *   The id of the region.
   * @param string $property_name
   *   The name of the property.
   *
   * @return mixed
   *   The value of the property.
   */
  public function getRegionalProperty($plugin_id, $region_id, $property_name);

  /**
   * Sets a regional property value.
   *
   * @param string $plugin_id
   *   The id of the plugin.
   * @param string $region_id
   *   The id of the region.
   * @param string $property_name
   *   The name of the property.
   * @param mixed $property_value
   *   The value of the property.
   */
  public function setRegionalProperty($plugin_id, $region_id, $property_name, $property_value);

  /**
   * Gets all regional properties of public service.
   *
   * @param string $plugin_id
   *   The id of the plugin.
   * @param string $region_id
   *   The id of the region.
   *
   * @return mixed
   *   The associative array of regional properties.
   */
  public function getAllRegionalProperties($plugin_id, $region_id);

  /**
   * Sets all regional properties for public service.
   *
   * @param string $plugin_id
   *   The id of the plugin.
   * @param string $region_id
   *   The id of the region.
   * @param array $properties
   *   The associative array with properties.
   */
  public function setAllRegionalProperties($plugin_id, $region_id, $properties);

  /**
   * Gets properties of al the regions.
   *
   * @param string $plugin_id
   *   The id of the plugin.
   *
   * @return array
   *   The associative array with properties keyed by region id.
   */
  public function getAllProperties($plugin_id);
}
