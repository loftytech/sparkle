<?php
namespace App\Middlewares;

use App\Framework\Utilities\JwtUtility;
use App\Framework\Utilities\Response;
use App\Framework\Utilities\Request;

class Authentication {
    public static function check (Request $request) {
        $req_data = file_get_contents('php://input');
        $req_data = json_decode($req_data);

        if (!isset(apache_request_headers()['Authorization'])) {
            $response = array(
                'message'=>'Unauthorized user',
                'status'=>2
            );

            return Response::send($response, 401);
        }

        if (count(explode(' ', apache_request_headers()['Authorization'])) <= 1) {
            $response = array(
                'message'=>'Could not find the token',
                'status'=>2,
            );

            return Response::send($response, 401);
        }

        $req_token = explode(' ', apache_request_headers()['Authorization'])[1];

        if (JwtUtility::validate_token($req_token)) {
            $user_id = JwtUtility::getUserDetails($req_token)->user_id;
        
            $request->setExtras(['user_id'=> $user_id]);
            return $request;
        } else {
            $response = array(
                'message'=>'Unauthorized user',
                'status'=>2
            );
            return Response::send($response, 401);
        }

    }   
}

?>