<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Member = 'member';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
