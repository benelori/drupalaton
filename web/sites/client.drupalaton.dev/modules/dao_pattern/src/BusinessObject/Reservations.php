<?php

namespace Drupal\dao_pattern\BusinessObject;

use Drupal\dao_pattern\Adapter\AdapterInterface;
use Drupal\dao_pattern\Model\DaoFactory;

/**
 * Class Reservations.
 *
 * @package Drupal\dao_pattern\BusinessObject
 */
class Reservations implements BusinessObjectInterface {

  /**
   * DAO factory.
   *
   * @var \Drupal\dao_pattern\Model\DaoFactory
   */
  protected $daoFactory;

  /**
   * Adapter service.
   *
   * @var \Drupal\dao_pattern\Adapter\AdapterInterface
   */
  protected $adapter;

  /**
   * Reservations constructor.
   *
   * @param \Drupal\dao_pattern\Model\DaoFactory $daoFactory
   *   The DAO factory.
   * @param \Drupal\dao_pattern\Adapter\AdapterInterface $adapter
   *   Adapter service.
   */
  public function __construct(
    DaoFactory $daoFactory,
    AdapterInterface $adapter
  ) {
    $this->daoFactory = $daoFactory;
    $this->adapter = $adapter;
  }

  /**
   * {@inheritdoc}
   */
  public function getEntities() {
    $webServiceDao = $this->daoFactory->getInstance('webservice');

    $response = json_decode($webServiceDao->loadReservationsByCustomerId('CST_1'), TRUE);
    return $this->adapter->transformWebServiceToEntity($response);
  }

}
