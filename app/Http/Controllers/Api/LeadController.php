<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lead;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThanksMail;


class LeadController extends Controller
{
    public function store (Request $request) {
        $data = $request->all();
        
        // dobbimao validare i dati prima di salvarli nel db
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required|max:60000',
        ]);

        // SE la validazione fallisce, questo pezzo viene eseguito
        // e mi ritorna success=false e anche gli errori che ci sono
        if($validator->fails()){
            return response()->json ([
                'success' => false,
                // questo torna un oggetto con dentro degli array
                // che contengono la lista degli errori
                'errors' => $validator->errors()
            ]);
        }

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        Mail::to($data['email'])->send(new ThanksMail());

        return response()->json([
            'success' => true
        ]);
    }
}
