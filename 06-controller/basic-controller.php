
## What is Controller?
A controller in Laravel is a class that handles incoming HTTP requests and returns responses. It acts as an intermediary between the application's models and views, allowing you to organize your application logic in a clean and maintainable way.

## Basic Controller 
To create a basic controller in Laravel, you can use the Artisan command line tool. Open your terminal and run the following command:

```bash
php artisan make:controller BasicController
```
This command will create a new controller file in the `app/Http/Controllers` directory named `BasicController.php`.


####################################################################

>> Create a Basic Controller
php artisan make:controller UserController

>> Route Definition for UserController

<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
?>


>> UserController Implementation
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display a list of users
        return view('user.index');
    }

    public function create()
    {
        // Logic to show the form for creating a new user
        return view('user.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new user
        // Validate and save the user data
        return redirect()->route('user.index');
    }

    public function show($id)
    {
        // Logic to display a specific user
        return view('user.show', compact('id'));
    }

    public function edit($id)
    {
        // Logic to show the form for editing a specific user
        return view('user.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update a specific user
        // Validate and update the user data
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        // Logic to delete a specific user
        // Perform deletion logic
        return redirect()->route('user.index');
    }
}
?>
####################################################################