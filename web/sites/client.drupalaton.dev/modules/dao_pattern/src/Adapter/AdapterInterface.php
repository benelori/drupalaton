<?php

namespace Drupal\dao_pattern\Adapter;

/**
 * Interface AdapterInterface.
 *
 * @package Drupal\dao_pattern\Adapter
 */
interface AdapterInterface {

  /**
   * Transforms the webservice response into entities.
   *
   * @param array $response
   *   The response.
   *
   * @return array
   *   An array of entities.
   */
  public function transformWebServiceToEntity(array $response);

}
