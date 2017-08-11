<?php

namespace Drupal\reservation_list\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\dao_pattern\Adapter\AdapterInterface;
use Drupal\dao_pattern\Model\DaoFactory;
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

    $response = json_decode($webServiceDao->loadReservationsByCustomerId('CST_1'), TRUE);

    $entities = $this->adapter->transformWebServiceToEntity($response);

    var_dump($entities);
    die();
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: list')
    ];
  }

}
