<?php

namespace Drupal\public_service\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the region entity.
 *
 * @ConfigEntityType(
 *   id = "region",
 *   label = @Translation("Region"),
 *   admin_permission = "administer regions",
 *   handlers = {
 *     "access" = "Drupal\public_service\RegionAccessController",
 *     "list_builder" = "Drupal\public_service\Controller\RegionListBuilder",
 *     "form" = {
 *       "add" = "Drupal\public_service\Form\RegionAddForm",
 *       "edit" = "Drupal\public_service\Form\RegionEditForm",
 *       "delete" = "Drupal\public_service\Form\RegionDeleteForm"
 *     }
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name"
 *   },
 *   links = {
 *     "edit-form" = "/admin/public-service/region/manage/{region}",
 *     "delete-form" = "/admin/public-service/region/{region}/delete"
 *   },
 *   config_export = {
 *     "id",
 *     "uuid",
 *     "name",
 *   }
 * )
 */
class Region extends ConfigEntityBase {

  /**
   * The region id (ISO code).
   *
   * @var string
   */
  protected $id;

  /**
   * The region UUID.
   *
   * @var string
   */
  protected $uuid;

  /**
   * The region name.
   *
   * @var string
   */
  protected $name = '';

  /**
   * Get region id.
   *
   * @return string
   *   Region id.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get region UUID.
   *
   * @return string
   *   Region UUID.
   */
  public function getUuid(): string {
    return $this->uuid;
  }

  /**
   * Get region name.
   *
   * @return string
   *   The name of the region.
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Set region name.
   *
   * @param string $name
   *   The name of the region.
   */
  public function setName(string $name) {
    $this->name = $name;
  }

}
