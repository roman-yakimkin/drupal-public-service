<?php

namespace Drupal\public_service\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Class RegionAddForm.
 *
 * Provides the add form for the Region entity.
 */
class RegionAddForm extends RegionFormBase {

  /**
   * Return the actions provided by the form.
   *
   * @param array $form
   *   An associative array containing structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   An object containing the current state of the form.
   *
   * @return array
   *   An array of supported actions.
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['submit']['#value'] = $this->t('Create region');
    return $actions;
  }

}