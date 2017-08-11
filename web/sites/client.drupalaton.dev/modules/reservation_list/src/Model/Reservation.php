<?php

namespace Drupal\reservation_list\Model;

/**
 * Class Reservation.
 *
 * @package Drupal\reservation_list\Model
 */
class Reservation {

  /**
   * @var string
   */
  private $pnr;

  /**
   * @var \Drupal\reservation_list\Model\Customer
   */
  private $owner;

  /**
   * @var \Drupal\reservation_list\Model\Passenger[]
   */
  private $otherPassengers;

  /**
   * @var \Drupal\reservation_list\Model\Route[]
   */
  private $routes;

  /**
   * Reservation constructor.
   *
   * @param string $pnr
   * @param \Drupal\reservation_list\Model\Customer $owner
   * @param \Drupal\reservation_list\Model\Passenger[] $otherPassengers
   * @param \Drupal\reservation_list\Model\Route[] $routes
   */
  public function __construct(
    $pnr,
    \Drupal\reservation_list\Model\Customer $owner,
    array $otherPassengers,
    array $routes
  ) {
    $this->pnr = $pnr;
    $this->owner = $owner;
    $this->otherPassengers = $otherPassengers;
    $this->routes = $routes;
  }

  /**
   * @return string
   */
  public function getPnr() {
    return $this->pnr;
  }

  /**
   * @param string $pnr
   */
  public function setPnr($pnr) {
    $this->pnr = $pnr;
  }

  /**
   * @return \Drupal\reservation_list\Model\Customer
   */
  public function getOwner() {
    return $this->owner;
  }

  /**
   * @param \Drupal\reservation_list\Model\Customer $owner
   */
  public function setOwner($owner) {
    $this->owner = $owner;
  }

  /**
   * @return \Drupal\reservation_list\Model\Passenger[]
   */
  public function getOtherPassengers() {
    return $this->otherPassengers;
  }

  /**
   * @param \Drupal\reservation_list\Model\Passenger[] $otherPassengers
   */
  public function setOtherPassengers($otherPassengers) {
    $this->otherPassengers = $otherPassengers;
  }

  /**
   * @return \Drupal\reservation_list\Model\Route[]
   */
  public function getRoutes() {
    return $this->routes;
  }

  /**
   * @param \Drupal\reservation_list\Model\Route[] $routes
   */
  public function setRoutes($routes) {
    $this->routes = $routes;
  }

}
