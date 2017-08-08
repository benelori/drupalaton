<?php

namespace Drupal\reservation_list\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'route' field type.
 *
 * @FieldType(
 *   id = "route",
 *   label = @Translation("Route"),
 *   description = @Translation("The route field type."),
 *   default_widget = "route_widget",
 *   default_formatter = "route_formatter"
 * )
 */
class Route extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['departure'] = DataDefinition::create('entity_reference')
      ->setLabel(new TranslatableMarkup('Departure location'))
      ->setRequired(TRUE);

    $properties['arrival'] = DataDefinition::create('entity_reference')
      ->setLabel(new TranslatableMarkup('Arrival location'))
      ->setRequired(TRUE);

    $properties['stopover'] = DataDefinition::create('boolean')
      ->setLabel(t('Flag on whether the route is a stopover.'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'departure' => [
          'description' => 'The ID of the target entity.',
          'type' => 'int',
          'unsigned' => TRUE,
        ],
        'arrival' => [
          'description' => 'The ID of the target entity.',
          'type' => 'int',
          'unsigned' => TRUE,
        ],
        'stopover' => [
          'type' => 'int',
          'size' => 'tiny',
        ],
      ],
    ];

    return $schema;
  }

}
