<?php

namespace Drupal\dao_pattern\Model;

/**
 * Class DaoNullObject.
 *
 * @package Drupal\dao_pattern\Model
 */
class DaoNullObject implements DaoInterface {

  /**
   * {@inheritdoc}
   */
  public function loadReservationsByCustomerId($customerId) {
    throw new \Exception('Please specify the type of DAO');
  }

}
