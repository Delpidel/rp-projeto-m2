<?php

namespace App\Http\Controllers;

use App\Models\Supplement;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SupplementController extends Controller
{
    use HttpResponses;

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'manufacturer_name' => 'required|string|max:255',
            'amount' => 'required|integer',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'type' => 'required|in:Cápsula,Em pó,Grão,Líquido,Outros',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados fornecidos inválidos.', Response::HTTP_BAD_REQUEST, $validator->errors()->toArray());
        }

        $supplement = Supplement::create($validator->validated());

        return $this->response('Supplement cadastrado com sucesso.', Response::HTTP_CREATED, $supplement);
    }
}
