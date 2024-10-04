<?php

namespace App\Services\Balance;

use App\Services\Balance\Exceptions\InsufficientFundException;
use App\Services\Balance\Exceptions\InvalidAmountException;

trait HasBalance
{
    /**
     * @throws InvalidAmountException
     */
    public function deposit(string $amount): string
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        $this->increment('balance', $amount);

        return $this->fresh()->balance;
    }

    /**
     * @throws InsufficientFundException
     * @throws InvalidAmountException
     */
    public function withdraw(string $amount): string
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        $this->throwExceptionIfFundIsInsufficient($amount);

        $this->decrement('balance', $amount);

        return $this->fresh()->balance;
    }

    /**
     * @throws InvalidAmountException
     */
    public function canWithdraw(string $amount): bool
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        $balance = $this->balance ?? 0;

        return $balance >= $amount;
    }

    /**
     * @throws InvalidAmountException
     */
    public function throwExceptionIfAmountIsInvalid(string $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidAmountException();
        }
    }

    /**
     * @throws InsufficientFundException
     * @throws InvalidAmountException
     */
    public function throwExceptionIfFundIsInsufficient(string $amount): void
    {
        if (!$this->canWithdraw($amount)) {
            throw new InsufficientFundException();
        }
    }
}
