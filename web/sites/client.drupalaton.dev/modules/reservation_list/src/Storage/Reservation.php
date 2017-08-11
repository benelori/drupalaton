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
    $entities = $this->entityManager->getStorage('customer')->loadByProperties(['customer_id' => $customerId]);

    /** @var \Drupal\person\Entity\Customer $customer */
    $customer = reset($entities);

    return $this->loadByProperties(['owner' => $customer->id()]);
  }

}
