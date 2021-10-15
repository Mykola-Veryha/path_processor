<?php

namespace Drupal\MODULE_NAME\EventSubscriber;

use Drupal\MODULE_NAME\PathProcessor\PathProcessor;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Don't auto redirect from pages by conditions.
 */
class RouteNormalizerRequestSubscriber implements EventSubscriberInterface {

  /**
   * Don't redirect from interactive revisions.
   */
  public function onKernelRequestRedirect(RequestEvent $event): void {
    $path = $event->getRequest()->getPathInfo();
    if (!empty($path) && YOUR_CUSTOM_CONDITION) {
      $event->getRequest()->attributes->set('_disable_route_normalizer', TRUE);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    $events[KernelEvents::REQUEST][] = ['onKernelRequestRedirect', 2000];

    return $events;
  }

}
