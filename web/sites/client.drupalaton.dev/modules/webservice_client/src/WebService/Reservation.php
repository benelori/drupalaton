<?php

namespace Drupal\webservice_client\WebService;

use Drupal\Core\Url;
use Drupal\dao_pattern\Model\DaoInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Reservation.
 *
 * @package Drupal\webservice_client\WebService
 */
class Reservation implements DaoInterface {

  /**
   * Webservice client.
   *
   * @var \GuzzleHttp\Client
   */
  protected $httpClient;

  /**
   * Reservation constructor.
   *
   * @param \GuzzleHttp\Client $httpClient
   *   The http client service.
   */
  public function __construct(Client $httpClient) {
    $this->httpClient = $httpClient;
  }

  /**
   * {@inheritdoc}
   */
  public function loadReservationsByCustomerId($customerId) {
    /** @var \Drupal\Core\Url $url */
    $url = Url::fromUri($this->getBaseUrl() . $customerId, [
      'query' => [
        '_format' => 'json',
      ],
    ]);

    try {
      $response = $this->httpClient->request('GET', $url->toString());
      return $response->getBody()->getContents();
    }
    catch (RequestException $exception) {
      watchdog_exception('reservation ws call', $exception);
    }

    return '';
  }

  /**
   * Returns the base URL.
   *
   * @return string
   *   The base URL of the webservice.
   */
  private function getBaseUrl() {
    return 'http://server.drupalaton.dev/api/v1/reservations/';
  }

}
