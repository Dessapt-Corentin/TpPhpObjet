<?php

namespace App\Model\Entity;

use DateTime;
use Symplefony\Model\Entity;

class Rental extends Entity
{
    protected int $id;
    public function getId(): int
    {
        return $this->id;
    }

    protected int $user_id;
    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function setUserId(int $value): self
    {
        $this->user_id = $value;
        return $this;
    }

    protected int $accommodation_id;
    public function getAccommodationId(): int
    {
        return $this->accommodation_id;
    }
    public function setAccommodationId(int $value): self
    {
        $this->accommodation_id = $value;
        return $this;
    }

    protected DateTime $date_start;
    public function getDateStart(): DateTime
    {
        return $this->date_start;
    }
    public function setDateStart(DateTime $value): self
    {
        $this->date_start = $value;
        return $this;
    }

    protected DateTime $date_end;
    public function getDateEnd(): DateTime
    {
        return $this->date_end;
    }
    public function setDateEnd(DateTime $value): self
    {
        $this->date_end = $value;
        return $this;
    }
}
