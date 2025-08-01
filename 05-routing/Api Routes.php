# API Routes কী?

Laravel-এ API Routes হলো এমন Route গুলো যেগুলো API (Application Programming Interface) এর জন্য ব্যবহার হয়।
এগুলো সাধারণত JSON ডেটা পাঠায়, HTML নয়।

# কোথায় API Routes লেখা হয়?
👉 routes/api.php ফাইলে।

# API Routes এর বৈশিষ্ট্য : 
1. Stateless — মানে, session বা cookie ব্যবহৃত হয় না।
2. সাধারণত JSON response দেয়।
3. URL-এর শুরুতে /api থাকে (Laravel নিজে যোগ করে)।
4. Web middleware ব্যবহার হয় না, বরং api middleware group ব্যবহার হয়।

# Installation:
Laravel-এ API Routes ডিফল্টভাবে অন্তর্ভুক্ত থাকে না।
তবে, আপনি routes/api.php ফাইলে API Routes তৈরি করতে পারেন।
php artisan install::api

Note: এই কমান্ডটি Laravel Sanctum প্যাকেজ ইনস্টল করে, যা API authentication এর জন্য ব্যবহৃত হয়।

# Registration:
bootstrap/app.php ফাইলে API Routes রেজিস্টার করা হয়।


<?php 
use Illuminate\Support\Facades\Route;

Route::get('/user', function() {
    return 'user info';
});

// https://127.0.0.1/api/user
// এই URL-এ GET request করলে 'user info' রেসপন্স পাওয়া যাবে।

?>

🔚 সংক্ষেপে:
API Routes হলো JSON-based communication-এর জন্য ব্যবহার হয়।

এগুলো routes/api.php ফাইলে থাকে।

URL এ /api prefix যুক্ত থাকে।

Controller অথবা Closure দিয়েই লেখা যায়।