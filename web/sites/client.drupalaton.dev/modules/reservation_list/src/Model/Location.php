<?php

namespace Drupal\reservation_list\Model;


class Location {

  /**
   * @var string
   */
  private $name;

  /**
   * @var string
   */
  private $code;

  /**
   * Location constructor.
   *
   * @param string $name
   * @param string $code
   */
  public function __construct($name, $code) {
    $this->name = $name;
    $this->code = $code;
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getCode() {
    return $this->code;
  }

  /**
   * @param string $code
   */
  public function setCode($code) {
    $this->code = $code;
  }

}
