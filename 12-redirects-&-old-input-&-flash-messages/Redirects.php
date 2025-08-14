Laravel-এ Redirects ব্যবহার হয় ইউজারকে অন্য কোনো পেজে পাঠানোর জন্য

1. Basic Redirect
<?php 
// সরাসরি কোনো URL এ রিডাইরেক্ট
return redirect('/dashboard');

// Helper দিয়ে
return redirect()->to('/dashboard');
?>

2. Redirect to Named Route
<?php 
// Named Route এ redirect
return redirect()->route('profile');

// Parameter সহ
return redirect()->route('profile.show', ['id' => 5]);

?>

3. Redirect to Controller Action
<?php 
// return redirect()->action([HomeController::class, 'index']);
// does not work
?>

4. Redirect Back
<?php 
// আগের পেজে ফেরত পাঠানো
return back();

// Old input সহ
return back()->withInput();
?>

5. Redirect with Flash Data
<?php 
return redirect()->route('dashboard')->with('success', 'Logged in successfully!');
?>
Blade এ দেখাতে:
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif


6. Redirect with Error Messages
<?php 
return redirect()->back()->withErrors([
    'email' => 'This email is already taken.',
]);
?>

Blade এ:
@error('email')
    <div class="text-red-500">{{ $message }}</div>
@enderror


7. Redirect with Success/Info/Warning Messages
<?php 
return redirect()->route('home')->with('info', 'Your profile has been updated!');
?>


