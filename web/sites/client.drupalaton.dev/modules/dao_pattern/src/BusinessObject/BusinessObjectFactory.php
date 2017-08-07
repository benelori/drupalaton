<?php

namespace Drupal\dao_pattern\BusinessObject;

/**
 * Class BusinessObjectFactory.
 *
 * @package Drupal\dao_pattern\BusinessObject
 */
class BusinessObjectFactory {

  /**
   * Returns a Business Object instance.
   *
   * @param string $name
   *   The machine name of the instance.
   *
   * @return \Drupal\dao_pattern\BusinessObject\BusinessObjectInterface
   *   Business object instance.
   */
  public function getInstance($name) {
    switch ($name) {
      case 'reservations':
        return \Drupal::service('dao_pattern.business_object.reservations');

      default:
        return new NullBusinessObject();
    }
  }

}
