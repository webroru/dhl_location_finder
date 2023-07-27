<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\Entity\Location;

abstract class MiddlewareAbstract implements MiddlewareInterface
{
    private ?MiddlewareInterface $middleware = null;

    public function setNext(MiddlewareInterface $middleware): MiddlewareInterface
    {
        $this->middleware = $middleware;
        return $middleware;
    }

    public function handle(Location $location): ?Location
    {
        return $this->middleware?->handle($location);
    }
}
