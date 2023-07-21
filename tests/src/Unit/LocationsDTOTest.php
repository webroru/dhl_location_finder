<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\Unit;

use Drupal\dhl_location_finder\API\LocationsDTO;
use Drupal\Tests\UnitTestCase;

class LocationsDTOTest extends UnitTestCase
{
    public function testCreateLocationsDTO(): void
    {
        $data = [
            "locations" => [
                [
                    "url" => "/locations/8003-4008202",
                    "location" => [
                        "ids" => [
                            [
                                "locationId" => "8003-4008202",
                                "provider" => "parcel"
                            ],
                            [
                                "locationId" => "CGN293",
                                "provider" => "express"
                            ]
                        ],
                        "keyword" => "Postfiliale",
                        "keywordId" => "502",
                        "type" => "postoffice"
                    ],
                    "name" => "Postfiliale 502",
                    "distance" => 0,
                    "place" => [
                        "address" => [
                            "countryCode" => "DE",
                            "postalCode" => "53113",
                            "addressLocality" => "Bonn",
                            "streetAddress" => "Charles-de-Gaulle-Str. 20"
                        ],
                        "geo" => [
                            "latitude" => 50.71601,
                            "longitude" => 7.129804
                        ]
                    ],
                    "openingHours" => [
                        [
                            "opens" => "08:00:00",
                            "closes" => "17:00:00",
                            "dayOfWeek" => "http://schema.org/Monday"
                        ],
                        [
                            "opens" => "08:00:00",
                            "closes" => "17:00:00",
                            "dayOfWeek" => "http://schema.org/Tuesday"
                        ],
                        [
                            "opens" => "08:00:00",
                            "closes" => "17:00:00",
                            "dayOfWeek" => "http://schema.org/Wednesday"
                        ],
                        [
                            "opens" => "08:00:00",
                            "closes" => "17:00:00",
                            "dayOfWeek" => "http://schema.org/Thursday"
                        ],
                        [
                            "opens" => "08:00:00",
                            "closes" => "17:00:00",
                            "dayOfWeek" => "http://schema.org/Friday"
                        ],
                        [
                            "opens" => "10:00:00",
                            "closes" => "12:00:00",
                            "dayOfWeek" => "http://schema.org/Saturday"
                        ]
                    ],
                    "closurePeriods" => [
                    ],
                    "serviceTypes" => [
                        "parcel:pick-up",
                        "parcel:drop-off-unlabeled",
                        "postident",
                        "express:drop-off-easy",
                        "express:drop-off",
                        "express:drop-off-account",
                        "cash-on-delivery",
                        "express:drop-off-unlabeled",
                        "express:drop-off-prelabeled",
                        "parcel:drop-off",
                        "parking",
                        "age-verification",
                        "express:pick-up",
                        "letter-service"
                    ],
                    "averageCapacityDayOfWeek" => [
                    ]
                ]
            ]
        ];
        $dto = new LocationsDTO(...$data);

        $this->assertSame('Packstation 207', $dto->locations[0]['name']);
        $this->assertSame('DE', $dto->locations[0]['place']['address']['countryCode']);
    }
}
