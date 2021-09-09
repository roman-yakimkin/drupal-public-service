<?php

namespace Drupal\l2\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormStateInterface;

/**
 * A simple form to demonstrate ajax.
 */
class AjaxForm extends FormBase {

  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'l2_ajax_form';
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['number'] = [
      '#type' => 'textfield',
      '#decription' => $this->t('Input a number'),
    ];

    $form['transformed'] = [
      '#type' => 'markup',
      '#markup' => '<div id="l2-transformed"></div>',
    ];

    $form['action'] = [
      '#type' => 'select',
      '#options' => [
        'bin' => $this->t('dec to bin'),
        'oct' => $this->t('dec to oct'),
        'hex' => $this->t('dec to hex'),
      ],
      '#ajax' => [
        'callback' => [$this, 'doTransformAjax'],
        'event' => 'change',
      ],
    ];

    return $form;
  }

  /**
   * Transforming number with AJAX.
   *
   * @param array $form
   *   The form associative array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state object instance.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse|void
   *   Ajax response commands.
   */
  public function doTransformAjax(array &$form, FormStateInterface $form_state) {
    $number = (int) $form_state->getValue('number');
    $actions = [
      'bin' => decbin($number),
      'oct' => decoct($number),
      'hex' => dechex($number),
    ];
    foreach ($actions as $action => $operation) {
      if ($form_state->getValue('action') == $action) {
        $response = new AjaxResponse();
        $response->addCommand(new HtmlCommand('#l2-transformed', $operation));
        return $response;
      }
    }
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
