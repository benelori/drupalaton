<?php

/**
 * @file
 * Contains route_schedule.page.inc.
 *
 * Page callback for Route schedule entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Route schedule templates.
 *
 * Default template: route_schedule.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_route_schedule(array &$variables) {
  // Fetch RouteSchedule Entity Object.
  $route_schedule = $variables['elements']['#route_schedule'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
