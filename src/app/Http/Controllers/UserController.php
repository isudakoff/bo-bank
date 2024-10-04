<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{
    public function store(): JsonResource
    {
        $userData = UserData::from([
            'email' => fake()->email(),
            'name' => fake()->name(),
            'age' => fake()->numberBetween(0, 150),
        ]);
        $password = Str::password(length: 8, symbols: false);
        //logs()->debug('password: ' . $password);
        $user = User::create($userData->toArray() + compact('password'));

        return UserResource::make($user);
    }

    public function create(): View
    {
        return view('users.create');
    }
}
