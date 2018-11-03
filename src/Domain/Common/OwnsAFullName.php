<?php

namespace ElyAccount\Domain\Common;

interface OwnsAFullName extends OwnsALastName, OwnsAFirstName
{
    public function fullName(): FullName;
}
