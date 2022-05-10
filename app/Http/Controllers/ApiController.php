<?php

namespace App\Http\Controllers;

use App\Models\Joboffer;
use Validator;
use JWTAuth;
use App\Models\Kindid;
use App\Models\User;
use App\Models\User_offer;
use Symfony\Component\HttpFoundation\Response;

/**
 * Manage API endpoints
 */
class ApiController extends Controller
{

    /**
     * Register new user
     */
    public function insertUser () {
        
        /**Request validation */
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

        /**
         * Find Kind id
         * 
         */
        $setKindId = Kindid::where('short_name', '=', $kindId)->first();

        /**
         * Insert user
         */
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

        /**
         * Validation by email and password
         */
        if (!$token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        /**Returns token */
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

    /**
     * Fetch Users with their applied offers
     */
    public function getOffers(){
      
        /**
         * All users and offers relation 
         */
        $userOffers = User::with('offers')->get();
        
        $arrayData = [];

        /**
         * Fill Array to response
         */
        foreach ($userOffers as $userOffer) {

            $offers=[];

            /**
             * Filll offers to user
             */
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

    /**
     * Add a new offer with their asigned users
     */
    public function insertOffer() {
        /**
         * Data Validation
         */
        $validator = Validator::make(request()->all(), [
            'oferta' => 'required|string|max:100|min:6',
            'usuarios' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        /**Create a new offer */
        $offer = Joboffer::create([
            'nameOffer' => request()->input('oferta'),
            'status' => true,
        ]);

        /**Add to pivot table user-offer to relation many to many  */
        foreach (request()->input('usuarios') as $user){
            $userToOffer = User::where('email','=',$user)->first();
            User_offer::create([
                'id_user' => $userToOffer->id,
                'id_offer' => $offer->id,
            ]);
        }

        return response()->json([
            'message' => 'Offer created',
            'offer' => $offer
        ], Response::HTTP_OK);
    }

}
