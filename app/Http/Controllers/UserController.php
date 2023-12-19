<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "full_name" => "required",
                "username" => "required",
                "password" => "required"
            ]
        );

        if ($validator->fails()) {
            return response()->json(["message" => "Malumotlarni to'liq kiriting"], 422);
        }

        User::create([
            "full_name" => $request->full_name,
            "username" => $request->username,
            "password" => $request->password,
        ]);

        return response()->json(["message" => "User qo'shildi"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user  = User::where("id", $id)->first();

        if (!isset($user)) {
            return response()->json(["message" => "So'rovga mos malumot topilmadi"], 404);
        }

        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "full_name" => "required",
                "username" => "required",
                "password" => "required"
            ]
        );

        if ($validator->fails()) {
            return response()->json(["message" => "Malumotlarni to'liq kiriting"], 422);
        }

        $user  = User::where("id", $id)->first();

        if (!isset($user)) {
            return response()->json(["message" => "So'rovga mos malumot topilmadi"], 404);
        }

        $user->update([
            "full_name" => $request->full_name,
            "username" => $request->username,
            "password" => $request->password
        ]);

        return response()->json(["message" => "Foydalanuvchi malumotlari yangilandi"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user  = User::where("id", $id)->first();

        if (!isset($user)) {
            return response()->json(["message" => "So'rovga mos malumot topilmadi"], 404);
        }

        $user->delete();

        return response()->json(["message" => "Foydalanuvchi ma'lumotlari o'chirildi"], 200);
    }
}
