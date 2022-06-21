<?php

namespace Drupal\random_number_field\Plugin\Field\FieldType;

use Drupal\Core\Field\Plugin\Field\FieldType\IntegerItem;

/**
 * Defines the 'integer' field type.
 *
 * @FieldType(
 *   id = "random_integer",
 *   label = @Translation("Random Number (integer)"),
 *   description = @Translation("This field stores a number in the database as an integer - ensure the default value is blank when saving."),
 *   category = @Translation("Number"),
 *   default_widget = "random_number",
 *   default_formatter = "random_number_integer"
 * )
 */
class RandomIntegerItem extends IntegerItem {

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
      'min' => '1',
      'max' => '10',
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function applyDefaultValue($notify = TRUE) {
    parent::applyDefaultValue($notify);

    // On the field edit form we would not want to populate the default value
    // as this would get stored - and then a random number would never be
    // generated.
    // The other approach would be to never save it, but that would remove
    // the ability to save a value if it became a requirement.
    $field_edit_form_pattern = '/entity.field_config.[a-z\_]+_field_edit_form/';
    if (preg_match($field_edit_form_pattern, \Drupal::routeMatch()->getRouteName())) {
      return $this;
    }

    // Random number fields default to a random number.
    $this
      ->setValue([
        'value' => mt_rand($this->getSetting('min'), $this->getSetting('max')),
      ], $notify);
    return $this;
  }

}
