<?php

class sfSecureFilter extends sfFilter
{
  public function execute($filterChain)
  {
    $context = $this->getContext();
    $request = $context->getRequest();
 
    if (!$request->isSecure())
    {
      $secure_url = str_replace('http', 'https', $request->getUri());
 
      return $context->getController()->redirect($secure_url);
      // We don't continue the filter chain
    }
    else
    {
      // The request is already secure, so we can continue
      $filterChain->execute();
    }
  }
}