# sparkle

## Introduction

Sparkle is a free to use open source php MVC framework for building web applications. It's very simple to work with and has a very low learning curve.

Getting started with sparkle is very easy. All you need to do is have `php version >= 8` installed on you computer. Once you have that done, pull from the main branch of this repository.

To start the server, in the root directory of the project, run this command:
```
php star light
```
This would start the php dev server on port 8000 and load the environment variables in the `.env` file if you have one.


In production, you can load the environment variables using this command:
```
php star configure
```

Sparkle is built to be light weight and relable so it doesn't come with any third party packages but you can extend sparkle by installing third party packages via composer.


## Views
Sparkle was designed for REST api development but also supports basic view templating.

To create a new web page, go to the `views` directory and create a new file.
Then in the `routes/web.php`, add a new route like so:

```
Route::get('/some-route', function() {
	View::make("ViewName");
});

```

Inject data into your views by adding an associative array of key value pairs as the second argument like so:
```
Route::get('/some-route', function() {
    View::make("ViewName", ['site_title'=>env('APP_NAME')]);
});
```

use the variable in your view file using double curly brackets like so:
```
<h1>{{ site_title }}</h1>
```

>You could aslo use a controller to handle view rendering

create a controller by going to the `app/Controllers` directory and creating a new file with a class extending the base controller.

## Controllers
```
<?php
namespace App\Controllers;

use App\Controllers\Controller;

class UserController extends Controller {

}
?>
```

## Models
Now lets create a model for our user controller. You can do this by going to the `app/Models` directory and create a file, let's say `UserModel.php`

now add this snippet:

```
<?php
namespace App\Models;

use App\Framework\Model\BaseModel;
use App\Framework\Schema\Schema;

class UserModel extends BaseModel {
    protected static $tableName = 'users';


    public static function table() {
        $schema = new Schema(self::$tableName);
        $schema->id();
        $schema->string('username');
        $schema->string('firstname');
        $schema->string('password');
        $schema->string('email');
        $schema->string('lastname');
        $schema->create();
    }
}

?>
```
>The name of the table in this model is `users` as defined here `protected static $tableName = 'users'`
>Note that timestamps `date_created` and `date_updated` are added by default to entries to each table;
>You do not need to create extra migration files after creating your models just run the migrate command and you're good to go!

your user model should look like this:

![User model](https://drive.google.com/uc?export=view&id=1K1oVeIN37yKoAflu5zyoCJeqglzdgArw)

## Setting up the database

Now that we have our model set up, we need to make sure our connection to the database is done.
let's configure our environment variables by copying all the contents of `.env.example.php` in the root directory into a new file in the root directory `.env`

Now create a new database with your desired credentials. You can create a database using a gui like phpmyadmin which comes with xampp or via the mysql cli.
>Once that is done, make sure you start the mysql server.


Now edit the values of the .env files with the database credentials you just created. In this tutorial, we're on local host so the `MYSQL_HOST` is `127.0.0.1:3306`
>3306 is the default mysql port
or database name is `sparkle` and our username is `root` the password is blank but you should use your desired credentials.

```
DB_CONNECTION=pdo
MYSQL_HOST=127.0.0.1:3306
MYSQL_DB=sparkle
MYSQL_USERNAME=root
MYSQL_PASSWORD=
```

now that we have our credentials set up, reload the application configuration by running this command:
```
php star configure
```

Now let's migrate our UserModel by running this command:
```
php star migrate
```

A new table with the name users has been created in the database

you can add new columns to your table if you want to or edit existing columns.
>after changes to your model, you need to run `php star migrate` for your changes to effect

## Handling requests

In this example, we're going to be working with api.
To handle requests, we create methods to our controllers and receive data view the `$request` object parameter like so:
```
public function doSomething(Request $request) {
    $req_body = $request->body;
    $req_query = $request->query;
    $req_params = $request->params;
    $req_extras = $request->extras;
}
```
The request object carries the body, query, params and extras properties added to the request.

Now let's create a method to add users and fetch users. In your UserController, add this snippet:

```
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
```

Your controller should look like this:

![User controller](https://drive.google.com/uc?export=view&id=1egczTEr-duBKQsUmefgNebMdPYiyqgcn)

The above snippets creates a new user by creating a new instance of the UserModel and calling the create method like so:

```
$user = new UserModel();

$user->create([
    'id'=>null,
    'username'=>$username,
    'firstname'=>$firstname,
    'lastname'=>$lastname,
    'email'=>$email,
    'password'=>password_hash($password, PASSWORD_BCRYPT),
]);
```

>kindly note that the values in the request body are gotten from the request made to this endpoint.

Now lets bind an endpoint to this route. In the `routes/api.php`, add this:
```
Route::post('/users/add', [App\Controllers\UserController::class, 'addUser']);
Route::get('/users/fetch', [App\Controllers\UserController::class, 'getUsers']);
```

you can also bind your routes like this:

```
use App\Controllers\UserController;

Route::post('/users/get', function($request) {
	$userController = new UserController();
	UserController->getUsers($request);
});

```
> note that we imported the UserController using this `use App\Controllers\UserController;`.


We also fetch all users in the table using this snippet:

```
$user = new UserModel();
$all_users = $user->all();
```


Other methods for working with models are:
```
Model::insertMany()

$model->findById()

$model->where('balance', 100)->get()
$model->where('email', "examle@gmail.com")->first()

```

To update your entries in the table, we do it like this:

```
$model = new Model();
$model->where('email', "examle@gmail.com")->and("first_name", "james")->update("lastname", "felix");
```
This evaluates to `UPDATE model SET lastname=felix WHERE email="example@gmail.com AND first_name = "james"`


Request parameters are like variables and can be added to endpoints like so:

```
Route::post('/profile/fetch/:id', [App\Controllers\Authentication::class, 'getProfile']);
```

Where `:id` is a request parameter and can be accessed via the request object like so:
```
$request->params->id
```

## Middlewares
Middlewares are found in the `app/Middlewares` directory and you can create your middlewares there.
Sparkle comes with an Authentication middleware for checking generated tokens generated via the `AuthController`;
Middlewares are basically methods of classes that intercept the request before getting to where the request is handled:

this is an example:
```
Route::get('/v1/profile', [App\Middlewares\Authentication::class, 'check'], [App\Controllers\AuthController::class, 'getProfile']);
```

`[App\Middlewares\Authentication::class, 'check']` is the middleware that runs before the method that handles the request

The default Authentication middleware validates the token set in the header of the incoming request and sets the user_id property to the request like so:

```
$request->setExtras(['user_id'=> 45]);
```

>note that middlewares must return the request object for the request to continue to the next handler

This is an image of Authentication middleware:


![Authentication middleware](https://drive.google.com/uc?export=view&id=1Z_O4DcPDWThYRldc7WpQ6N8WEbkimmux)


## Api request

Sparkle comes with a utility class for sending and listening to api requests.
Create a request by importing the HttpRequest utility to your controller like so:

```
use App\Framework\Utilities\HttpRequest;

class MyController extends Controller {
	public function doSomething($request) {
		$res = HttpRequest::post("api.example.com/post", [
			"foo"=>"bar"
		]);

		$res->status_code; // gets http response code
		$res->data; // gets the data returned
	}
}

```

You can also add headers to your requests by chaining the withHeaders method passing an associative array as an arguments like so:

```
use App\Framework\Utilities\HttpRequest;

class MyController extends Controller {
	public function doSomething($request) {
		$headers = [
            'Content-Type'=> 'application/json',
            'Accept'=> 'application/json'
        ];

		$res = HttpRequest::withHeaders($headers)::post("api.example.com/post", [
			"foo"=>"bar"
		]);

		$res->status_code; // gets http response code
		$res->data; // gets the data returned
	}
}

```

>do not pass data to get requests

HttpRequest has the following methods for sending requests:

```
HttpRequest::withHeaders($headers)::patch("api.example.com/post", []);
HttpRequest::withHeaders($headers)::put("api.example.com/post", []);
HttpRequest::withHeaders($headers)::post("api.example.com/post", []);
HttpRequest::withHeaders($headers)::delete("api.example.com/post", []);
HttpRequest::withHeaders($headers)::get("api.example.com/post");

```


## Author's note
More features are been added to the framework. you can support me by buying me a coffee
[!["Buy Me A Coffee"](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png)](https://www.buymeacoffee.com/loftytech)

If you notice any bugs or you have a feature you want us to include, kindly reachout to me on [twitter](https://twitter.com/loftycodes)

thanks!