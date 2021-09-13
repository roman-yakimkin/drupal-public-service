<?php

namespace Drupal\l2\Element;

use Drupal\Core\Render\Element\RenderElement;

/**
 * An example of render element that transforms numbers.
 *
 * @RenderElement("number_transform")
 */
class NumberTransform extends RenderElement {

  const BIN = 2;
  const OCT = 8;
  const HEX = 16;

  /**
   * {@inheritDoc}
   */
  public function getInfo(): array {
    return [
      '#theme' => 'l2_number_transform',
      '#pre_render' => [
        [static::class, 'preRenderTransform'],
      ],
      '#number' => 0,
      '#to' => 0,
    ];
  }

  /**
   * Transform number.
   *
   * @param array $element
   *   The passed in element.
   *
   * @return array
   *   The output element.
   */
  public function preRenderTransform(array $element): array {
    $number = $element['#number'];
    $output = [
      self::BIN => decbin($number),
      self::OCT => decoct($number),
      self::HEX => dechex($number),
    ];
    $element['#transformed'] = $output[$element['#to']] ?? 0;

    return $element;
  }

}
