<?php

namespace Drupal\reservation_list\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\dao_pattern\Adapter\AdapterInterface;
use Drupal\dao_pattern\Model\DaoFactory;
use Drupal\dao_pattern\Model\DaoInterface;
use Masterminds\HTML5\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ReservationListController.
 */
class ReservationListController extends ControllerBase {

  /**
   * The DAO factory.
   *
   * @var \Drupal\dao_pattern\Model\DaoFactory
   */
  protected $daoFactory;

  /**
   * The adapter service.
   *
   * @var \Drupal\dao_pattern\Adapter\AdapterInterface
   */
  protected $adapter;

  /**
   * ReservationListController constructor.
   *
   * @param \Drupal\dao_pattern\Model\DaoFactory $businessObjectFactory
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
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('dao_pattern.factory'),
      $container->get('dao_pattern.adapter.reservation')
    );
  }

  public function reservations() {
    $webServiceDao = $this->daoFactory->getInstance('webservice');
    $businessObjects = [];
    try {
      $response = json_decode($webServiceDao->loadReservationsByCustomerId('CST_1'), TRUE);
      foreach ($response as $reservation) {
        $object = $this->adapter->transformWebServiceToBusinessObject($reservation);
        $this->adapter->transformBusinessObjectToEntity($object);
        $businessObjects[] = $object;
      }
    }
    catch (\Exception $exception) {
      $databaseDao = $this->daoFactory->getInstance('database');
      $response = $databaseDao->loadReservationsByCustomerId('CST_1');

      foreach ($response as $reservation) {
        $object = $this->adapter->transformEntityToBusinessObject($reservation);
        $businessObjects[] = $object;
      }
    }

    return [
      '#theme' => 'reservation_list',
      '#reservations' => $businessObjects,
    ];
  }

}
