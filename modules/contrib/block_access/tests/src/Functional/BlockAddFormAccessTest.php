<?php

declare(strict_types=1);

namespace Drupal\Tests\block_access\Functional;

use Drupal\block_content\Entity\BlockContentType;
use Drupal\Tests\BrowserTestBase;

/**
 * Tests access to the block add form.
 *
 * @group block_access
 */
final class BlockAddFormAccessTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'block_content',
    'block',
    'block_access',
  ];

  /**
   * Test block add form.
   */
  public function testBlockAddForm(): void {
    $block_type = BlockContentType::create([
      'id' => 'foo',
      'label' => 'Foo',
    ]);
    $block_type->save();
    $this->drupalGet('block/add/foo');
    $assert = $this->assertSession();
    $assert->statusCodeEquals(403);
    $this->drupalLogin($this->createUser([
      'create foo block_content',
    ]));
    $this->drupalGet('block/add/foo');
    $assert->statusCodeEquals(200);
  }

}
