Database Configuration (.env file)

Laravel-এ ডাটাবেস কানেকশনের জন্য .env ফাইলে কনফিগারেশন সেট করা হয়, যাতে ডাটাবেসের তথ্য কোডে সরাসরি লেখা না লাগে।


1️⃣ Basic Database Connection (.env)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_app
DB_USERNAME=root
DB_PASSWORD=


2️⃣ Multiple Database Connection

config/database.php এ নতুন কানেকশন যোগ করো


>> DB_CONNECTION → কোন ডাটাবেস ব্যবহার হবে (mysql, pgsql, sqlite, sqlsrv)
>> DB_HOST → ডাটাবেস সার্ভারের IP (লোকাল হলে 127.0.0.1)
>> DB_PORT → ডাটাবেস পোর্ট (MySQL এর জন্য 3306)
>> DB_DATABASE → ডাটাবেসের নাম
>> DB_USERNAME → ডাটাবেস ইউজার
>> DB_PASSWORD → ডাটাবেস পাসওয়ার্ড


3️⃣ Using SQLite (Lightweight)
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
নোট: SQLite এর জন্য শুধু একটি .sqlite ফাইল দরকার, আলাদা সার্ভার লাগে না।
Default set in Laravel 12. Nothing to change.

4️⃣ Advanced SSL Connection (Production)
DB_CONNECTION=mysql
DB_HOST=db.example.com
DB_PORT=3306
DB_DATABASE=secure_db
DB_USERNAME=secure_user
DB_PASSWORD=secure_pass
DB_SSL_KEY=/path/client-key.pem
DB_SSL_CERT=/path/client-cert.pem
DB_SSL_CA=/path/ca-cert.pem

Note: প্রোডাকশনে সিকিউর কানেকশন নিশ্চিত করার জন্য SSL ব্যবহার হয়।


5️⃣ Config Cache Refresh
.env পরিবর্তন করার পর চালাতে হবে:
php artisan config:cache
নাহলে নতুন সেটিংস লোড নাও হতে পারে।


6️⃣ Deployment & Security Tips

.env ফাইল কখনোই পাবলিক রিপোজিটরিতে আপলোড করো না।

.env.example ফাইল রাখো যাতে অন্য ডেভেলপার সহজে কনফিগ করতে পারে।

সার্ভারে .env ফাইলের পারমিশন সঠিকভাবে সেট করো।


