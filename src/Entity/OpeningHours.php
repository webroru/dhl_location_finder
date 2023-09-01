<?php

declare(strict_types=1);

namespace Drupal\location_finder\Entity;

class OpeningHours
{
    private ?string $monday;
    private ?string $tuesday;
    private ?string $wednesday;
    private ?string $thursday;
    private ?string $friday;
    private ?string $saturday;
    private ?string $sunday;

    public function getMonday(): ?string
    {
        return $this->monday;
    }

    public function setMonday(?string $monday): self
    {
        $this->monday = $monday;
        return $this;
    }

    public function getTuesday(): ?string
    {
        return $this->tuesday;
    }

    public function setTuesday(?string $tuesday): ?self
    {
        $this->tuesday = $tuesday;
        return $this;
    }

    public function getWednesday(): ?string
    {
        return $this->wednesday;
    }

    public function setWednesday(?string $wednesday): self
    {
        $this->wednesday = $wednesday;
        return $this;
    }

    public function getThursday(): ?string
    {
        return $this->thursday;
    }

    public function setThursday(?string $thursday): self
    {
        $this->thursday = $thursday;
        return $this;
    }

    public function getFriday(): ?string
    {
        return $this->friday;
    }

    public function setFriday(?string $friday): self
    {
        $this->friday = $friday;
        return $this;
    }

    public function getSaturday(): ?string
    {
        return $this->saturday;
    }

    public function setSaturday(?string $saturday): self
    {
        $this->saturday = $saturday;
        return $this;
    }

    public function getSunday(): ?string
    {
        return $this->sunday;
    }

    public function setSunday(?string $sunday): self
    {
        $this->sunday = $sunday;
        return $this;
    }
}
