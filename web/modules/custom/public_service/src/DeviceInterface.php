<?php

namespace Drupal\public_service;

use Drupal\Core\Entity\EntityInterface;

/**
 * The interface for device entity.
 */
interface DeviceInterface extends EntityInterface {

  /**
   * Gets device type entity.
   *
   * @return \Drupal\Core\Entity\FieldableEntityInterface
   *   A device type entity.
   */
  public function getDeviceType();

  /**
   * Get device type name.
   *
   * @return string
   *   The name of the device type.
   */
  public function getDeviceTypeName();

  /**
   * Get device type valency.
   *
   * @return int
   *   The valency of the device type.
   */
  public function getDeviceTypeValency();

}
