<?php

namespace Drupal\person\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Customer entity.
 *
 * @ingroup person
 *
 * @ContentEntityType(
 *   id = "customer",
 *   label = @Translation("Customer"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\person\CustomerListBuilder",
 *     "views_data" = "Drupal\person\Entity\CustomerViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\person\Form\CustomerForm",
 *       "add" = "Drupal\person\Form\CustomerForm",
 *       "edit" = "Drupal\person\Form\CustomerForm",
 *       "delete" = "Drupal\person\Form\CustomerDeleteForm",
 *     },
 *     "access" = "Drupal\person\CustomerAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\person\CustomerHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "customer",
 *   admin_permission = "administer customer entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "customer_id" = "customer_id",
 *     "passenger_id" = "passenger_id",
 *     "created" = "created",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/customer/{customer}",
 *     "add-form" = "/admin/structure/customer/add",
 *     "edit-form" = "/admin/structure/customer/{customer}/edit",
 *     "delete-form" = "/admin/structure/customer/{customer}/delete",
 *     "collection" = "/admin/structure/customer",
 *   },
 * )
 */
class Customer extends ContentEntityBase implements CustomerInterface {

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

    $fields['customer_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('The ID of the customer'))
      ->setReadOnly(TRUE);

    $fields['passenger_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Passenger entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'passenger');

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    return $fields;
  }

}
