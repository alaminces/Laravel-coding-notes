# Laravel Blade Directives

Laravel Blade directives are special syntax used in Laravel's templating engine, Blade, to simplify common tasks in views. They allow developers to write cleaner and more readable code by providing shortcuts for common operations like loops, conditionals, and includes.

##################################################################################
##################################################################################
# Output Directives
১. {{ }} — Escaped Output
কাজ:
ভ্যারিয়েবল এর মান HTML special characters কে escape করে দেখায়, অর্থাৎ HTML কোড হিসেবে না দেখিয়ে plain text হিসেবে দেখায়।
এটা সিকিউরিটি জন্য ভালো (XSS আক্রমণ থেকে রক্ষা করে)।
{{ $name }}

২. {!! !!} — Unescaped Output
কাজ:
ভ্যারিয়েবল এর মান raw HTML হিসেবে আউটপুট দেয়, অর্থাৎ ভ্যারিয়েবলে যদি HTML কোড থাকে সেটা 그대로 দেখাবে।
এটা ব্যবহারে সাবধান থাকতে হবে কারণ XSS আক্রমণের ঝুঁকি থাকে।
{!! $htmlContent !!}

৩. @json — JSON Output
কাজ:
PHP ভ্যারিয়েবলকে JSON ফরম্যাটে কনভার্ট করে JavaScript এর মধ্যে আউটপুট দেয়।
<script>
    let user = @json($user);
</script>


################################################################################
################################################################################
# Conditional Directives
১. @if
শর্ত সঠিক হলে কোড চালায়।

@if($age > 18)
    <p>Adult</p>
@endif

২. @elseif
আগের if শর্ত মিথ্যা হলে নতুন শর্ত চেক করে।
@if($age > 18)
    <p>Adult</p>
@elseif($age > 12)
    <p>Teenager</p>
@endif

৩. @else
সব শর্ত মিথ্যা হলে কোড চালায়।
@if($age > 18)
    <p>Adult</p>
@else
    <p>Minor</p>
@endif

৪. @endif
if ব্লকের শেষ।
@if($age > 18)
    <p>Adult</p>
@endif

৫. @isset
কোন ভ্যারিয়েবল সেট (defined) আছে কিনা চেক করে।
@isset($name)
    <p>Name: {{ $name }}</p>
@endisset

৬. @empty
কোন ভ্যারিয়েবল খালি বা empty কিনা চেক করে।
@empty($users)
    <p>No users found.</p>
@endempty

৭. @unless
if এর বিপরীত, অর্থাৎ শর্ত মিথ্যা হলে কোড চালায়।
@unless($user->isAdmin())
    <p>You are not admin.</p>
@endunless

৮. @switch
Switch কন্ডিশন শুরু করে।
@switch($role)

৯. @case
Switch এর একটি কেস চেক করে।
@case('admin')
    <p>Admin User</p>
    @break

১০. @break
Switch থেকে বের হতে ব্যবহার হয়।
@break

১১. @default
Switch এর ডিফল্ট কেস।
@default
    <p>Regular User</p>

১২. @endswitch
Switch কন্ডিশনের শেষ।
@endswitch





################################################################################
################################################################################
# Looping Directives
{{-- resources/views/loop_examples.blade.php --}}

@php
    $users = [
        (object)['name' => 'Alamin'],
        (object)['name' => 'Rahim'],
        (object)['name' => 'Karim'],
    ];

    $posts = [];  // খালি array forelse এর জন্য
    $count = 1;   // while loop এর জন্য
@endphp

{{-- 1. for loop --}}
@for($i = 1; $i <= 5; $i++)
    <p>Count: {{ $i }}</p>
@endfor
{{-- for loop দিয়ে নির্দিষ্ট সংখ্যক বার কোড চালানো যায় --}}

{{-- 2. foreach loop --}}
@foreach($users as $user)
    <p>User: {{ $user->name }}</p>
@endforeach
{{-- foreach দিয়ে array বা collection এর প্রতিটা আইটেমের উপর লুপ চালানো হয় --}}

{{-- 3. forelse loop --}}
@forelse($posts as $post)
    <p>{{ $post->title }}</p>
@empty
    <p>No posts found.</p>
@endforelse
{{-- forelse হচ্ছে foreach এর মত, তবে যদি array খালি হয় তাহলে empty ব্লক রান হয় --}}

{{-- 4. while loop --}}
@while($count <= 3)
    <p>Count: {{ $count }}</p>
    @php $count++; @endphp
@endwhile
{{-- while loop শর্ত সত্য থাকলে লুপ চালায় যতক্ষণ না শর্ত মিথ্যা হয় --}}

{{-- 5. $loop variable usage inside foreach --}}
@foreach($users as $user)
    <p>{{ $loop->iteration }}. {{ $user->name }}</p>

    @if($loop->first)
        <p>This is the first user.</p>
    @endif

    @if($loop->last)
        <p>This is the last user.</p>
    @endif
@endforeach
{{-- $loop ভ্যারিয়েবল foreach লুপের ভেতরে বিভিন্ন ইন্ডেক্স, প্রথম/শেষ এলিমেন্ট চেক করতে ব্যবহৃত হয় --}}

########################################################################################
########################################################################################
# Include & Extending Directives
১. @extends
কাজ:
একটি Blade ফাইল অন্য layout বা parent template থেকে extend করে। এর মাধ্যমে layout structure reuse করা যায়।
@extends('layouts.app')

২. @section & @yield
কাজ:

@section দিয়ে content define করা হয়।
@yield দিয়ে সেই content layout এ দেখানো হয়।
{{-- resources/views/layouts/app.blade.php --}}
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
    @yield('content')
</body>
</html>

এখানে @yield('title') এবং @yield('content') হলো placeholder যেখানে child view এর content আসবে।

৩. @include
কাজ:
ছোট ছোট partial view ফাইল যেখানে দরকার সেখানে include করতে।
{{-- অন্য Blade ফাইলে include করা --}}
@include('partials.navbar')

৪. @parent
কাজ:
Child view এর section এ parent section এর content রাখা।
{{-- layouts/app.blade.php --}}
@section('sidebar')
    <p>This is the master sidebar.</p>
@endsection

{{-- child.blade.php --}}
@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection
এখানে @parent দিয়ে master sidebar এর content child section এর সঙ্গে যুক্ত হয়েছে।

###############################################################################
###############################################################################
# Authentication & Authorization
১. @auth
কাজ:
যদি ইউজার লগইন করা থাকে, তখন এর ভিতরের কোড এক্সিকিউট হয়।
@auth
    <p>Welcome, {{ auth()->user()->name }}!</p>
@endauth

২. @guest
কাজ:
যদি ইউজার লগইন না করা থাকে (অর্থাৎ guest), তখন এর ভিতরের কোড রান হয়।
@guest
    <p>Please <a href="/login">login</a> to continue.</p>
@endguest


৩. @can
কাজ:
Authorization policy বা permission চেক করে।
যদি ইউজারের কাছে নির্দিষ্ট permission বা ability থাকে, তখন এর ভিতরের কোড রান হয়।
@can('update', $post)
    <a href="/post/{{ $post->id }}/edit">Edit Post</a>
@endcan

৪. @cannot
কাজ:
Authorization policy বা permission না থাকার ক্ষেত্রে এর ভিতরের কোড রান হয়।
@cannot('delete', $post)
    <p>You don't have permission to delete this post.</p>
@endcannot




# Other Useful Directives
১. @csrf
কাজ: HTML ফর্মে CSRF টোকেন যোগ করে, যা Laravel এ ফর্ম সাবমিশন সুরক্ষিত রাখে।
<form method="POST" action="/submit">
    @csrf
    <input type="text" name="name">
    <button type="submit">Submit</button>
</form>

২. @method
কাজ: HTML ফর্মে PUT, PATCH, DELETE মেথড ব্যবহার করার জন্য।
<form method="POST" action="/post/1">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $post->title }}">
    <button type="submit">Update</button>
</form>


৪. @each
কাজ: একটি partial view কে collection এর প্রতিটি আইটেমের জন্য রেন্ডার করা।
@each('view.name', $items, 'item')

ব্যাখ্যা:
1. 'view.name' হল সেই view এর path যা প্রতিটি আইটেমের জন্য রেন্ডার হবে।
2. $items হল সেই collection বা array যা থেকে আইটেমগুলো আসবে।
3. 'item' হল সেই ভ্যারিয়েবল যা প্রতিটি আইটেমের জন্য view এ ব্যবহৃত হবে।
4. এটি foreach এর মত কাজ করে, কিন্তু কোডটি cleaner এবং reusable হয়।

৫. @json
কাজ: PHP ভ্যারিয়েবলকে JSON এ কনভার্ট করে JavaScript এ পাঠানোর জন্য।
<script>
    let user = @json($user);
</script>

৬. @once
কাজ: একটি ব্লক শুধুমাত্র একবার রেন্ডার করার জন্য (যদি multiple include হয়)।
@once
    <script src="some-script.js"></script>
@endonce

৭. @push এবং @stack
কাজ:

@push দিয়ে স্ট্যাক এ content যোগ করা হয় (সাধারণত স্ক্রিপ্ট বা CSS)।
@stack দিয়ে সেই স্ট্যাক থেকে content বের করে।

{{-- layout.blade.php --}}
<head>
    @stack('styles')
</head>

<body>
    @yield('content')
    @stack('scripts')
</body>

{{-- child.blade.php --}}
@push('styles')
<link href="style.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="script.js"></script>
@endpush


৯. @php ... @endphp
কাজ: Blade টেমপ্লেটের মধ্যে raw PHP কোড লেখার জন্য।
@php
    $total = 0;
    foreach($items as $item) {
        $total += $item->price;
    }
@endphp

<p>Total: {{ $total }}</p>


১০. @lang / __()
কাজ: Localization/Translation এর জন্য।

@lang('messages.welcome')
{{-- অথবা --}}
{{ __('messages.welcome') }}
<p>{{ __('Welcome to our website!') }}</p>



##############################################################
##############################################################
# Error Handling 
১. @error
কাজ:
Validation এর সময় কোন ফিল্ডে error থাকলে তা দেখানোর জন্য ব্যবহার হয়।
Laravel এর form validation error message সহজে দেখানোর জন্য খুবই প্রয়োজনীয়।
<input type="email" name="email" value="{{ old('email') }}">

@error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

ব্যাখ্যা:
1. @error('email') এর মানে হল, যদি email ইনপুটে কোন validation error থাকে, তাহলে এর ভিতরের কোড চালাও।
2. $message অটোমেটিক error message ধরে রাখে।
3. এটি validation এর error message দেখানোর সবচেয়ে সহজ ও পরিষ্কার উপায়

# পুরা error গুলো একসাথে দেখানোর জন্য (optional)
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




###################################################################
###################################################################
# Environment & Debugging
১. @env
কাজ: Blade টেমপ্লেটে নির্দিষ্ট environment এ কোড চালানোর জন্য। যেমন, তুমি শুধু local বা staging environment এ কিছু দেখাতে চাও।
@env('local')
    <p>This is local environment.</p>
@endenv

ব্যাখ্যা:
উপরের কোডটি শুধু তখনই রান করবে যখন অ্যাপ্লিকেশন local environment এ আছে। অন্য environment এ এটি কাজ করবে না। 

২. @production
কাজ: Blade টেমপ্লেটে production environment এ কোড চালানোর জন্য। যেমন, তুমি production এ কিছু দেখাতে চাও।
@production
    <p>This is production environment.</p>
@endproduction
ব্যাখ্যা:
উপরের কোডটি শুধু তখনই রান করবে যখন অ্যাপ্লিকেশন production environment এ আছে। অন্য environment এ এটি কাজ করবে না।

৩. @env(['local', 'staging']) (Multiple Environments)
কাজ: একাধিক environment চেক করার জন্য। যেমন, তুমি local বা staging environment এ কিছু দেখাতে চাও।
@env(['local', 'staging'])
    <p>This is either local or staging environment.</p>
@endenv
ব্যাখ্যা: 
উপরের কোডটি তখনই রান করবে যখন অ্যাপ্লিকেশন local বা staging environment এ আছে।

৪. @dd (Dump and Die)
কাজ: ডিবাগ করার জন্য ভ্যারিয়েবল বা ডাটা dump করে execution বন্ধ করে দেয়।
@dd($user)
ব্যাখ্যা:
উপরের কোডটি $user ভ্যারিয়েবল এর ডাটা dump করবে এবং execution বন্ধ করে দেবে। এটি ডিবাগিং এর জন্য খুবই উপকারী।

৫. @dump (Variable Dump)
কাজ: ভ্যারিয়েবল এর ডাটা dump করে, কিন্তু execution বন্ধ করে না।
@dump($posts)
ব্যাখ্যা:
উপরের কোডটি $posts ভ্যারিয়েবল এর ডাটা dump করবে কিন্তু execution চলতে থাকবে। এটি ডিবাগিং এর জন্য উপকারী যখন তুমি ডাটা দেখতে চাও কিন্তু execution বন্ধ করতে চাও না।







