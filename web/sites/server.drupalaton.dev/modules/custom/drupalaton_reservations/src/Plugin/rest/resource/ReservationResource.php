<?php

namespace Drupal\drupalaton_reservations\Plugin\rest\resource;

use Drupal\drupalaton_reservations\Storage\Reservation;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "reservation_resource",
 *   label = @Translation("Reservation resource"),
 *   uri_paths = {
 *     "canonical" = "/api/v1/reservations/{customer_id}/{pnr}"
 *   }
 * )
 */
class ReservationResource extends ResourceBase {

  use ReservationResourceTrait;

  /**
   * Reservation node storage.
   *
   * @var \Drupal\drupalaton_reservations\Storage\Reservation
   */
  protected $reservationStorage;

  /**
   * Constructs a new ReservationResource object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   * @param \Drupal\drupalaton_reservations\Storage\Reservation $reservationStorage
   *   A current user instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    Reservation $reservationStorage) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->reservationStorage = $reservationStorage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('drupalaton_reservations'),
      $container->get('drupalaton_reservations.storage')
    );
  }

  /**
   * Responds to GET requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get($customer_id, $pnr) {
    $result = [];
    $entity = $this->reservationStorage->loadReservationsByCustomerIdAndPnr($customer_id, $pnr);

    if ($entity) {
      $result = [
        'pnr' => $pnr,
        'owner' => $this->getReservationOwner($entity),
        'other_passengers' => $this->getOtherPassengers($entity),
        'routes' => $this->getRoutes($entity),
      ];
    }
    return new ResourceResponse($result);
  }

}
