<?php

namespace Drupal\routes\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Route schedule entities.
 *
 * @ingroup routes
 */
interface RouteScheduleInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Route schedule name.
   *
   * @return string
   *   Name of the Route schedule.
   */
  public function getName();

  /**
   * Sets the Route schedule name.
   *
   * @param string $name
   *   The Route schedule name.
   *
   * @return \Drupal\routes\Entity\RouteScheduleInterface
   *   The called Route schedule entity.
   */
  public function setName($name);

  /**
   * Gets the Route schedule creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Route schedule.
   */
  public function getCreatedTime();

  /**
   * Sets the Route schedule creation timestamp.
   *
   * @param int $timestamp
   *   The Route schedule creation timestamp.
   *
   * @return \Drupal\routes\Entity\RouteScheduleInterface
   *   The called Route schedule entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Route schedule published status indicator.
   *
   * Unpublished Route schedule are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Route schedule is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Route schedule.
   *
   * @param bool $published
   *   TRUE to set this Route schedule to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\routes\Entity\RouteScheduleInterface
   *   The called Route schedule entity.
   */
  public function setPublished($published);

}
