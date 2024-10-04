<?php

namespace App\Services\Balance\Contracts;

interface Balance
{
    public function deposit(string $amount): string;

    public function withdraw(string $amount): string;

    public function canWithdraw(string $amount): bool;

    public function throwExceptionIfAmountIsInvalid(string $amount): void;

    public function throwExceptionIfFundIsInsufficient(string $amount): void;
}
