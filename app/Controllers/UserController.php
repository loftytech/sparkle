<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Framework\Utilities\Response;
use App\Framework\Utilities\Request;
use App\Models\UserModel;

class UserController extends Controller {
    public function adduser(Request $request) {
		$req_data = $request->body;

		$firstname = $req_data->firstname;
		$lastname = $req_data->lastname;
		$password = $req_data->password;
		$username = $req_data->username;
		$email = $req_data->email;

		$user = new UserModel();

		$user->create([
			'id'=>null,
			'username'=>$username,
			'firstname'=>$firstname,
			'lastname'=>$lastname,
			'email'=>$email,
			'password'=>password_hash($password, PASSWORD_BCRYPT),
		]);

		Response::send(array(
			'message'=>'Users created',
			'status'=>1
		), 400);
    }

    public static function getUsers(Request $request) {
		$user = new UserModel();

		$all_users = $user->all();
		
		Response::send(array(
			'message'=>'Users fetched successfully',
			'status'=>1,
			'data'=> $all_users
		), 200);
    }
}