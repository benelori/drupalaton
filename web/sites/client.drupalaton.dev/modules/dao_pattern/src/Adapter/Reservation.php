<?php

namespace Drupal\dao_pattern\Adapter;

use Drupal\person\Entity\Passenger as PassengerEntity;
use Drupal\reservation_list\Entity\ReservationInterface;
use Drupal\reservation_list\Model\Customer;
use Drupal\reservation_list\Model\Location;
use Drupal\reservation_list\Model\Passenger;
use Drupal\reservation_list\Model\Route;
use \Drupal\reservation_list\Model\Reservation as ReservationBusinessObject;
use Drupal\routes\Entity\RouteSchedule;

/**
 * Class Reservation.
 *
 * @package Drupal\dao_pattern\Adapter
 */
class Reservation implements AdapterInterface {

  public function transformEntityToBusinessObject(
    ReservationInterface $reservation
  ) {
    /** @var \Drupal\person\Entity\Customer $owner */
    $owner = $reservation->owner->entity;

    $passengerInfo = $owner->passenger_id->entity;
    $ownerInfo = new \Drupal\reservation_list\Model\Passenger(
      $passengerInfo->first_name->value,
      $passengerInfo->last_name->value,
      $passengerInfo->age->value
    );
    $owner = new Customer($owner->customer_id->value, $ownerInfo);


    $otherPassengerIds = $reservation->get('field_other_passengers')->getValue();

    $otherPassengers = [];
    foreach ($otherPassengerIds as $key => $id) {
      $passenger = $reservation->field_other_passengers[$key]->entity;

      $other = new \Drupal\reservation_list\Model\Passenger(
        $passenger->first_name->value,
        $passenger->last_name->value,
        $passenger->age->value
      );
      $otherPassengers[] = $other;
    }

    $routes = $reservation->get('field_routes')->getValue();

    foreach ($routes as $key => $route) {
      $routeScheduleEntity = $reservation->field_routes[$key]->entity;

      $routeEntity = $routeScheduleEntity->route->entity;

      $departureLocationEntity = $routeEntity->departure->entity;
      $arrivalLocationEntity = $routeEntity->arrival->entity;

      $departureLocation = new Location($departureLocationEntity->name->value, $departureLocationEntity->code->value);
      $arrivalLocation = new Location($arrivalLocationEntity->name->value, $arrivalLocationEntity->code->value);

      $tempRoute = new Route(
        $departureLocation,
        $arrivalLocation,
        date('Y-m-d', $routeScheduleEntity->departure->value),
        date('Y-m-d', $routeScheduleEntity->arrival->value)
      );
      $routeObjects[] = $tempRoute;
    }

    return new \Drupal\reservation_list\Model\Reservation(
      $reservation->pnr->value,
      $owner,
      $otherPassengers,
      $routeObjects
    );
  }

  /**
   * {@inheritdoc}
   */
  public function transformWebServiceToBusinessObject(array $response) {
    $ownerInfo = new \Drupal\reservation_list\Model\Passenger(
      $response['owner']['first_name'],
      $response['owner']['last_name'],
      $response['owner']['age']
    );
    $owner = new Customer('CST_1', $ownerInfo);

    $otherPassengers = [];
    foreach ($response['other_passengers'] as $passenger) {
      $other = new \Drupal\reservation_list\Model\Passenger(
        $passenger['first_name'],
        $passenger['last_name'],
        $passenger['age']
      );
      $otherPassengers[] = $other;
    }

    $routes = [];
    foreach ($response['routes'] as $route) {
      $departureLocation = new Location($route['departure']['name'], $route['departure']['code']);
      $arrivalLocation = new Location($route['arrival']['name'], $route['arrival']['code']);

      $tempRoute = new Route(
        $departureLocation,
        $arrivalLocation,
        $route['departure']['time'],
        $route['arrival']['time']
      );
      $routes[] = $tempRoute;
    }

    return new \Drupal\reservation_list\Model\Reservation(
      $response['pnr'],
      $owner,
      $otherPassengers,
      $routes
    );
  }

  public function transformBusinessObjectToEntity(ReservationBusinessObject $reservation) {
    $reservationEntity = \Drupal\reservation_list\Entity\Reservation::create([
      'pnr' => $reservation->getPnr(),
      'owner' => $this->saveOwner($reservation),
    ]);


    foreach ($reservation->getOtherPassengers() as $otherPassenger) {
      $otherPassengerIds[] = $this->savePassenger($otherPassenger);
    }
    $reservationEntity->set('field_other_passengers', $otherPassengerIds);

    foreach ($reservation->getRoutes() as $route) {
      $routeScheduleIds[] = $this->saveRoute($route);
    }
    $reservationEntity->set('field_routes', $routeScheduleIds);

    $reservationEntity->save();
  }

  private function saveRoute(Route $route) {
    $locationStorage = \Drupal::entityTypeManager()->getStorage('location');
    /** @var \Drupal\location\Entity\Location $departureLocation */
    $departureLocations = $locationStorage->loadByProperties([
      'code' => $route->getDepartureLocation()->getCode(),
    ]);
    $departureLocation = reset($departureLocations);

    /** @var \Drupal\location\Entity\Location $departureLocation */
    $arrivalLocations = $locationStorage->loadByProperties([
      'code' => $route->getArrivalLocation()->getCode(),
    ]);
    $arrivalLocation = reset($arrivalLocations);

    $entity = \Drupal\routes\Entity\Route::create([
      'departure' => $departureLocation->id(),
      'arrival' => $arrivalLocation->id(),
    ]);

    $entity->save();

    $routeSchedule = RouteSchedule::create([
      'route' => $entity->id(),
      'departure' => strtotime($route->getDepartureTime()),
      'arrival' => strtotime($route->getArrivalTime()),
    ]);

    $routeSchedule->save();

    return [
      'target_id' => $routeSchedule->id(),
    ];
  }

  private function saveOwner(ReservationBusinessObject $reservation) {
    $owner = $reservation->getOwner();

    $customer = \Drupal\person\Entity\Customer::create([
      'passenger_id' => $this->savePassenger($owner->getPassengerInfo())['target_id'],
      'created' => time(),
      'customer_id' => 'CST_1',
    ]);

    $customer->save();
    return [
      'target_id' => $customer->id(),
    ];
  }

  private function savePassenger(Passenger $passenger) {
    $passengerInfo = PassengerEntity::create([
      'first_name' => $passenger->getFirstName(),
      'last_name' => $passenger->getLastName(),
      'age' => $passenger->getAge(),
    ]);

    $passengerInfo->save();

    return [
      'target_id' => $passengerInfo->id(),
    ];
  }

}
