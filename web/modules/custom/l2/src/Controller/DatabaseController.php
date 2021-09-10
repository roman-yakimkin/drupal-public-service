<?php

namespace Drupal\l2\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller class for demonstration database queries.
 */
class DatabaseController extends ControllerBase {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $db;

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
    $instance->db = $container->get('database');
    $instance->entityQuery = \Drupal::entityQuery('node');
    return $instance;
  }

  /**
   * An example of static queries.
   */
  public function staticQuery() {
    $query = $this->db->query('
    SELECT * 
    from node_field_data 
    WHERE type = :type
    ORDER BY title
    ', [':type' => 'test_content']);

    $result = [
      '#type' => 'table',
      '#caption' => $this->t('Sorted by title records'),
      '#header' => [
        $this->t('NID'),
        $this->t('Title'),
      ],
    ];

    while (($record = $query->fetchAssoc()) !== FALSE) {
      $row = [
        $record['nid'],
        $record['title'],
      ];
      $result['#rows'][] = $row;
    }

    return $result;
  }

  /**
   * An example of dynamic queries.
   */
  public function dynamicQuery() {
    $query = $this->db->select('node_field_data', 'nfd')
      ->fields('nfd', ['nid', 'title'])
      ->condition('type', 'test_content')
      ->orderBy('title', 'DESC')
      ->execute();

    $result = [
      '#type' => 'table',
      '#caption' => $this->t('Sorted by title desc records'),
      '#header' => [
        $this->t('NID'),
        $this->t('Title'),
      ],
    ];

    while (($record = $query->fetchAssoc()) !== FALSE) {
      $row = [
        $record['nid'],
        $record['title'],
      ];
      $result['#rows'][] = $row;
    }

    return $result;
  }

  /**
   * An example of entity query.
   */
  public function entityQuery() {
    $query = $this->entityQuery
      ->condition('type', 'test_content')
      ->condition('status', 1)
      ->condition('nid', 120, '>')
      ->sort('title', 'ASC');
    $nids = $query->execute();
    $nodes = Node::loadMultiple($nids);

    $result = [
      '#type' => 'table',
      '#caption' => $this->t('Sorted by title asc records'),
      '#header' => [
        $this->t('NID'),
        $this->t('Title'),
      ],
    ];
    foreach ($nodes as $node) {
      $row = [
        $node->id(),
        $node->getTitle(),
      ];
      $result['#rows'][] = $row;
    };

    return $result;
  }

  /**
   * An example of insert/update query.
   */
  public function insertUpdateQuery() {
    $query = $this->entityQuery
      ->condition('type', 'test_content');
    $nids = $query->execute();
    $nodes = Node::loadMultiple($nids);
    $result = [
      '#type' => 'table',
      '#caption' => $this->t('Nodes with values'),
      '#header' => [
        $this->t('NID'),
        $this->t('Title'),
        $this->t('A'),
        $this->t('B'),
        $this->t('C'),
      ],
    ];
    foreach ($nodes as $node) {
      $node->set('field_number_a', rand(-99, 99));
      $node->set('field_number_b', rand(-99, 99));
      $node->set('field_number_c', rand(-99, 99));
      $node->save();

      $result['#rows'][] = [
        $node->id(),
        $node->getTitle(),
        $node->field_number_a->value,
        $node->field_number_b->value,
        $node->field_number_c->value,
      ];
    }

    return $result;
  }

}
