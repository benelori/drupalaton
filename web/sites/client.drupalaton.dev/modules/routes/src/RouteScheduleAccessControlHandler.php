<?php

namespace Drupal\routes;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Route schedule entity.
 *
 * @see \Drupal\routes\Entity\RouteSchedule.
 */
class RouteScheduleAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\routes\Entity\RouteScheduleInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished route schedule entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published route schedule entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit route schedule entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete route schedule entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add route schedule entities');
  }

}
