<?php

namespace Drupal\public_service\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Url;

/**
 * Class RegionDeleteForm.
 *
 * Provides a confirm form for deleting the entity.
 */
class RegionDeleteForm extends EntityConfirmFormBase {

  /**
   * {@inheritDoc}
   */
  public function getQuestion(): TranslatableMarkup {
    return $this->t('Are you sure  you want to delete region "%name"', [
      '%name' => $this->entity->getName(),
    ]);
  }

  /**
   * {@inheritDoc}
   */
  public function getConfirmText(): TranslatableMarkup {
    return $this->t('Delete region');
  }

  /**
   * {@inheritDoc}
   */
  public function getCancelUrl(): Url {
    return new Url('entity.region.list');
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();
    $this->messenger()->addMessage($this->t('Region "%name" has been deleted', [
      '%name' => $this->entity->getName(),
    ]));
    $form_state->setRedirectUrl($this->getCancelUrl());
  }

}
