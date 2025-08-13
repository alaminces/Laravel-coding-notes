১. Blade টেমপ্লেটে এরর মেসেজ দেখানো
Laravel স্বয়ংক্রিয়ভাবে $errors ভ্যারিয়েবল Blade-এ পাঠায়।

নির্দিষ্ট ফিল্ডের এরর দেখাতে পারো @error ডিরেক্টিভ দিয়ে।

<form action="{{ route('user.store') }}" method="POST">
    @csrf

    <label>নাম:</label>
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name')
        <div style="color:red">{{ $message }}</div>
    @enderror

    <label>ইমেইল:</label>
    <input type="email" name="email" value="{{ old('email') }}">
    @error('email')
        <div style="color:red">{{ $message }}</div>
    @enderror

    <button type="submit">সাবমিট</button>
</form>


old('name') ব্যবহার করে পূর্বের ইনপুট ফিরিয়ে আনা হয়, যাতে ফর্ম আবার পূরণ করতে না হয়।

২. একাধিক এরর একসাথে দেখানো
সব এরর একসাথে দেখাতে পারো any() ও all() ব্যবহার করে।

@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


এটা সাধারণত ফর্মের উপরের দিকে দেখানো হয়।


৩. Redirect with old input এবং errors
Controller-এ $request->validate() ব্যর্থ হলে Laravel স্বয়ংক্রিয়ভাবে previous page-এ redirect করে এবং errors + old input পাঠায়।
<?php
use Illuminate\Http\Request;
function store(Request $request)
{
    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    // যদি ভ্যালিডেশন পাস করে
    // ডেটা সেভ করা
    // User::create($request->all());

    return redirect()->back()->with('success', 'ব্যবহারকারী সফলভাবে যোগ হয়েছে!');
}
?>
ভ্যালিডেশন ফেইল করলে স্বয়ংক্রিয়ভাবে:

পূর্বের ইনপুট ফিরে আসে (old('field'))

এরর মেসেজ $errors-এ থাকে