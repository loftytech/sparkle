<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Framework\Utilities\Response;
use App\Framework\Utilities\JwtUtility;
use App\Framework\Utilities\Request;
use App\Models\UserModel;

class AuthController extends Controller {
    public function signup(Request $request) {
		$req_data = $request->body;

		$firstname = isset($req_data->firstname) ? trim($req_data->firstname) : "";
		$lastname = isset($req_data->lastname) ? trim($req_data->lastname) : "";
		$password = isset($req_data->password) ? $req_data->password : "";
		$username = isset($req_data->username) ? trim(strtolower($req_data->username)) : "";
		$email = isset($req_data->email) ? strtolower(trim($req_data->email)) : "";


		if (strlen($firstname) >= 3 && strlen($firstname) < 32) {
			if (strlen($lastname) >= 3 && strlen($lastname) < 32) {
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$user = new UserModel();
					if (!$user->where('email', $email)->get()) {
						$user->create([
							'id'=>null,
							'username'=>$username,
							'firstname'=>$firstname,
							'lastname'=>$lastname,
							'email'=>$email,
							'password'=>password_hash($password, PASSWORD_BCRYPT),
						]);

						$newUser = $user->where('email', $email)->first();

						$user_id = $newUser->id;
						$user_data = array('email'=>$email, 'user_id'=>$user_id, 'exp'=>(time() + 86400));
                		$auth_token = JwtUtility::get_token($user_data);
						Response::send(array(
							'message'=>'user registered successfully',
							'status'=>1,
							'data'=> [
								'token'=>$auth_token
							]
						), 200);
					} else {
						Response::send(array(
							'message'=>'Email already registered!',
							'status'=>0
						), 400);
					}
				} else {
					Response::send(array(
						'message'=>'Invalid email!',
						'status'=>0
					), 400);
				}
			} else {
                Response::send(array(
					'message'=>'Invalid lastname character length',
					'status'=>0
				), 400);
			}
		}else {
            Response::send(array(
				'message'=>'Invalid firstname character length',
				'status'=>0
			), 400);
		}
    }
    
    public static function login(Request $request) {
		$req_data = $request->body;

		$email = isset($req_data->email) ? strtolower($req_data->email) : "";
		$password = isset($req_data->password) ? $req_data->password : "";

		$user = new UserModel();
        if ($user->where('email', $email)->first()) {
            if (password_verify($password, $user->where('email', $email)->first()->password)) {
                $user = $user->where('email', $email)->first();
                $user_data = array('email'=>$email, 'user_id'=>$user->id, 'exp'=>(time() + 86400));
                $auth_token = JwtUtility::get_token($user_data);

                Response::send(array(
                    'message'=>'user logged in successfully',
                    'status'=>1,
                    'data'=> [
                        'token'=>$auth_token,
						'firstName'=>$user->firstname,
						'lastName'=>$user->lastname,
						'email'=>$user->email,
                    ]
                    ), 200);
            } else {
                Response::send(array(
                    'message'=>'Invalid email or password',
                    'status'=>0
                ), 400);
            }
        } else {
            Response::send(array(
                'message'=>'Invalid email or password',
                'status'=>0
            ), 400);
        }
    }


    public static function getProfile(Request $request) {
		$req_data = $request->body;

		$user = new UserModel();
		
		Response::send(array(
			'message'=>'profile fetched successfully',
			'status'=>1,
			'data'=> $user->findById($request->extras->user_id)
		), 200);
    }
}