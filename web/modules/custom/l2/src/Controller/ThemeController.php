<?php

namespace Drupal\l2\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller to provide theme operations.
 */
class ThemeController extends ControllerBase {

  /**
   * The entity query instance.
   *
   * @var \Drupal\Core\Entity\Query\QueryInterface
   */
  protected $entityQuery;

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->entityQuery = \Drupal::entityQuery('node');
    return $instance;
  }

  /**
   * A simple method.
   *
   * @return array
   *   The rendered array.
   */
  public function simple(): array {
    $query = $this->entityQuery
      ->condition('type', 'test_content');
    $nids = $query->execute();
    $nodes = Node::loadMultiple($nids);

    $vars = [];
    foreach ($nodes as $node) {
      $vars[] = [
        'nid' => $node->id(),
        'title' => $node->getTitle(),
        'a' => $node->field_number_a->value,
        'b' => $node->field_number_b->value,
        'c' => $node->field_number_c->value,
      ];
    }
    return [
      '#theme' => 'l2_table',
      '#caption' => $this->t('Theme experiences'),
      '#rows' => $vars,
    ];
  }

}
