<?php

namespace Drupal\dao_pattern\Model;

/**
 * Class DaoFactory.
 *
 * @package Drupal\dao_pattern\Model
 */
class DaoFactory {

  /**
   * Returns a DAO instance.
   *
   * @param string $name
   *   The machine name of the instance.
   *
   * @return \Drupal\dao_pattern\Model\DaoInterface
   *   The DAO instance.
   */
  public function getInstance($name) {
    switch ($name) {
      case 'webservice':
        return \Drupal::service('webservice_client.reservations');

      default:
        return new DaoNullObject();
    }
  }

}
