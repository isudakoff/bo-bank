<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function show(Request $request, User $user)
    {
        return response()->json([
            'balance' => $user->balance,
        ]);
    }

    public function deposit(Request $request, User $user)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        return response()->json([
            'balance' => $user->deposit($request->input('amount')),
        ]);
    }
}
