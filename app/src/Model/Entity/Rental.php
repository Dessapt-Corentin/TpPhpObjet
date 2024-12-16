<?php

namespace App\Model\Entity;

use \DateTime;
use Symplefony\Model\Entity;

class Rental extends Entity
{
    protected int $id;
    public function getId(): int
    {
        return $this->id;
    }

    protected \DateTime $date_start;
    
    public function getDateStart(): \DateTime
    {
        return $this->date_start;
    }
    public function setDateStart(\DateTime $date_start): self
    {
        $this->date_start = $date_start;
        return $this;
    }
    
    protected \DateTime $date_end;
    public function getDateEnd(): \DateTime
    {
        return $this->date_end;
    }
    public function setDateEnd(\DateTime $date_end): self
    {
        $this->date_end = $date_end;
        return $this;
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

    protected string $accommodation_id = '';
    public function getAccommodationId(): string
    {
        return $this->accommodation_id;
    }
    public function setAccommodationId(string $value): self
    {
        $this->accommodation_id = $value;
        return $this;
    }
}
