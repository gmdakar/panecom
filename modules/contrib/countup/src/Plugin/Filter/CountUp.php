<?php

namespace Drupal\countup\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a filter to attach the needed libraries for the CountUp plugin.
 *
 * @Filter(
 *   id = "countup",
 *   title = @Translation("CountUp.js"),
 *   description = @Translation("Attach the needed libraries for the CountUp plugin."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_IRREVERSIBLE
 * )
 */
class CountUp extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $result = new FilterProcessResult($text);

    // Check if countup "class" exists.
    if (stristr($text, 'countup') !== FALSE) {
      $result->addAttachments([
        'library' => [
          'countup/core',
        ],
      ]);
    }

    return $result;
  }

}
