<?php

namespace Drupal\public_service\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * The category add and edit form.
 */
class CategoryForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $category = $this->entity;

    $form['id'] = [
      '#type' => 'machine_name',
      '#title' => $this->t('Category ID'),
      '#default_value' => $category->id(),
      '#size' => 30,
      '#required' => TRUE,
      '#maxlength' => 64,
      '#machine_name' => [
        'exists' => ['\Drupal\public_service\Entity\Category', 'load'],
      ],
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Category name'),
      '#default_value' => $category->getName(),
      '#required' => TRUE,
      '#size' => 30,
      '#maxlength' => 64,
      '#description' => $this->t('The name of the category. Example: "Electricity supply", "Gas supply".')
    ];

    return parent::form($form, $form_state, $category);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $category = $this->entity;
    $category->setName(trim($category->getName()));
    $status = $category->save();

    $edit_link = $category->toLink($this->t('Edit'), 'edit-form')->toString();
    if ($status == SAVED_UPDATED) {
      $this->messenger()->addStatus($this->t('Category %name has been updated.', [
        '%name' => $category->getName(),
      ]));
      $this->logger('user')->notice('Category %name has been updated.', [
        '%name' => $category->getName(),
        'link' => $edit_link,
      ]);
    }
    else {
      $this->messenger()->addStatus($this->t('Category %name has been added.', [
        '%name' => $category->getName(),
      ]));
      $this->logger('user')->notice('Category %name has been added.', [
        '%name' => $category->getName(),
        'link' => $edit_link,
      ]);
    }
    $form_state->setRedirect('entity.category.collection');
  }

}
