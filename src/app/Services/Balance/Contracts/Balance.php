<?php

namespace App\Services\Balance\Contracts;

interface Balance
{
    public function deposit(int $amount): int;

    public function withdraw(int $amount): int;

    public function canWithdraw(int $amount): bool;

    public function throwExceptionIfAmountIsInvalid(int $amount): void;

    public function throwExceptionIfFundIsInsufficient(int $amount): void;
}
