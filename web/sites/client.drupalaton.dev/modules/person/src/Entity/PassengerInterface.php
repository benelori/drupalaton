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
interface PassengerInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

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

  /**
   * Returns the Passenger published status indicator.
   *
   * Unpublished Passenger are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Passenger is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Passenger.
   *
   * @param bool $published
   *   TRUE to set this Passenger to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\person\Entity\PassengerInterface
   *   The called Passenger entity.
   */
  public function setPublished($published);

}
