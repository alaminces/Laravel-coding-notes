Flash Messages in Laravel

Laravel-এ Flash Messages হলো session এ স্টোর করা temporary data, যা একবার দেখানোর পর স্বয়ংক্রিয়ভাবে মুছে যায়।
এগুলো সাধারণত success, error, warning, info মেসেজ দেখাতে ব্যবহৃত হয়।


1. Flash Message তৈরি করা
<?php 
// Controller এ
return redirect()->route('home')->with('success', 'Profile updated successfully!');
?>
এখানে:
    'success' = session key
    'Profile updated successfully!' = message


2. Multiple Flash Messages
<?php 
return redirect()->back()
    ->with('success', 'Data saved successfully!')
    ->with('warning', 'Please verify your email.');
?>


3. Blade এ Flash Message দেখানো
@if(session('success'))
    <div class="bg-green-500 text-white p-3 mb-3 rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-500 text-white p-3 mb-3 rounded">
        {{ session('error') }}
    </div>
@endif

@if(session('warning'))
    <div class="bg-yellow-500 text-black p-3 mb-3 rounded">
        {{ session('warning') }}
    </div>
@endif

@if(session('info'))
    <div class="bg-blue-500 text-white p-3 mb-3 rounded">
        {{ session('info') }}
    </div>
@endif


4. Dynamic Flash Message Component

বারবার HTML না লিখে Blade Component বানানো যায়।

resources/views/components/flash.blade.php

@if(session()->has($type))
    <div class="p-3 rounded mb-3 
        @if($type === 'success') bg-green-500 text-white 
        @elseif($type === 'error') bg-red-500 text-white 
        @elseif($type === 'warning') bg-yellow-500 text-black 
        @elseif($type === 'info') bg-blue-500 text-white 
        @endif">
        {{ session($type) }}
    </div>
@endif


Blade এ ব্যবহার
<x-flash type="success" />
<x-flash type="error" />
<x-flash type="warning" />
<x-flash type="info" />


5. Validation Error এর সাথে Flash Messages
<?php 
$request->validate([
    'name' => 'required',
]);

return redirect()->back()->with('error', 'Please fill all required fields!');
?>

6. Auto Hide Flash Message (JavaScript দিয়ে)
@if(session('success'))
    <div id="flash-message" class="bg-green-500 text-white p-3 mb-3 rounded">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('flash-message').style.display = 'none';
        }, 3000);
    </script>
@endif

এতে ৩ সেকেন্ড পরে মেসেজ অটো-হাইড হবে।