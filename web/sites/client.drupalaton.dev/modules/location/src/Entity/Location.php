<?php

namespace Drupal\location\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Location entity.
 *
 * @ingroup location
 *
 * @ContentEntityType(
 *   id = "location",
 *   label = @Translation("Location"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\location\LocationListBuilder",
 *     "views_data" = "Drupal\location\Entity\LocationViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\location\Form\LocationForm",
 *       "add" = "Drupal\location\Form\LocationForm",
 *       "edit" = "Drupal\location\Form\LocationForm",
 *       "delete" = "Drupal\location\Form\LocationDeleteForm",
 *     },
 *     "access" = "Drupal\location\LocationAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\location\LocationHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "location",
 *   admin_permission = "administer location entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "code" = "code",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/location/{location}",
 *     "add-form" = "/admin/structure/location/add",
 *     "edit-form" = "/admin/structure/location/{location}/edit",
 *     "delete-form" = "/admin/structure/location/{location}/delete",
 *     "collection" = "/admin/structure/location",
 *   },
 *   field_ui_base_route = "location.settings"
 * )
 */
class Location extends ContentEntityBase implements LocationInterface {

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

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Location entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['code'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Code'))
      ->setDescription(t('The code of the Location entity.'))
      ->setSettings([
        'max_length' => 4,
        'text_processing' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
