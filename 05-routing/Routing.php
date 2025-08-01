
=============================Laravel Route কি?=============================

সাধারণত ইংরেজি শব্দ route যাকে অনেক সময় আমরা বাংলায় বলি রুট যার অর্থ দাঁড়ায় গন্তব্যস্থলে পৌঁছানোর রাস্তা। আর Laravel Application এ route হচ্ছে URL থেকে request গ্রহণ করে এবং application কে resource এর জন্য নির্দেশনা প্রদান করে। আরো সহজ ভাবে বলা যায় route হল আপনার অ্যাপ্লিকেশনের একটি request এর বিপরীতে কোন URL টি hit হবে? বা কোথায় থেকে কি response করবে তা নির্ধারণের একটি উপায়। Laravel এ সব route গুলো routes ফোল্ডারে তৈরী করা থাকে। এর মধ্যে web application এর route সমূহ routes/web.php তে লিখা হয়। এবং API এর জন্য route সমূহ routes/api.php তে লিখা হয়। Laravel Framework এ route এর সবচেয়ে বড় সুবিধা হচ্ছে আপনি এক যায়গা থেকেই সমস্ত route কে নিয়ন্ত্রণ করতে পারবেন অর্থাৎ পরবর্তিতে route সম্পর্কিত যেকোনো ধরনের পরিবর্তন এখান থেকেই করতে পারবেন।



=============================About Route Start=============================
# Route => Facade Class 
# :: => Scope Resolution Operator 
# get() => HTTP GET Method
# function() => Anonymous Function
# return "welcome"; => Response
# view('welcome'); => Return View
# {name} => Route Parameter
# {name?} => Optional Route Parameter

✅ HTTP Verbs Supported:
# Route::get() → For reading
# Route::post() → For submitting form
# Route::put() → For updating data
# Route::delete() → For deleting data
# Route::patch() → For partial updates
# Route::options() → For CORS requests


=============================About Route End=============================

=============================Routing Start=============================
<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

// ✅ Basic Route:
Route::get('/', function () {
    return view('welcome');
});

// ✅ Route with Parameter:
Route::get('/user/{name}', function($name) {
    return "User name is $name";
});

// ✅ Optional Parameters:
Route::get('/user/{name?}', function(?string $name = 'user') {
    return "User name is $name";
});

// ✅ Route Naming:
Route::get('/profile', function() {
    return "Route name is profile";
})->name('profile');

// ✅ Named Route Usage:
// <a href="{{ route('profile') }}">Profile</a>

// ✅ Redirect Route
Route::get('/dashboard', function() {
    return "Welcome to the dashboard";
});

Route::redirect('/home', '/dashboard');

// ✅ Dependency Injection 
Route::get('/ip', function (Request $request) {
    return $request->ip();
});


// ✅ Route to Controller Method:
Route::get('/home-page', [HomeController::class,'index']);

// ✅ Route Grouping:
Route::prefix('admin')->group(function() {
    Route::get('/login', function() {
        return "admin login";
    });

    Route::get('/profile', function() {
        return "admin profile";
    });

    Route::get('/logout', function() {
        return 'admin logout';
    });
});

// ✅ Middleware with Route:
Route::get('/dashboard', function() {
    return "welcome to dashboard";
})->middleware(['auth']);


// ✅ Route Model Binding (Implicit):
Route::get('/user/{user}', function(App\Models\User $user) {
    return $user;
});
Route::get('/user/{user}', function(User $user) {
    return $user;
});

// ✅ Custom Middleware in Route:
Route::middleware(['auth','isAdmin'])->group(function() {
    Route::get('/admin', function() {
        return "Admin";
    });
});



// ✅ API Routes (routes/api.php)
Route::get('/api/user', function() {
    return response()->json(['name' => 'John Doe']);
});

// ✅ Fallback Route (404):
Route::fallback( function() {
    return "Not found! 404";
});
// ✅ Fallback Route with Custom 404 Page:
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// ✅ Route Caching (Performance Boost):
/* 
    php artisan route:cache
    php artisan route:clear
*/


// ✅ Redirecte Default
Route::get('/dashboard', function() {
    return "Welcome to the dashboard";
})->name('dashboard');

// ✅ Redirect Default
Route::redirect('/home', '/dashboard');

// ✅ Redirect with Status Code
Route::redirect('/home', '/dashboard', 301);
Route::permanentRedirect('/here', '/there');

// Redirect with Controller Method
return redirect('/dashboard');

// Redirect with Named Route
return redirect()->route('dashboard');

// Redirect with URL
return redirect()->to('/dashboard');

// Redirect with Flash Data
return redirect('/dashboard')->with('message', 'Welcome to the dashboard');

Route::get('/dashbaord', function() {
    return session('message', 'No message set');
});


// Redirect to Previous Page
return redirect()->back();





/**
 * Route::redirect('/home', '/dashboard', 301);
 * This will redirect the '/home' URL to '/dashboard' with a 301 Moved Permanently status code.
 * 301 status code indicates that the resource has been permanently moved to a new URL.
 * This is useful for SEO purposes and ensures that search engines update their links accordingly.
 * You can also use other status codes like 302 (Default) (Temporary Redirect) based on your requirements.
 * 302 = Temporary redirect (default)
 * 301 = Permanent redirect (SEO friendly)
 */


?>
=============================Routing End=============================


===========================Dependency Injection (DI)===========================
Dependency Injection মানে হলো —
👉 একটি ক্লাসের দরকারি জিনিস (অর্থাৎ অন্য ক্লাস বা অবজেক্ট) বাইরে থেকে অটোভাবে দিয়ে দেওয়া, যাতে তোমার কোড পরিষ্কার ও সহজ হয়।

👉 Dependency Injection হলো সেই দ্বিতীয় পদ্ধতি — যেখানে Laravel ক্লাসের দরকারি জিনিস (dependency) নিজে থেকেই ইনজেক্ট করে দেয়।

🔹 Laravel এ Dependency Injection কিভাবে কাজ করে?
Laravel এর Service Container অটোমেটিক এই কাজ করে দেয়।

<?php 
// use Illuminate\Http\Request;

Route::get('/ip', function (Request $request) {
    return $request->ip();
});

?>

🔹 Dependency Injection কেন দরকার?
✅ ক্লাস গুলো আলাদা রাখা যায় (Loose Coupling)
✅ কোড clean, flexible ও testable হয়
✅ Service Container Laravel এ ইনজেকশন সহজ করে দেয়


================View Routes================
<?php 
Route::view('/welcome', 'welcome');
Route::view('/welcome', 'welcome', ['name' => 'Taylor']);
?>


================Listing Your Routes================
php artisan route:list
php artisan route:list --path=api
php artisan route:list --except-vendor
php artisan route:list --only-vendor


================Regular Expression Constraints (Parameter validation)================
<?php 
Route::get('/user/{id}', function ($id) {
    return "User ID is $id";
})->where('id', '[0-9]+'); // Only accepts numeric IDs

Route::get('/user/{name}', function ($name) {
    return "User name is $name";
})->where('name', '[A-Za-z]+'); // Only accepts alphabetic names

Route::get('/user/{id}/{name}', function ($id, $name) {
    return "User ID is $id and name is $name";
})->where(['id' => '[0-9]+', 'name' => '[A-Za-z]+']); // Multiple constraints

Route::get('/product/{id}', function ($id) {
    return "Product ID is $id";
})->whereNumber('id'); // Only accepts numeric IDs

Route::get('/category/{slug}', function ($slug) {
    return "Category slug is $slug";
})->whereAlpha('slug'); // Only accepts alphabetic slugs

Route::get('/post/{id}', function ($id) {
    return "Post ID is $id";
})->whereAlphaNumeric('id'); // Only accepts alphanumeric IDs


Route::get('/category/{category}', function($category) {
    return $category;
})->whereIn('category',['electronics','furniture','clothing','books']);
// Note: This will only match the specified categories


?>

================Global Constraints================

 * Global Constraints হলো Laravel-এ এমন একটা ফিচার, যেখানে তুমি একবারই বলে দাও কোনো রুট প্যারামিটার যেমন {id}, {slug}— কেমন ধরনের হবে (যেমন: সংখ্যার হবে, অক্ষরের হবে ইত্যাদি)।
    * এর ফলে, তুমি যখনই ওই প্যারামিটার ব্যবহার করবে, Laravel নিজে থেকেই সেই নিয়মগুলো প্রয়োগ করবে।
    * কোথায় লিখবো?
        1. RouteServiceProvider.php ফাইলে
        2. app/Providers/RouteServiceProvider.php
        3. boot() মেথডের ভিতরে
<?php

Route::get('/user/{id}', function($id) {
    return "User ID is $id";
});

Route::get('/category/{slug}', function($slug) {
    return "Category slug is $slug";
});

# Global Constraints in AppServiceProvider.php
    public function boot(): void
    {
        //global constraints
        Route::pattern('id', '[0-9]+');
        Route::pattern('slug', '[a-z0-9-]+');
    }
?>



================Encoded Forward Slashes================
<?php
Route::get('/search/{search}', function (string $search) {
    return $search;
})->where('search','.*');
// Note: This route will match any search term including slashes

// Input: http://127.0.0.1:8000/search/rakib/hasan
// Output: rakib/hasan

?>


================Route URL Generate================

<a href="{{ route('profile','alamin58') }}">Profile</a>
<a href="{{ route('profile',['username' => 'alamin58']) }}">Profile</a>

<?php
Route::get('/profile/{username}', function($username) {
    return "Profile Username is $username";
})->name('profile');
// Note: This route will generate a URL like /profile/alamin58

// Redirect Route with passing parameters
Route::get('/profile/{username}', function($username) {
    return "Profile Username is $username";
})->name('profile');

Route::get('/my-profile', function() {
    // return redirect()->route('profile', ['username' => 'alamin58']);
    return to_route('profile', ['username' => 'alamin58']);
});
?>

================Inspecting the Current Route================
<?php

Route::get('/profile', function(Request $request) {
    if( $request->route()->named('profile') ) {
        return "Profile route is active";
    }
    return "Profile route is active";
})->name('profile');
?>
================Route Name Prefixes================
<?php
Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
});

Route::prefix('user')
    ->as('user.')
    ->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
});
?>
Note: php artisan route:list --path=admin

================outes================
================outes================
================outes================
================outes================