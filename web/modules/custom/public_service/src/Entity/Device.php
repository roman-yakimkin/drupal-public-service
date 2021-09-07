<?php

namespace Drupal\public_service\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\public_service\DeviceInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Device entity.
 *
 * @ContentEntityType(
 *   id = "device",
 *   label = @Translation("Metering device"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\public_service\Controller\DeviceListBuilder",
 *     "form" = {
 *       "default" = "Drupal\public_service\Form\DeviceForm",
 *       "delete" = "Drupal\public_service\Form\DeviceDeleteForm",
 *     },
 *     "access" = "Drupal\public_service\DeviceAccessControlHandler",
 *   },
 *   list_cache_contexts = { "user" },
 *   base_table = "device",
 *   admin_permission = "administer device entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/device/{device}",
 *     "edit-form" = "/device/{device}/edit",
 *     "delete-form" = "/device/{device}/delete",
 *     "collection" = "/device/list"
 *   },
 *   field_ui_base_route = "public_service.device_settings",
 * )
 */
class Device extends ContentEntityBase implements DeviceInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   *
   * When a new entity instance is added, set the user_id entity reference to
   * the current user as the creator of the instance.
   */
  public static function preCreate(EntityStorageInterface $storage, array &$values) {
    parent::preCreate($storage, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   *
   * Define the field properties here.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('Device ID'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('Entity UUID'))
      ->setReadOnly(TRUE);

    $fields['device_type'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Device type'))
      ->setDescription(t('Type of metering device.'))
      ->setSetting('target_type', 'taxonomy_term')
      ->setSetting('handler', 'default')
      ->setSetting('handler_settings', [
        'target_bundles' => [
          'metering_devices' => 'metering_devices',
        ],
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => '-5',
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'match_limit' => 10,
          'size' => 60,
          'placeholder' => '',
        ],
        'weight' => -20,
      ]);

    $fields['serial_number'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Serial №'))
      ->setDescription(t('Serial number of device'))
      ->setSettings([
        'max_length' => 60,
        'text_processing' => 0,
      ])
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -10,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -6,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['calibration_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Calibration date'))
      ->setDescription(t('The date of calibration of the device'))
      ->setSettings([
        'datetime_type' => 'date',
      ])
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'datetime_custom',
        'weight' => 0,
        'settings' => [
          'date_format' => 'd.m.Y',
        ],
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
        'weight' => 0,
      ]);

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of Device entity.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getDeviceType() {
    return $this->device_type->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getDeviceTypeName() {
    return $this->device_type->entity->name->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getDeviceTypeValency() {
    return $this->device_type->entity->field_valency->value;
  }

}
