<?php

namespace Drupal\reservation_list\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'passenger' field type.
 *
 * @FieldType(
 *   id = "passenger",
 *   label = @Translation("Passenger"),
 *   description = @Translation("Passenger field type"),
 *   default_widget = "passenger_widget",
 *   default_formatter = "passenger_formatter"
 * )
 */
class Passenger extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Prevent early t() calls by using the TranslatableMarkup.
    $properties['first_name'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('First Name'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['last_name'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Last Name'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    $properties['age'] = DataDefinition::create('integer')
      ->setLabel(t('Integer value'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'first_name' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'varchar_ascii' : 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'last_name' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'varchar_ascii' : 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'age' => [
          'type' => 'int',
          'unsigned' => $field_definition->getSetting('unsigned'),
          'size' => $field_definition->getSetting('size'),
        ],
      ],
    ];

    return $schema;
  }

}
