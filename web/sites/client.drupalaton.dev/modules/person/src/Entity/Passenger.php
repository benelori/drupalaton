<?php

namespace Drupal\person\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Passenger entity.
 *
 * @ingroup person
 *
 * @ContentEntityType(
 *   id = "passenger",
 *   label = @Translation("Passenger"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\person\PassengerListBuilder",
 *     "views_data" = "Drupal\person\Entity\PassengerViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\person\Form\PassengerForm",
 *       "add" = "Drupal\person\Form\PassengerForm",
 *       "edit" = "Drupal\person\Form\PassengerForm",
 *       "delete" = "Drupal\person\Form\PassengerDeleteForm",
 *     },
 *     "access" = "Drupal\person\PassengerAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\person\PassengerHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "passenger",
 *   admin_permission = "administer passenger entities",
 *   entity_keys = {
 *     "id" = "id",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/passenger/{passenger}",
 *     "add-form" = "/admin/structure/passenger/add",
 *     "edit-form" = "/admin/structure/passenger/{passenger}/edit",
 *     "delete-form" = "/admin/structure/passenger/{passenger}/delete",
 *     "collection" = "/admin/structure/passenger",
 *   },
 *   field_ui_base_route = "passenger.settings"
 * )
 */
class Passenger extends ContentEntityBase implements PassengerInterface {

  use EntityChangedTrait;

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
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['first_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('First Name'))
      ->setDescription(t('The name of the Customer entity.'));

    $fields['last_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Last Name'))
      ->setDescription(t('The name of the Customer entity.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    return $fields;
  }

}
