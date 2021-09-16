<?php

namespace Drupal\l2\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form to demonstrate calculation plugins.
 */
class PluginForm extends FormBase {

  /**
   * An instance of tax calculation plugin manager.
   *
   * @var \Drupal\l2\TaxCalculationManager
   */
  protected $taxCalculationManager;

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->taxCalculationManager = $container->get('plugin.manager.tax_calculator');
    return $instance;
  }

  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'l2_plugin_form';
  }

  /**
   * Get array of taxes.
   *
   * @return array
   *   Associative array with tax ids and descriptions.
   */
  protected function getTaxes() {
    $options = [];
    foreach ($this->taxCalculationManager->getDefinitions() as $definition) {
      $options[$definition['id']] = $definition['description'];
    }
    return $options;
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['income'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Income'),
    ];

    $form['outcome'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Outcome'),
    ];

    $form['tax_calculation'] = [
      '#type' => 'select',
      '#title' => $this->t('Tax calculation'),
      '#options' => $this->getTaxes(),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Calculate taxes'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $plugin_id = $form_state->getValue('tax_calculation');
    $income = $form_state->getValue('income') ?? 0;
    $outcome = $form_state->getValue('outcome') ?? 0;
    $result = $this
      ->taxCalculationManager->createInstance($plugin_id)
      ->calcTax($income, $outcome);
    $this->messenger()->addMessage($this->t('Tax value is @result',
      ['@result' => $result])
    );
  }

}
