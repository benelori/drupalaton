<?php

namespace Drupal\dao_pattern\Adapter;

/**
 * Class Reservation.
 *
 * @package Drupal\dao_pattern\Adapter
 */
class Reservation implements AdapterInterface {

  /**
   * {@inheritdoc}
   */
  public function transformWebServiceToEntity(array $response) {
    // TODO implement the transformation.
    return $response;
  }

}
