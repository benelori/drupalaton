<?php

namespace Drupal\drupalaton_reservations\Storage;

use Drupal\Core\Entity\EntityTypeManagerInterface;

class Reservation {

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Reservation constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   */
  public function __construct(
    EntityTypeManagerInterface $entityTypeManager
  ) {
    $this->entityTypeManager = $entityTypeManager;
  }


  public function loadReservationsByCustomerId($customer_id) {
    $query = $this->entityTypeManager->getStorage('node')->getQuery();
    $query->condition('field_customer_id', $customer_id);

    $results = $query->execute();
    $entities = $this->entityTypeManager->getStorage('node')->loadMultiple($results);

    return $entities;
  }

  public function loadReservationsByCustomerIdAndPnr($customer_id, $pnr) {
    $query = $this->entityTypeManager->getStorage('node')->getQuery();
    $query->condition('field_pnr', $pnr);
    $query->condition('field_customer_id', $customer_id);

    $results = $query->execute();
    $entities = $this->entityTypeManager->getStorage('node')->loadMultiple($results);

    return reset($entities);
  }

}