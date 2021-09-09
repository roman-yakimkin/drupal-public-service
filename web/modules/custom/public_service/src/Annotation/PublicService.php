<?php

namespace Drupal\public_service\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * The annotation for public service with payment by indications.
 */
class PublicService extends Plugin {

  /**
   * The service category.
   *
   * @var string
   */
  public $serviceCategory;

  /**
   * The plugin label.
   *
   * @var string
   */
  public $label;

  /**
   * The region of service.
   *
   * @var string
   */
  public $region;
}
