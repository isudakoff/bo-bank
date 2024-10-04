<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function show(Request $request, User $user)
    {
        return response()->json([
            'balance' => number_format($user->balance, 0, '', ''),
        ]);
    }

    public function deposit(Request $request, User $user)
    {
        $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        return response()->json([
            'balance' => number_format($user->deposit($request->input('amount')), 0, '', ''),
        ]);
    }
}
