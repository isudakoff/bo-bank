<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function __invoke(
        Request $request,
        User $userFrom,
        User $userTo,
    ): JsonResponse {
        $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $userFrom, $userTo) {
            $userFrom->withdraw($request->input('amount'));
            $userTo->deposit($request->input('amount'));
        });

        return response()->json([
            'balance' => number_format($userFrom->balance, 0, '', ''),
        ]);
    }
}
