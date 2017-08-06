<?php

namespace Drupal\drupalaton_reservations\Plugin\rest\resource;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;
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
 *     "canonical" = "/api/v1/reservations/{pnr}"
 *   }
 * )
 */
class ReservationResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

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
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   A current user instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    EntityTypeManagerInterface $entityTypeManager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->entityTypeManager = $entityTypeManager;
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
      $container->get('entity_type.manager')
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
  public function get($pnr) {
    $entity = $this->getReservation($pnr);
    $other_passengers = [];

    $result = [
      'pnr' => $pnr,
      'owner' => $this->getReservationOwner($entity),
      'other_passengers' => $this->getOtherPassengers($entity),
      'routes' => $this->getRoutes($entity),
    ];
    return new ResourceResponse($result);
  }

  private function getReservation($pnr) {
    $query = $this->entityTypeManager->getStorage('node')->getQuery();
    $query->condition('field_pnr', $pnr);

    $results = $query->execute();
    $entities = $this->entityTypeManager->getStorage('node')->loadMultiple($results);

    return reset($entities);
  }

  private function getReservationOwner(NodeInterface $entity) {
    return [
      "first_name" => $entity->field_main_passenger->entity->field_first_name->value,
      "last_name" => $entity->field_main_passenger->entity->field_last_name->value,
      'age' => $entity->field_main_passenger->entity->field_age->value,
    ];
  }

  private function getOtherPassengers(NodeInterface $entity) {
    $output = [];
    $otherPassengers = $entity->field_other_passengers->getValue();

    foreach ($otherPassengers as $key => $value) {
      $output[$key] = [
        "first_name" => $entity->field_other_passengers[$key]->entity->field_first_name->value,
        "last_name" => $entity->field_other_passengers[$key]->entity->field_last_name->value,
        'age' => $entity->field_other_passengers[$key]->entity->field_age->value,
      ];
    }

    return $output;
  }

  private function getRoutes(NodeInterface $entity) {
    $output = [];

    $routes = $entity->field_routes->getValue();
    foreach ($routes as $key => $value) {
      $stopOver = ($key > 0 && $key < count($routes) - 1);

      $output[$key] = [
        'departure' => [
          'name' => $entity->field_routes[$key]->entity->field_departure->entity->field_name->value,
          'code' => $entity->field_routes[$key]->entity->field_departure->entity->field_code->value,
          'time' => $entity->field_routes[$key]->entity->field_departure_time->value,
          'stopover' => $stopOver,
        ],
        'arrival' => [
          'name' => $entity->field_routes[$key]->entity->field_arrival->entity->field_name->value,
          'code' => $entity->field_routes[$key]->entity->field_arrival->entity->field_code->value,
          'time' => $entity->field_routes[$key]->entity->field_arrival_time->value,
          'stopover' => $stopOver,
        ],
      ];
    }
    return $output;
  }

}
