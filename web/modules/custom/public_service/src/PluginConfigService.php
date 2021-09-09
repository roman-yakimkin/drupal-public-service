<?php

namespace Drupal\public_service;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Database\Connection;

/**
 * The class for work with plugin config properties.
 */
class PluginConfigService implements PluginConfigServiceInterface {

  /**
   * The database connection object.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * The constructor of the object.
   *
   * @param \Drupal\Core\Database\Connection $connection
   *   The instance of the database connection.
   */
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  /**
   * {@inheritdoc}
   */
  public function getAllRegionalProperties($plugin_id, $region_id) {
    $properties = $this->connection->query('
        SELECT data 
        FROM {public_service_plugin_data}
        WHERE plugin_id = :plugin_id AND :region_id = :region_id
    ', [':plugin_id' => $plugin_id, ':region_id' => $region_id])->fetchAll();
    return Json::decode($properties);
  }

  /**
   * {@inheritdoc}
   */
  public function getRegionalProperty($plugin_id, $region_id, $property_name) {
    $properties = $this->getAllRegionalProperties($plugin_id, $region_id);
    return $properties[$property_name];
  }

  /**
   * {@inheritdoc}
   */
  public function setRegionalProperty($plugin_id, $region_id, $property_name, $property_value) {
    $properties = $this->getAllRegionalProperties($plugin_id, $region_id);
    $properties[$property_name] = $property_value;
    $this->setAllRegionalProperties($plugin_id, $region_id, $properties);
  }

  /**
   * {@inheritdoc}
   */
  public function setAllRegionalProperties($plugin_id, $region_id, array $properties) {
    $encoded_properties = Json::encode($properties);
    $this->connection->merge('public_service_plugin_data')
      ->keys([
        'plugin_id' => $plugin_id,
        'region_id' => $region_id,
      ])
      ->insertFields([
        'plugin_id' => $plugin_id,
        'region_id' => $region_id,
        'data' => $encoded_properties,
      ])
      ->updateFields([
        'data' => $encoded_properties,
      ])
      ->execute();
  }

  /**
   * {@inheritdoc}
   */
  public function getAllProperties($plugin_id) {
    $properties = $this->connection->query('
        SELECT region_id, data 
        FROM {public_service_plugin_data}
        WHERE plugin_id = :plugin_id
    ', ['plugin_id' => $plugin_id])->fetchAll();

    return $properties;
  }

}
