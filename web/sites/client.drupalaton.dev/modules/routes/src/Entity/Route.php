<?php

namespace Drupal\routes\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Route entity.
 *
 * @ingroup routes
 *
 * @ContentEntityType(
 *   id = "route",
 *   label = @Translation("Route"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\routes\RouteListBuilder",
 *     "views_data" = "Drupal\routes\Entity\RouteViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\routes\Form\RouteForm",
 *       "add" = "Drupal\routes\Form\RouteForm",
 *       "edit" = "Drupal\routes\Form\RouteForm",
 *       "delete" = "Drupal\routes\Form\RouteDeleteForm",
 *     },
 *     "access" = "Drupal\routes\RouteAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\routes\RouteHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "route",
 *   admin_permission = "administer route entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/route/{route}",
 *     "add-form" = "/admin/structure/route/add",
 *     "edit-form" = "/admin/structure/route/{route}/edit",
 *     "delete-form" = "/admin/structure/route/{route}/delete",
 *     "collection" = "/admin/structure/route",
 *   },
 *   field_ui_base_route = "route.settings"
 * )
 */
class Route extends ContentEntityBase implements RouteInterface {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['departure'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Route entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'location')
      ->setSetting('handler', 'default');

    $fields['arrival'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Route entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'location')
      ->setSetting('handler', 'default');

    return $fields;
  }

}
