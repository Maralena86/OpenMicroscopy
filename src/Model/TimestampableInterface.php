<?php

declare(strict_types=1);

namespace App\Model;

interface TimestampableInterface
{
    public function getCreatedAt();
    public function setCreatedAt(\DateTimeInterface $createdAt);
    public function getUpdatedAt(); 
    public function setUpdatedAt(?\DateTimeInterface $updatedAt);

}
