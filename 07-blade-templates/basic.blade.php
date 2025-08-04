1. ✅ What is Blade?
Blade হল Laravel-এর default templating engine। এর ফাইল extension .blade.php
এটি PHP এর সব সুবিধা দেয়, সাথে Blade এর নিজের syntax।

2. ✅ How to create a blade file?
resources/views/home.blade.php 


3. ✅ Blade Syntax 
{{ $title }}  Echo বা print করার জন্য
{!! $html !!} Raw HTML দেখতে চাইলে

Example: $html = "<h1>Hello Laravel</h1>";

4. ✅ Template Inheritance
Blade এ layout তৈরির জন্য @extends, @section, @yield ব্যবহার করা হয়।

# resources/views/layouts/app.blade.php
@yield('title')
@yield('content')

# resources/views/home.blade.php
@extends('layouts.app')
@section('title', 'Home Page')
@section('content')
<h1>This is Home Page</h1>
@endsection


5. ✅ Displaying Data
{{ $name }}     🔹 Escaped (default):
{!! $html !!}   🔹 Unescaped:

6. ✅ Comments in Blade
Blade Comment : {{-- This is a Blade comment --}}
PHP Comment   : <?php // This is a PHP comment ?>

7. ✅ If Statement
@if($age >= 18)
    <p>You are adult</p>
@elseif($age >= 13)
    <p>You are teenager</p>
@else
    <p>You are child</p>
@endif


8. ✅ Switch Statement
@switch($role)
    @case('admin')
        <p>Welcome Admin</p>
        @break

    @case('editor')
        <p>Welcome Editor</p>
        @break

    @default
        <p>Welcome User</p>
@endswitch


9. ✅ Loops
# For Loop
@for($i = 0; $i < 5; $i++)
    <p>{{ $i }}</p>
@endfor

# Foreach Loop
@foreach($users as $user)
    <p>{{ $user->name }}</p>    
@endforeach

# While Loop
@php 
    $count = 0;
@endphp
@while($count < 5)  
    <p>{{ $count }}</p>
    <?php $count++; ?>
@endwhile

@php $i = 1; @endphp
@while($i <= 3)
    <p>Number: {{ $i }}</p>
    @php $i++; @endphp
@endwhile

# Forelse Loop
@forelse($users as $user)
    <p>{{ $user->name }}</p>
@empty
    <p>No users found</p>
@endforelse


10. ✅ Including Files: @include
@include('partials.header')
@include('partials.footer')
# resources/views/partials/header.blade.php
<header>    
    <h1>Header Section</h1>
</header>
# resources/views/partials/footer.blade.php
<footer>
    <p>Footer Section</p>
</footer>


11. ✅ Blade Layout Example
🔹 Master Layout:
<!-- layouts/app.blade.php -->
<html>
<head>
    <title>@yield('title')</title>
</head>
  <body>
    @include('partials.navbar')
    @include('partials.sidebar')
    @include('partials.header')

    <div class="content">
        @yield('content')
    </div>
    @include('partials.footer')
  </body>
</html>

🔹 Child Page:
<!-- home.blade.php -->
@extends('layouts.app')
@section('title', 'Home Page')
@section('content')
    <h1>Welcome to Home Page</h1>
    <p>This is the content of the home page.</p>
@endsection


12. ✅ Escaped vs Unescaped Output
# Escaped (safe):
{{ "<b>Alamin</b>" }}  // Output: &lt;b&gt;Alamin&lt;/b&gt;
# Unescaped (raw html):
{!! "<b>Alamin</b>" !!}  // Output: <b>Alamin</b>


13. ✅ Raw PHP in Blade
# Using PHP tags:
<?php 
    $name = "Alamin";
?>
<p>{{ $name }}</p>
# Using @php directive:
@php
    $name = "Alamin";
@endphp
<p>{{ $name }}</p>

14. ✅ @isset & @empty Directives
# @isset: Check if a variable is set and not null
@isset($name)
    <p>Name is set: {{ $name }}</p>
@endisset

# @empty: Check if a variable is empty
@empty($users)
    <p>No users found</p>
@endempty

# empty():
@if(empty($users))
    <p>No users found.</p>
@else
    <h2>Users List</h2>
    <ul>
        @foreach($users as $user)
            <li>{{ $user['name'] }}</li>
        @endforeach
    </ul>
@endif


# isset() & empty() Example
@php
    $name = ''; 
@endphp

@if(isset($name) && !empty($name))
    <p>Name is set: {{ $name }}</p>
@else
    <p>Name is not set or empty.</p>
@endif