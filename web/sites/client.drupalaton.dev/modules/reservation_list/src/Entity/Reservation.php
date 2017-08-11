<?php

namespace Drupal\reservation_list\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Reservation entity.
 *
 * @ingroup reservation_list
 *
 * @ContentEntityType(
 *   id = "reservation",
 *   label = @Translation("Reservation"),
 *   handlers = {
 *     "storage" = "Drupal\reservation_list\Storage\Reservation",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\reservation_list\ReservationListBuilder",
 *     "views_data" = "Drupal\reservation_list\Entity\ReservationViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\reservation_list\Form\ReservationForm",
 *       "add" = "Drupal\reservation_list\Form\ReservationForm",
 *       "edit" = "Drupal\reservation_list\Form\ReservationForm",
 *       "delete" = "Drupal\reservation_list\Form\ReservationDeleteForm",
 *     },
 *     "access" = "Drupal\reservation_list\ReservationAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\reservation_list\ReservationHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "reservation",
 *   admin_permission = "administer reservation entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/reservation/{reservation}",
 *     "add-form" = "/admin/structure/reservation/add",
 *     "edit-form" = "/admin/structure/reservation/{reservation}/edit",
 *     "delete-form" = "/admin/structure/reservation/{reservation}/delete",
 *     "collection" = "/admin/structure/reservation",
 *   },
 *   field_ui_base_route = "reservation.settings"
 * )
 */
class Reservation extends ContentEntityBase implements ReservationInterface {

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
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['pnr'] = BaseFieldDefinition::create('string')
      ->setLabel(t('PNR'))
      ->setDescription(t('The name of the Reservation entity.'))
      ->setSettings([
        'max_length' => 6,
        'text_processing' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['owner'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Reservation entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'customer')
      ->setSetting('handler', 'default')
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    return $fields;
  }

}
