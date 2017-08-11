<?php

namespace Drupal\routes\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Route schedule entity.
 *
 * @ingroup routes
 *
 * @ContentEntityType(
 *   id = "route_schedule",
 *   label = @Translation("Route schedule"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\routes\RouteScheduleListBuilder",
 *     "views_data" = "Drupal\routes\Entity\RouteScheduleViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\routes\Form\RouteScheduleForm",
 *       "add" = "Drupal\routes\Form\RouteScheduleForm",
 *       "edit" = "Drupal\routes\Form\RouteScheduleForm",
 *       "delete" = "Drupal\routes\Form\RouteScheduleDeleteForm",
 *     },
 *     "access" = "Drupal\routes\RouteScheduleAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\routes\RouteScheduleHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "route_schedule",
 *   admin_permission = "administer route schedule entities",
 *   entity_keys = {
 *     "id" = "id",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/route_schedule/{route_schedule}",
 *     "add-form" = "/admin/structure/route_schedule/add",
 *     "edit-form" = "/admin/structure/route_schedule/{route_schedule}/edit",
 *     "delete-form" = "/admin/structure/route_schedule/{route_schedule}/delete",
 *     "collection" = "/admin/structure/route_schedule",
 *   },
 *   field_ui_base_route = "route_schedule.settings"
 * )
 */
class RouteSchedule extends ContentEntityBase implements RouteScheduleInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['route'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Route schedule entity.'))
      ->setSetting('target_type', 'route');

    $fields['departure'] = BaseFieldDefinition::create('timestamp')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Route schedule is published.'))
      ->setDefaultValue(TRUE);

    $fields['arrival'] = BaseFieldDefinition::create('timestamp')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Route schedule is published.'))
      ->setDefaultValue(TRUE);

    return $fields;
  }

}
