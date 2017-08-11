<?php

namespace Drupal\person\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Passenger entities.
 *
 * @ingroup person
 */
interface PassengerInterface extends  ContentEntityInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Passenger name.
   *
   * @return string
   *   Name of the Passenger.
   */
  public function getName();

  /**
   * Sets the Passenger name.
   *
   * @param string $name
   *   The Passenger name.
   *
   * @return \Drupal\person\Entity\PassengerInterface
   *   The called Passenger entity.
   */
  public function setName($name);

  /**
   * Gets the Passenger creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Passenger.
   */
  public function getCreatedTime();

  /**
   * Sets the Passenger creation timestamp.
   *
   * @param int $timestamp
   *   The Passenger creation timestamp.
   *
   * @return \Drupal\person\Entity\PassengerInterface
   *   The called Passenger entity.
   */
  public function setCreatedTime($timestamp);

}
