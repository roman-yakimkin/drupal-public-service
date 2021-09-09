<?php

namespace Drupal\l2\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;

/**
 * A simple form class.
 */
class SimpleForm extends FormBase {

  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'l2_simple_form';
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['number'] = [
      '#type' => 'textfield',
      '#decription' => $this->t('Input a positive number here'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Get square root'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $number = $form_state->getValue('number');
    $conditions = [
      function ($arg): string {
        return !is_numeric($arg) ? 'Argument must be numeric' : '';
      },
      function ($arg): string {
        return $arg < 0 ? 'Argument must be positive' : '';
      },
    ];
    foreach ($conditions as $condition) {
      $result = $condition($number);
      if ($result != '') {
        $form_state->setErrorByName('number', $this->t($result));
        break;
      }
    }
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $root = sqrt($form_state->getValue('number'));
    $this->messenger()->addMessage($this->t('The square root of @number is @root', [
      '@number' => $form_state->getValue('number'),
      '@root' => $root,
    ]));
  }

}
