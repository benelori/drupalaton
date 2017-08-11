<?php

namespace Drupal\dao_pattern\Adapter;

use Drupal\Core\Entity\EntityInterface;
use Drupal\reservation_list\Entity\ReservationInterface;
use \Drupal\reservation_list\Model\Reservation as ReservationBusinessObject;

/**
 * Interface AdapterInterface.
 *
 * @package Drupal\dao_pattern\Adapter
 */
interface AdapterInterface {

  /**
   * Transforms the webservice response into entities.
   *
   * @param array $response
   *   The response.
   *
   * @return mixed
   *   An array of entities.
   */
  public function transformWebServiceToBusinessObject(array $response);

  public function transformBusinessObjectToEntity(ReservationBusinessObject $reservation);

  public function transformEntityToBusinessObject(ReservationInterface $reservation);

}
