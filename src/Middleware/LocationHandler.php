<?php

declare(strict_types=1);

namespace Drupal\location_finder\Middleware;

use Drupal\location_finder\Entity\Location;

class LocationHandler extends MiddlewareAbstract
{
    private MiddlewareInterface $middleware;

    public function __construct(
        AddressFilterMiddleware $addressFilterMiddleware,
        WeekendFilterMiddleware $weekendFilterMiddleware,
    ) {
        $this->middleware = $addressFilterMiddleware;
        $this->middleware->setNext($weekendFilterMiddleware);
    }

    public function handle(Location $location): ?Location
    {
        return $this->middleware->handle($location);
    }
}
