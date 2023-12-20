<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "title" => "required"
            ]
        );

        if ($validator->fails()) {
            return response()->json(["message" => "Malumotlarni to'liq kiriting"], 422);
        }

        Product::create([
            "title" => $request->title
        ]);

        return response()->json(["message" => "Product qo'shildi"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Product  = Product::where("id", $id)->first();

        if (!isset($Product)) {
            return response()->json(["message" => "So'rovga mos malumot topilmadi"], 404);
        }

        return $Product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "title" => "required"
            ]
        );

        if ($validator->fails()) {
            return response()->json(["message" => "Malumotlarni to'liq kiriting"], 422);
        }

        $Product  = Product::where("id", $id)->first();

        if (!isset($Product)) {
            return response()->json(["message" => "So'rovga mos malumot topilmadi"], 404);
        }

        $Product->update([
            "title" => $request->title
        ]);

        return response()->json(["message" => "Foydalanuvchi malumotlari yangilandi"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Product  = Product::where("id", $id)->first();

        if (!isset($Product)) {
            return response()->json(["message" => "So'rovga mos malumot topilmadi"], 404);
        }

        $Product->delete();

        return response()->json(["message" => "Foydalanuvchi ma'lumotlari o'chirildi"], 200);
    }
}
