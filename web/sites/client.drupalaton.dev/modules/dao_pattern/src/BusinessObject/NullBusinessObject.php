<?php

namespace Drupal\dao_pattern\BusinessObject;

/**
 * Class NullBusinessObject.
 *
 * @package Drupal\dao_pattern\BusinessObject
 */
class NullBusinessObject implements BusinessObjectInterface {

  /**
   * {@inheritdoc}
   */
  public function getEntities() {
    throw new \Exception('Please specify a business object type');
  }

}
