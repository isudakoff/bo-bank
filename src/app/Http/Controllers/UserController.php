<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function store(): JsonResource
    {
        $password = Str::password(length: 8, symbols: false);
        //logs()->debug('password: ' . $password);
        $user = User::create([
            'email' => fake()->email(),
            'name' => fake()->name(),
            'age' => fake()->numberBetween(0, 150),
            'password' => $password,
        ]);

        return UserResource::make($user);
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function update(Request $request, User $user): JsonResource
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user),
            ],
            'age' => 'sometimes|integer|between:0,150',
        ]);

        $user->update($data);

        return UserResource::make($user->fresh());
    }
}
