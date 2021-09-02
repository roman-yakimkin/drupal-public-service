<?php

namespace Drupal\public_service\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of region entities.
 */
class RegionListBuilder extends ConfigEntityListBuilder {

  /**
   * Builds the header row for the entity listing.
   *
   * @return array
   *   A render array structure of header strings.
   */
  public function buildHeader(): array {
    $header['name'] = $this->t('Region');
    $header['id'] = $this->t('ISO code');
    return $header + parent::buildHeader();
  }

  /**
   * Builds a row for an entity in the entity listing.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity for which to build the row.
   *
   * @return array
   *   A render array of the table row for displaying the entity.
   */
  public function buildRow(EntityInterface $entity): array {
    $row['name'] = $entity->getName();
    $row['id'] = $entity->getId();

    return $row + parent::buildRow($entity);
  }

}
