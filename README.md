# sparkle

[!["Buy Me A Coffee"](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png)](https://www.buymeacoffee.com/loftytech)


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


Sparkle was designed to for REST api development but also supports basic views templating.

To create a new web page, go to the `views` directory and create a new file.
Then in the `routes/web.php`, add a new route like so:

```
Route::get('/some-route', function() {
	View::make("ViewName");
});

```

Inject data into your views by added an associative array of key value pairs as the second argument like so:
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


```
<?php
namespace App\Controllers;

use App\Controllers\Controller;

class UserController extends Controller {

}
?>
```