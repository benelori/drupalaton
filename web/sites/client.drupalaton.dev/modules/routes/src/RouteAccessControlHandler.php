<?php

namespace Drupal\routes;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Route entity.
 *
 * @see \Drupal\routes\Entity\Route.
 */
class RouteAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\routes\Entity\RouteInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished route entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published route entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit route entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete route entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add route entities');
  }

}
