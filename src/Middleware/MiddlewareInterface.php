<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\Entity\Location;

interface MiddlewareInterface
{
    public function setNext(MiddlewareInterface $middleware): self;
    public function handle(Location $location): ?Location;
}
