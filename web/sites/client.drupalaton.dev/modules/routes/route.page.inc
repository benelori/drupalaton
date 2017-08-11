<?php

/**
 * @file
 * Contains route.page.inc.
 *
 * Page callback for Route entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Route templates.
 *
 * Default template: route.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_route(array &$variables) {
  // Fetch Route Entity Object.
  $route = $variables['elements']['#route'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
