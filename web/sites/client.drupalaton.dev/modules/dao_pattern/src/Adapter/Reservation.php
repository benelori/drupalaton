<?php

namespace Drupal\dao_pattern\Adapter;

use Drupal\person\Entity\Passenger;
use \Drupal\reservation_list\Entity\Reservation as ReservationBusinessObject;

/**
 * Class Reservation.
 *
 * @package Drupal\dao_pattern\Adapter
 */
class Reservation implements AdapterInterface {

  /**
   * {@inheritdoc}
   */
  public function transformWebServiceToEntity(array $response) {
    $passenger = Passenger::create([
      'first_name' => $response['owner']['first_name'],
      'last_name' => $response['owner']['last_name'],
      'age' => $response['owner']['age'],
    ]);
    $entity = ReservationBusinessObject::create([
      'pnr' => $response['pnr'],
    ]);
    // TODO implement the transformation.
    return $response;
  }

}
