<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
     public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'fantasy_name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14|unique:stores',
            'email' => 'required|string|email|max:255|unique:stores',
            'contact' => 'required|string|max:20',
            'city' => 'required|string|max:50',
            'neighborhood' => 'required|string|max:50',
            'number' => 'required|string|max:30',
            'street' => 'required|string|max:30',
            'state' => 'required|string|max:2',
            'cep' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $store = Store::create($validator->validated());

        return response()->json(['store' => $store], Response::HTTP_CREATED);
    }
    public function index()
{
    $stores = Store::all();
    return response()->json(['stores' => $stores], Response::HTTP_OK);
}
}
