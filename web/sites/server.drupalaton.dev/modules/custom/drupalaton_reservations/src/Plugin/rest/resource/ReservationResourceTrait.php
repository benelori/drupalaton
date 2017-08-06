<?php

namespace Drupal\drupalaton_reservations\Plugin\rest\resource;


use Drupal\node\NodeInterface;

trait ReservationResourceTrait {

  public function getReservationOwner(NodeInterface $entity) {
    return [
      "first_name" => $entity->field_main_passenger->entity->field_first_name->value,
      "last_name" => $entity->field_main_passenger->entity->field_last_name->value,
      'age' => $entity->field_main_passenger->entity->field_age->value,
    ];
  }

  public function getOtherPassengers(NodeInterface $entity) {
    $output = [];
    $otherPassengers = $entity->field_other_passengers->getValue();

    foreach ($otherPassengers as $key => $value) {
      if (
        $entity->field_other_passengers[$key]->entity->field_first_name->value ||
        $entity->field_other_passengers[$key]->entity->field_last_name->value ||
        $entity->field_other_passengers[$key]->entity->field_age->value
      ) {
        $output[$key] = [
          "first_name" => $entity->field_other_passengers[$key]->entity->field_first_name->value,
          "last_name" => $entity->field_other_passengers[$key]->entity->field_last_name->value,
          'age' => $entity->field_other_passengers[$key]->entity->field_age->value,
        ];
      }
    }

    return $output;
  }

  public function getRoutes(NodeInterface $entity) {
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