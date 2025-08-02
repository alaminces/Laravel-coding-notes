# What is a Resource Controller?
Laravel এর Resource Controller হলো একটি বিশেষ টাইপের কন্ট্রোলার যা CRUD (Create, Read, Update, Delete) কাজগুলোকে automate এবং organize করে।

Laravel এই কাজগুলো করার জন্য আগে থেকেই কিছু standard method define করে রেখেছে, যেগুলোর মাধ্যমে তুমি দ্রুত CRUD অ্যাপ বানাতে পারো।

# Why use Resource Controller?
কোড structure পরিষ্কার ও maintainable হয়

সময় বাঁচায় (Laravel নিজেই route-method গুলো জানে)

CRUD application তৈরি করা সহজ হয়

# Laravel Resource Controller Structure
একটা Resource Controller সাধারণত ৭টি method থাকে:
- `index`: সব resources দেখানোর জন্য
- `create`: নতুন resource তৈরি করার ফর্ম দেখানোর জন্য    
- `store`: নতুন resource ডাটাবেজে সংরক্ষণ করার জন্য
- `show`: নির্দিষ্ট resource দেখানোর জন্য
- `edit`: নির্দিষ্ট resource এডিট করার ফর্ম দেখানোর জন্য
- `update`: নির্দিষ্ট resource আপডেট করার জন্য
- `destroy`: নির্দিষ্ট resource ডিলিট করার জন্য


# How to Create Resource Controller
php artisan make:controller PostController --resource
php artisan make:controller PostController -r

# Routes Setup
<?php 
    use App\Http\Controllers\PostController;
    use Illuminate\Support\Facades\Route;

    Route::resource('posts', PostController::class);
?>

# Multi Resource Controller in one Routes
Laravel Resource Controller এর routes গুলোকে একসাথে group করা যায়। যেমন:
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PhotoController;

Route::resources([
    'posts' => PostController::class,
    'photos' => PhotoController::class,
]);
?>



