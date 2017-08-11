<?php

namespace Drupal\routes\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Route schedule entities.
 */
class RouteScheduleViewsData extends EntityViewsData {

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