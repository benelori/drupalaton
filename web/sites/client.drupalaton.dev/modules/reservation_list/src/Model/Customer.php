<?php

namespace Drupal\reservation_list\Model;


class Customer {

  /**
   * @var string
   */
  private $customerId;

  /**
   * @var \Drupal\reservation_list\Model\Passenger
   */
  private $passengerInfo;

  /**
   * Customer constructor.
   *
   * @param string $customerId
   * @param \Drupal\reservation_list\Model\Passenger $passengerInfo
   */
  public function __construct(
    $customerId,
    \Drupal\reservation_list\Model\Passenger $passengerInfo
  ) {
    $this->customerId = $customerId;
    $this->passengerInfo = $passengerInfo;
  }

  /**
   * @return string
   */
  public function getCustomerId() {
    return $this->customerId;
  }

  /**
   * @param string $customerId
   */
  public function setCustomerId($customerId) {
    $this->customerId = $customerId;
  }

  /**
   * @return \Drupal\reservation_list\Model\Passenger
   */
  public function getPassengerInfo() {
    return $this->passengerInfo;
  }

  /**
   * @param \Drupal\reservation_list\Model\Passenger $passengerInfo
   */
  public function setPassengerInfo($passengerInfo) {
    $this->passengerInfo = $passengerInfo;
  }

}
