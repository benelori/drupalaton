<?php

namespace Drupal\reservation_list\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Reservation entities.
 *
 * @ingroup reservation_list
 */
interface ReservationInterface extends  ContentEntityInterface {

  /**
   * Gets the Reservation creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Reservation.
   */
  public function getCreatedTime();

  /**
   * Sets the Reservation creation timestamp.
   *
   * @param int $timestamp
   *   The Reservation creation timestamp.
   *
   * @return \Drupal\reservation_list\Entity\ReservationInterface
   *   The called Reservation entity.
   */
  public function setCreatedTime($timestamp);

}
