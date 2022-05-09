<?php

namespace App\Http\Controllers;

use App\Models\User;

class ApiController extends Controller
{
    public function getOffers(){
      
        $userOffers = User::with('offers')->get();
        
        $arrayData = [];

        foreach ($userOffers as $userOffer) {

            $offers=[];

            foreach ($userOffer->offers as $offer) {
                $offers[]=[
                    "oferta" => $offer->nameOffer,
                    "estado" => $offer->status ? 'Activa' : 'Cerrada',
                ];
            }

            $arrayData[] = [
                "tipoId" => $userOffer->kindid->short_name,
                "Id" => $userOffer->docId,
                "nombre" => $userOffer->name,
                "ofertasAplicadas" => $offers,
            ];
        }

        return response()->json($arrayData);

    }

    public function insertUser () {
        
        $msj[] = ["message" => "Success"];

        return response()->json($msj);
    }
}
