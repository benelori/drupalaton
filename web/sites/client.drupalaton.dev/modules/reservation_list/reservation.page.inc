<?php

/**
 * @file
 * Contains reservation.page.inc.
 *
 * Page callback for Reservation entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Reservation templates.
 *
 * Default template: reservation.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_reservation(array &$variables) {
  // Fetch Reservation Entity Object.
  $reservation = $variables['elements']['#reservation'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
