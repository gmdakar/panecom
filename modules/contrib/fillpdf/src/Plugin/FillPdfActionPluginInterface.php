<?php

namespace Drupal\fillpdf\Plugin;

use Drupal\Component\Plugin\DependentPluginInterface;
use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Executable\ExecutableInterface;

/**
 * Defines an interface for FillPDF action plugins.
 *
 * Action plugins must ultimately return a
 * \Symfony\Component\HttpFoundation\Response. They may provide additional
 * methods to provide callers with additional plugin-specific metadata.
 *
 * They may also have side effects, such as saving a file to the file system.
 * They must not, however, end the request.
 *
 * @todo Extend ConfigurableInterface once drupal:8.6.x is no longer supported.
 */
interface FillPdfActionPluginInterface extends PluginInspectionInterface, DependentPluginInterface, ContainerFactoryPluginInterface, ExecutableInterface {

  /**
   * Take action according to the plugin configuration.
   *
   * This will vary for each action plugin, but it should do something with the
   * PDF (e.g. prepare a download response, save it to a file, etc.) and return
   * an appropriate Response (or subclass thereof, such as RedirectResponse) to
   * the caller.
   *
   * When you need context info, see if it is passed to you in
   * $this->configuration.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   A response.
   *
   * @todo Document exceptions thrown if something goes wrong.
   */
  public function execute();

}
