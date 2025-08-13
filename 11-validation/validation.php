Laravel Validation কি?
Laravel Validation হলো একটা সিস্টেম যেটা দিয়ে আপনি আপনার ফর্ম বা ইনপুট ডেটার সঠিকতা চেক করতে পারেন। অর্থাৎ, ইউজার কি ভুল ডেটা দিয়েছে সেটা ধরে ফেলা এবং ভুল থাকলে ইউজারকে এরর দেখানো।

** required — ফিল্ড ফাঁকা হতে পারবে না
** string — অবশ্যই string হতে হবে
** max:255 — সর্বোচ্চ ২৫৫ ক্যারেক্টার হতে পারবে
** email — অবশ্যই সঠিক ইমেইল ফরম্যাট হতে হবে
** unique:users,email — ডাটাবেজের users টেবিলের email কলামে ডুপ্লিকেট চলবে না
** confirmed — password_confirmation ইনপুটের সাথে মিল থাকতে হবে

১. Controller এ Validation করা (Basic Example)
<?php
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);
?>

২. Custom Error Message দেওয়া
<?php 
    $request->validate([
        'name' => 'required',
    ], [
        'name.required' => 'আপনার নাম লিখতে হবে!',
    ]);
?>

৩. Form Request ক্লাস ব্যবহার করা
php artisan make:request StoreUserRequest

app/Http/Requests/StoreUserRequest.php ফাইলে:
<?php
public function rules()
{
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];
}

public function authorize()
{
    return true;
}

# Controller
public function store(StoreUserRequest $request)
{
    // ভ্যালিডেটেড ডেটা পাওয়া যাবে $request->validated()
}

?>