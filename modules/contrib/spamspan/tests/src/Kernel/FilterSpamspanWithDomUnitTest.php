<?php

namespace Drupal\Tests\spamspan\Kernel;

/**
 * Tests spamspan filter with DOM parsing.
 *
 * @group spamspan
 */
class FilterSpamspanWithDomUnitTest extends FilterSpamspanUnitTest {

  /**
   * Use DOM.
   *
   * @var int
   */
  protected $withDom = 1;

}
