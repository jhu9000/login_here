<?php

namespace Drupal\login_here;

use Drupal\Core\Render\BubbleableMetadata;
use Drupal\Core\PathProcessor\InboundPathProcessorInterface;
use Drupal\Core\PathProcessor\OutboundPathProcessorInterface;
use Symfony\Component\HttpFoundation\Request;

class LoginHerePathProcessor implements OutboundPathProcessorInterface, InboundPathProcessorInterface {

  /**
   * {@inheritdoc}
   */
  public function processInbound($path, Request $request) {
    return $path;
  }

  /**
   * {@inheritdoc}
   */
  public function processOutbound($path, &$options = array(), Request $request = NULL, BubbleableMetadata $bubbleable_metadata = NULL) {
    if($path == "/user/login" || $path == "/user/logout") {
      $options['query']['destination'] = $request->getPathInfo();
      if ($bubbleable_metadata) {
        $bubbleable_metadata->addCacheContexts(['url']);
      }
    }
    return $path;
  }

}
