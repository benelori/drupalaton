<?php

namespace Drupal\reservation_list\Storage;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\dao_pattern\Model\DaoInterface;

class Reservation extends SqlContentEntityStorage implements DaoInterface, ContentEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function loadReservationsByCustomerId($customerId) {
    return [];
  }

}
