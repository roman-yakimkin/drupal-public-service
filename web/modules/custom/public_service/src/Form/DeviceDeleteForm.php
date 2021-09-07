<?php

namespace Drupal\public_service\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a form for deleting a device entity.
 */
class DeviceDeleteForm extends ContentEntityConfirmFormBase {

  /**
   * {@inheritDoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete device %device_type № %serial_number?', [
      '%device_type' => $this->entity->getDeviceTypeName(),
      '%serial_number' => $this->entity->serial_number->value,
    ]);
  }

  /**
   * {@inheritDoc}
   */
  public function getCancelUrl() {
    return new Url('entity.device.collection');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $device = $this->getEntity();
    $device->delete();

    $this->logger('public_service')->notice('The device %device_type, № %serial_number has been deleted.', [
      '%device_type' => $device->getDeviceTypeName(),
      '%serial_number' => $device->serial_number->value,
    ]);
    $form_state->setRedirect('entity.device.collection');
  }

}
