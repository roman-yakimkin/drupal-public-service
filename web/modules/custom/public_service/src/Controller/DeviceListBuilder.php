<?php

namespace Drupal\public_service\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\public_service\DeviceInterface;

/**
 * Provides a list controller for device entity.
 */
class DeviceListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the devices list.
   */
  public function buildHeader() {
    $header['type_name'] = $this->t('Device type');
    $header['serial_number'] = $this->t('Serial №');
    $header['valency'] = $this->t('Valency');
    $header['calibration_date'] = $this->t('Calibration date');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(DeviceInterface $entity) {
    $row['type_name'] = $entity->getDeviceTypeName();
    $row['serial_number'] = $entity->serial_number->value;
    $row['valency'] = $entity->getDeviceTypeValency();
    try {
      $calibration_date_raw = new \DateTime($entity->calibration_date->value);
      $calibration_date = $calibration_date_raw->format('d.m.Y');
    }
    catch (\Exception $exception) {
      $calibration_date = '';
    }
    $row['calibration_date'] = $calibration_date;

    return $row + parent::buildRow($entity);
  }

}
