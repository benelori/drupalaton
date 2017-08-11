<?php

namespace Drupal\person\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Passenger entities.
 */
class PassengerViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
