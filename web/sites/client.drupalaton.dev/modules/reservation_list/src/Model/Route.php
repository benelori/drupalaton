<?php

namespace Drupal\reservation_list\Model;


class Route {

  /**
   * @var \Drupal\reservation_list\Model\Location
   */
  private $departureLocation;

  /**
   * @var \Drupal\reservation_list\Model\Location
   */
  private $arrivalLocation;

  /**
   * @var string
   */
  private $departureTime;

  /**
   * @var string
   */
  private $arrivalTime;

  /**
   * Route constructor.
   *
   * @param \Drupal\reservation_list\Model\Location $departureLocation
   * @param \Drupal\reservation_list\Model\Location $arrivalLocation
   * @param string $departureTime
   * @param string $arrivalTime
   */
  public function __construct(
    \Drupal\reservation_list\Model\Location $departureLocation,
    \Drupal\reservation_list\Model\Location $arrivalLocation,
    $departureTime,
    $arrivalTime
  ) {
    $this->departureLocation = $departureLocation;
    $this->arrivalLocation = $arrivalLocation;
    $this->departureTime = $departureTime;
    $this->arrivalTime = $arrivalTime;
  }

  /**
   * @return \Drupal\reservation_list\Model\Location
   */
  public function getDepartureLocation() {
    return $this->departureLocation;
  }

  /**
   * @param \Drupal\reservation_list\Model\Location $departureLocation
   */
  public function setDepartureLocation($departureLocation) {
    $this->departureLocation = $departureLocation;
  }

  /**
   * @return \Drupal\reservation_list\Model\Location
   */
  public function getArrivalLocation() {
    return $this->arrivalLocation;
  }

  /**
   * @param \Drupal\reservation_list\Model\Location $arrivalLocation
   */
  public function setArrivalLocation($arrivalLocation) {
    $this->arrivalLocation = $arrivalLocation;
  }

  /**
   * @return string
   */
  public function getDepartureTime() {
    return $this->departureTime;
  }

  /**
   * @param string $departureTime
   */
  public function setDepartureTime($departureTime) {
    $this->departureTime = $departureTime;
  }

  /**
   * @return string
   */
  public function getArrivalTime() {
    return $this->arrivalTime;
  }

  /**
   * @param string $arrivalTime
   */
  public function setArrivalTime($arrivalTime) {
    $this->arrivalTime = $arrivalTime;
  }

}
