<?php

namespace Drupal\public_service\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Class Category.
 *
 * Defines the public service category entity.
 *
 * @ConfigEntityType(
 *   id = "category",
 *   label = @Translation("Public service category"),
 *   label_collection = @Translation("Public service categories"),
 *   label_singular = @Translation("category"),
 *   label_plural = @Translation("categories"),
 *   admin_permission = "administer permissions",
 *   config_prefix = "category",
 *   handlers = {
 *     "list_builder" = "Drupal\public_service\Controller\CategoryListBuilder",
 *     "form" = {
 *       "default" = "Drupal\public_service\Form\CategoryForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     }
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name"
 *   },
 *   links = {
 *     "delete-form" = "/admin/public-service/category/manage/{category}/delete",
 *     "edit-form" = "/admin/public-service/category/manage/{category}",
 *     "collection" = "/admin/public-service/category"
 *   },
 *   config_export = {
 *     "id",
 *     "uuid",
 *     "name"
 *   }
 * )
 */
class Category extends ConfigEntityBase {

  /**
   * The category id.
   *
   * @var string
   */
  protected $id;

  /**
   * The category uuid.
   *
   * @var string
   */
  protected $uuid;

  /**
   * The category name.
   *
   * @var string
   */
  protected $name = '';

  /**
   * Get category id.
   *
   * @return string
   *   Region id.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get category UUID.
   *
   * @return string
   *   Region UUID.
   */
  public function getUuid(): string {
    return $this->uuid;
  }

  /**
   * Get category name.
   *
   * @return string
   *   Category name.
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Set category name.
   *
   * @param string $name
   *   New category name.
   *
   * @return $this
   *   An instance of entity.
   */
  public function setName(string $name): Category {
    $this->name = $name;
    return $this;
  }

}
