Laravel-এ Requests Chapter মূলত HTTP request-এর data handle করার নিয়ম নিয়ে কাজ করে।
এখানে Laravel-এ request মানে হলো — যখন কোনো user ব্রাউজার থেকে form submit করে, URL hit করে, অথবা AJAX call দেয় — তখন সেই ডেটা আমাদের Laravel অ্যাপ্লিকেশনে পাঠানো হয়। এই data নিয়ে কাজ করার জন্য Laravel-এ Illuminate\Http\Request class ব্যবহার করা হয়।

1️⃣ Request Object
Laravel-এ Illuminate\Http\Request class request data handle করে।
আমরা controller method বা route-এর parameter-এ এটি inject করতে পারি।

<?php 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->all();
});

?>

2️⃣ Request থেকে ডেটা নেওয়ার পদ্ধতি
Laravel-এ request data নেওয়ার জন্য কয়েকটি method আছে —

<?php 
# (i) সব ডেটা নেওয়া
$request->all();

#(ii) নির্দিষ্ট ইনপুট নেওয়া
$request->input('name');

#(iii) ডিফল্ট ভ্যালু সহ ইনপুট
$request->input('name', 'Guest');

#(iv) query string থেকে নেওয়া
$request->query('page');

#(v) কেবল নির্দিষ্ট key গুলো নেওয়া
$request->only(['name', 'email']);

#(vi) নির্দিষ্ট key বাদ দিয়ে সব নেওয়া
$request->except(['password']);

# Request Method চেক করা
$request->method(); // GET, POST
$request->isMethod('post'); // true / false

?>

4️⃣ URL ও Path সম্পর্কিত মেথড
<?php 
$request->url(); // মূল URL
$request->fullUrl(); // query সহ পুরো URL
$request->path(); // URL path
$request->is('admin/*'); // pattern match
?>

5️⃣ File Upload চেক করা
<?php 
if ($request->hasFile('photo')) {
    $file = $request->file('photo');
    $file->store('uploads');
}
?>

6️⃣ Request Validation
<?php 
$request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email',
]);
?>

7️⃣ Helper Function দিয়ে Request
Laravel-এ request() helper ব্যবহার করা যায় —
<?php 
$name = request('name');
?>

📌 সংক্ষেপে, Laravel Request Chapter আপনাকে শেখাবে:
**Request object কীভাবে কাজ করে
**Input data পড়া ও ম্যানেজ করা
**URL, Method, Path চেক করা
**File upload হ্যান্ডেল করা
**Validation করা
**Request helper ব্যবহার করা


##############################################################################
Laravel-এ Request আর Response — এই দুইটা জিনিস HTTP Communication-এর দুই দিক।

Response মানে হলো — server থেকে user-এর কাছে data পাঠানো।
Laravel-এ response তৈরি করতে Illuminate\Http\Response বা helper method ব্যবহার করা হয়।

<?php 
#Basic Response
Route::get('/hello', function () {
    return "Hello World";
});

#JSON Response
return response()->json([
    'name' => 'Alamin',
    'role' => 'Developer'
]);

#Custom Status Code
return response("Not Found", 404);

#Redirect Response
return redirect('/home');

#File Download Response
return response()->download(public_path('file.pdf'));

# File Download with example
$path = public_path('uploads/bg-image.jpg');

if (!file_exists($path)) {
    abort(404, 'File not found.');
}

$headers = [
    'Content-Type' => 'application/jpg'
];

return response()->download($path,'nature.jpg',$headers);



#Cookie সহ Response
return response('Hello')->cookie('name', 'Alamin', 60);


?>

📌 সংক্ষেপে

Request → User → Server এ data পাঠায়। (form data, URL, file ইত্যাদি)

Response → Server → User-এ data ফেরত পাঠায়। (HTML, JSON, redirect, file ইত্যাদি)


