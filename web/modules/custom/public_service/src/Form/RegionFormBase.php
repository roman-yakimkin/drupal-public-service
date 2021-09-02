<?php

namespace Drupal\public_service\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RegionFormBase.
 *
 * The base form for work with the Region entity.
 */
class RegionFormBase extends EntityForm {

  /**
   * An entity query factory for the region entity type.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $entityStorage;

  /**
   * A factory method for RegionFormBase.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The container interface.
   *
   * @return \Drupal\public_service\Form\RegionFormBase
   *   An instance of form.
   */
  public static function create(ContainerInterface $container) {
    $form = new static();
    $form->entityStorage = $container->get('entity_type.manager')->getStorage('region');
    $form->setMessenger($container->get('messenger'));
    return $form;
  }

  /**
   * Build a form for the Region config entity.
   *
   * @param array $form
   *   An associative array containing structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   An object containing the current state of the form.
   *
   * @return array
   *   An associative array containing the region add/edit form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $region = $this->entity;

    $form = parent::buildForm($form, $form_state);

    $form['id'] = [
      '#type' => 'machine_name',
      '#title' => $this->t('ID (ISO-code)'),
      '#default_value' => $region->id(),
      '#machine_name' => [
        'exists' => [$this, 'exists'],
        'replace_pattern' => '([^A-Z0-9\-]+)',
        'error' => 'The machine-readable name must be unique, and can only contain uppercase letters, numbers, and dashes.',
      ],
      '#disabled' => !$region->isNew(),
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#maxlength' => 128,
      '#default_value' => $region->getName(),
    ];

    return $form;
  }

  /**
   * Checks for an existing region.
   *
   * @param string $entity_id
   *   The entity ID.
   * @param array $element
   *   The form element.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function exists(string $entity_id, array $element, FormStateInterface $form_state) {
    $query = $this->entityStorage->getQuery();
    $result = $query
      ->condition('id', $element['#field_prefix'] . $entity_id)
      ->execute();
    return (bool) $result;
  }

  /**
   * Overrides Drupal\Core\Entity\EntityFormController::actions().
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   An object containing the current state of the form.
   *
   * @return array
   *   An array of supported actions of the form.
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['submit']['#value'] = $this->t('Save');
    return $actions;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * Overrides Drupal\Core\Entity\EntityFormController::save().
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   An object containing the current state of the form.
   *
   * @return int
   *   The result of operation.
   */
  public function save(array $form, FormStateInterface $form_state) {
    $region = $this->getEntity();
    $status = $region->save();
    $url = $region->toUrl();
    $edit_link = Link::fromTextAndUrl($this->t('Edit'), $url)->toString();
    if ($status == SAVED_UPDATED) {
      $this->messenger()->addMessage($this->t('Region "%name" has been updated.', [
        '%name' => $region->getName(),
      ]));
      $this->logger('contact')->notice('Region "%name" has been updated.', [
        '%name' => $region->getName(),
        'link' => $edit_link,
      ]);
    }
    else {
      $this->messenger()->addMessage($this->t('Region "%name" has been added.', [
        '%name' => $region->getName(),
      ]));
      $this->logger('contact')->notice('Region "%name" has been added.', [
        '%name' => $region->getName(),
        'link' => $edit_link,
      ]);
    }
  }

}