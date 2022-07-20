<?php

declare(strict_types = 1);

namespace Drupal\entity_route_context;

use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Interface for route helper.
 */
interface EntityRouteContextRouteHelperInterface {

  /**
   * Get all entity routes.
   *
   * @return array
   *   An array of entity type ID's keyed by route name.
   */
  public function getAllRouteNames(): array;

  /**
   * Get all routes for an entity type.
   *
   * @param string $entityTypeId
   *   An entity type.
   *
   * @return array
   *   An array of route names keyed by link template.
   */
  public function getRouteNames(string $entityTypeId): array;

  /**
   * Get the entity type for a route name.
   *
   * @param string $routeName
   *   A route name.
   *
   * @return string|null
   *   An entity type ID, or null if the route name does not correspond to an
   *   entity link template.
   */
  public function getEntityTypeId(string $routeName): ?string;

  /**
   * Get the entity type and link template for a route match.
   *
   * @param \Drupal\Core\Routing\RouteMatchInterface $routeMatch
   *   A route match to get entity type and link template.
   *
   * @return string[]|null
   *   An array with two values with keys, or NULL if not matched:
   *   - 0: (string) The entity type.
   *   - 1: (string) The link template.
   */
  public function getLinkTemplateByRouteMatch(RouteMatchInterface $routeMatch): ?array;

}
