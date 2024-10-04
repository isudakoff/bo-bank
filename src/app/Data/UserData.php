<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        #[Unique('users', 'email'), Email]
        public string $email,
        #[StringType]
        public string $name,
        #[IntegerType]
        public int $age,
    ) {
    }
}
