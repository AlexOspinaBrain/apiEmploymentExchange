<?php

namespace App\Http\Controllers;

use Validator;
use JWTAuth;
use App\Models\Kindid;
use App\Models\User;
use Illuminate\Http\Request;
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
        
        $kindId = request()->input('tipoId') ?? '';
        $idUser = request()->input('id') ?? '';
        $name = request()->input('nombre') ?? '';
        $email = request()->input('email') ?? '';

        $setKindId = Kindid::where('short_name', '=', $kindId)->first();

        $user = User::create([
            'kindId' => $setKindId->id,
            'docId' => $idUser,
            'name' => $name,
            'email' => $email,
        
            //$user->password = $this->password_generate(2,9,1);
            'password' => bcrypt('Porahora'),
        
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
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

    public function password_generate($n, $l, $s) 
    {
        $numbers = '1234567890';
        $letters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $special = '--!=!@@#++%';
        return substr(str_shuffle($numbers), 0, $n).substr(str_shuffle($letters), 0, $l).substr(str_shuffle($special), 0, $s);
    }
}
