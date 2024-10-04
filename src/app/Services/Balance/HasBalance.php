<?php

namespace App\Services\Balance;

use Balance\Exceptions\InsufficientFundException;
use Balance\Exceptions\InvalidAmountException;

trait HasBalance
{
    /**
     * @throws InvalidAmountException
     */
    public function deposit(int $amount): int
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        $this->increment('balance', $amount);

        return $this->fresh()->balance;
    }

    /**
     * @throws InsufficientFundException
     * @throws InvalidAmountException
     */
    public function withdraw(int $amount): int
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        $this->throwExceptionIfFundIsInsufficient($amount);

        $this->decrement('balance', $amount);

        return $this->fresh()->balance;
    }

    /**
     * @throws InvalidAmountException
     */
    public function canWithdraw(int $amount): bool
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        $balance = $this->balance ?? 0;

        return $balance >= $amount;
    }

    /**
     * @throws InvalidAmountException
     */
    public function throwExceptionIfAmountIsInvalid(int $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidAmountException();
        }
    }

    /**
     * @throws InsufficientFundException
     * @throws InvalidAmountException
     */
    public function throwExceptionIfFundIsInsufficient(int $amount): void
    {
        if (!$this->canWithdraw($amount)) {
            throw new InsufficientFundException();
        }
    }
}
