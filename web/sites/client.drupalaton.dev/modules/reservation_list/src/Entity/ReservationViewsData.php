<?php

namespace Drupal\reservation_list\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Reservation entities.
 */
class ReservationViewsData extends EntityViewsData {

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
