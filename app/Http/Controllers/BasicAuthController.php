<?php

namespace App\Http\Controllers;

use App\Model\BasicAuth;
use Illuminate\Http\Request;


class BasicAuthController extends Controller {

    /**
     * Constructor to handle the object initialization
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function grantToken(Request $request) {
        /**
         * Validate the request and pass the request to the BasicAuth Constructor
         */
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255'
        ]);

        /**
         * Map the request and model fields
         */
        $fieldsMapper = array(
            ['email', '=', $request->input('email')],
            ['password', '=', sha1($request->input('password'))]
        );

        /**
         * Retrieve the result or throw ModelNotFoundException
         */
        $this->data_set = BasicAuth::where($fieldsMapper)->firstOrFail();

        /**
         * Return response as application/json
         */
        return response()->json($this->responseSerialize(true));
    }

}