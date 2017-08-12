<?php

namespace Drupal\reservation_list\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Reservation entity.
 *
 * @ingroup reservation_list
 *
 * @ContentEntityType(
 *   id = "reservation",
 *   label = @Translation("Reservation"),
 *   base_table = "reservation",
 *   handlers = {
 *     "storage" = "Drupal\reservation_list\Storage"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *   }
 * )
 */
class Reservation extends ContentEntityBase implements ReservationInterface {

  /**
   * {@inheritdoc}
   */
  public function getPnr() {
    return $this->get('pnr')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setPnr($pnr) {
    $this->set('pnr', $pnr);
    return $this;
  }

  public function getOwnerId() {
    return $this->get('owner')->target_id;
  }

  public function setOwnerId($id) {
    $this->set('owner', $id);
    return $this;
  }

  public function getOwner() {
    return $this->get('owner')->entity;
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

    $fields['pnr'] = BaseFieldDefinition::create('string')
      ->setLabel(t('PNR'))
      ->setDescription(t('The name of the Reservation entity.'))
      ->setSettings([
        'max_length' => 6,
        'text_processing' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['owner'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Reservation owner'))
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
