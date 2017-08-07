<?php

namespace Drupal\dao_pattern\Model;

/**
 * Interface DaoInterface.
 *
 * @package Drupal\dao_pattern\Model
 */
interface DaoInterface {

  /**
   * Loads the reservations by customer id.
   *
   * @param string $customerId
   *   Customer ID.
   *
   * @return string|array
   *   An array of reservations.
   */
  public function loadReservationsByCustomerId($customerId);

}
