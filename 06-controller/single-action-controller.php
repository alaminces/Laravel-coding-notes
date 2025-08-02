
1. What is Single Action Controller?
`````````````````````````````````````
Single Action Controller মানে একটি Controller ক্লাসে শুধু একটি method থাকে, যেটার নাম হয় __invoke()।

2. Why use Single Action Controller?
`````````````````````````````````````
> ছোট কাজের জন্য (যেমন: একটি email পাঠানো, একটা page দেখানো)
> Clean ও Simple code structure
> শুধু একটাই কাজ করার দরকার হলে


3. Create Single Action Controller
`````````````````````````````````````
php artisan make:controller ContactController --invokable


// Single Action Controller Route
<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ContactController;
    Route::get('/contact', ContactController::class)->name('contact');
?>

// ContactController.php
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ContactController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $contact = [
            'name' => 'Alamin Miah',
            'email' => '',
            'phone' => '01307354958',
            'address' => 'Chandrakhana, Fulbari, Kurigram'
        ];
        return response()->json($contact);
    }
}
