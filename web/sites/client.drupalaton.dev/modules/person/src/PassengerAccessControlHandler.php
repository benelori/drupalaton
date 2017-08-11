<?php

namespace Drupal\person;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Passenger entity.
 *
 * @see \Drupal\person\Entity\Passenger.
 */
class PassengerAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\person\Entity\PassengerInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished passenger entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published passenger entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit passenger entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete passenger entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add passenger entities');
  }

}
