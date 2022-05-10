<?php

namespace App\Http\Controllers;

use Validator;
use JWTAuth;
use App\Models\Kindid;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;


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
        
        $validator = Validator::make(request()->all(), [
            'tipoId' => 'required|string|max:2|min:2',
            'id' => 'required|string|min:3|max:12',
            'nombre' => 'required|string|min:4|max:50',
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kindId = request()->input('tipoId') ?? '';
        $idUser = request()->input('id') ?? '';
        $name = request()->input('nombre') ?? '';
        $email = request()->input('email') ?? '';
        $password = request()->input('password') ?? '';

        $setKindId = Kindid::where('short_name', '=', $kindId)->first();

        $user = User::create([
            'kindId' => $setKindId->id ?? 'CC',
            'docId' => $idUser,
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        
        ]);

        $credentials = request()->only('email', 'password');
        return response()->json([
            'message' => 'User created',
            'token' => JWTAuth::attempt($credentials),
            'user' => $user
        ], Response::HTTP_OK);
    }

    /**
     * login user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    } 

}
