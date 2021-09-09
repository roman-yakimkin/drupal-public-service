<?php

namespace Drupal\l2\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\l2\Form\SimpleForm;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for output forms.
 */
class SimpleFormController extends ControllerBase {

  /**
   * The renderer service.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * Create an instance of controller.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The service container.
   *
   * @return \Drupal\l2\Controller\SimpleFormController
   *   The instance of controller.
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->renderer = $container->get('renderer');
    return $instance;
  }

  /**
   * Outputs simple form via form builder.
   *
   * @return array
   *   The rendered array.
   */
  public function outputSimpleForm() {
    return $this->formBuilder()->getForm(SimpleForm::class);
  }

}
