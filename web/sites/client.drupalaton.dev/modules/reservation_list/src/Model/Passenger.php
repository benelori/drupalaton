<?php

namespace Drupal\reservation_list\Model;


class Passenger {

  private $firstName;
  private $lastName;
  private $age;

  /**
   * Passenger constructor.
   *
   * @param $firstName
   * @param $lastName
   * @param $age
   */
  public function __construct($firstName, $lastName, $age) {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->age = $age;
  }

  /**
   * @return mixed
   */
  public function getFirstName() {
    return $this->firstName;
  }

  /**
   * @param mixed $firstName
   */
  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }

  /**
   * @return mixed
   */
  public function getLastName() {
    return $this->lastName;
  }

  /**
   * @param mixed $lastName
   */
  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }

  /**
   * @return mixed
   */
  public function getAge() {
    return $this->age;
  }

  /**
   * @param mixed $age
   */
  public function setAge($age) {
    $this->age = $age;
  }

}
