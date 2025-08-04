১. Using view() with array (Most common)
<?php 
return view('welcome', ['name' => 'Alamin', 'age' => 25]);
?>
'welcome' হচ্ছে view ফাইলের নাম (resources/views/welcome.blade.php)

দ্বিতীয় প্যারামিটার হিসেবে অ্যাসোসিয়েটিভ অ্যারে পাস করা হয় যেখানে key হচ্ছে ভ্যারিয়েবল নাম আর value হচ্ছে তার মান।

২. Using with() method
<?php
return view('welcome')->with('name', 'Alamin');
?>
with() method দিয়ে একটি key-value পেয়ার পাস করা হয়।

একাধিক with() কল করা যায়:
<?php
return view('welcome')->with('name', 'Alamin')->with('age', 25);
?>

৩. Using compact() function
<?php
$name = 'Alamin';
$age = 25;
return view('welcome', compact('name', 'age'));
?>
PHP এর compact() ফাংশন ভ্যারিয়েবল নাম থেকে অ্যারে তৈরি করে।

সহজ ও পরিষ্কার কোড লেখার জন্য ভালো।

৪. Passing Data from Controller to View
<?php
public function index() {
    $users = User::all();
    return view('users.index', compact('users'));
}
?>

৫. Sharing Data Globally to All Views (Optional)
<?php
use Illuminate\Support\Facades\View;
// AppServiceProvider.php এর boot() মেথডে
View::share('appName', 'My Laravel App');
?>
এরপর সব ভিউতে $appName ব্যবহার করা যাবে।




একাধিক ডাটা পাস করার জন্য with() এর ব্যবহার
১. একাধিক with() method চেইন করা
<?php
return view('welcome')
    ->with('name', 'Alamin')
    ->with('age', 25)
    ->with('city', 'Kurigram');
?>
একাধিক with() কল একসাথে ব্যবহার করা যায়।

প্রতিটা with() আলাদা key-value পাস করে।

২. একবারে অ্যারে পাস করে with() ব্যবহার করা (Laravel 5.5+)
<?php
return view('welcome')->with([
    'name' => 'Alamin',
    'age' => 25,
    'city' => 'Kurigram',
]);
?>
একবারে অ্যারে পাস করলে সব ডাটা পাস হয়ে যায়।

এইটা অনেক বেশি পরিচ্ছন্ন এবং সহজ।

৩. বিকল্প পদ্ধতি (compact() বা array ব্যবহার)
<?php 
$name = 'Alamin';
$age = 25;
$city = 'Kurigram';

return view('welcome')->with(compact('name', 'age', 'city'));
?>
compact() প্যারামিটার হিসেবে ভ্যারিয়েবল নাম নেয়।

with() এর ভিতর compact() ব্যবহার করলে সব ডাটা পাস হয়।