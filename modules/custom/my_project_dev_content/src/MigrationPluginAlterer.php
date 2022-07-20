<?php

namespace Drupal\my_project_dev_content;

/**
 * Alters the migration plugin definitions.
 */
class MigrationPluginAlterer {

  /**
   * Alters the migration plugin definitions.
   */
  public static function alterDefinitions(&$definitions) {
    $directory_separator = preg_quote(DIRECTORY_SEPARATOR, '/');
    $module_root = preg_replace('/' . $directory_separator . 'src$/', '', __DIR__);

    // Update source references in our migrations.
    foreach ($definitions as $plugin_id => $definition) {
      if ($definition['provider'] !== 'my_project_dev_content') {
        continue;
      }
      // Set constant for file migration.
      $definitions[$plugin_id]['source']['constants']['eme_file_path'] = implode(DIRECTORY_SEPARATOR, [
        $module_root,
        'assets',
      ]);

      // Set the real path to the data source assets.
      if (!empty($definitions[$plugin_id]['source']['urls'])) {
        $source_urls = $definitions[$plugin_id]['source']['urls'];
        assert(is_array($source_urls));
        foreach ($source_urls as $key => $source_url) {
          assert(is_string($source_url));
          $definitions[$plugin_id]['source']['urls'][$key] = str_replace(
            '..',
            $module_root,
            $source_url
          );
        }
      }
    }
  }

}
