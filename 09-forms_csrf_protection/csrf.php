Laravel এ Forms & CSRF Protection মূলত ফর্ম সাবমিশন সিকিউর করার জন্য ব্যবহৃত হয়, যাতে Cross-Site Request Forgery (CSRF) আক্রমণ ঠেকানো যায়।

1️⃣ CSRF কী?
CSRF (Cross-Site Request Forgery) হলো এমন একটি আক্রমণ যেখানে একজন আক্রমণকারী আপনার লগইন সেশনের সুযোগ নিয়ে আপনার অজান্তে অনাকাঙ্ক্ষিত রিকোয়েস্ট পাঠিয়ে দিতে পারে।
উদাহরণ: আপনি লগইন অবস্থায় থাকাকালীন কোনো ম্যালিসিয়াস ওয়েবসাইটে গেলে, সেটি আপনার হয়ে POST রিকোয়েস্ট পাঠিয়ে ডাটাবেজ পরিবর্তন করতে পারে।

2️⃣ Laravel এ CSRF Protection
Laravel প্রতিটি POST, PUT, PATCH, এবং DELETE রিকোয়েস্টের জন্য CSRF টোকেন চেক করে।
টোকেন মিলে না গেলে রিকোয়েস্ট বাতিল হয়ে যায় (HTTP 419 Error)।

3️⃣ Blade ফর্মে CSRF Token যোগ করা
Laravel Blade এ ফর্ম তৈরি করার সময় আপনাকে @csrf ডিরেক্টিভ ব্যবহার করতে হবে।

<form action="" method="POST">
    @csrf
</form>

🔹 @csrf → হিডেন ইনপুট ফিল্ডে একটি র‍্যান্ডম ইউনিক টোকেন যোগ করে, যা Laravel ভ্যালিডেট করে।

4️⃣ Raw HTML এ CSRF Token যোগ করা
যদি আপনি Blade ডিরেক্টিভ ব্যবহার না করেন, তাহলে ম্যানুয়ালি টোকেন যোগ করতে হবে—
<form method="POST" action="/submit">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>

5️⃣ CSRF Token কিভাবে ভ্যালিডেট হয়?

* প্রতিটি সেশনে Laravel একটি ইউনিক টোকেন রাখে।
* ফর্ম সাবমিট হলে পাঠানো _token ফিল্ড সেশনের টোকেনের সাথে মিলিয়ে দেখা হয়।
* যদি মিল না হয় → 419 Page Expired এরর দেখাবে।


7️⃣ AJAX রিকোয়েস্টে CSRF Token পাঠানো
যদি আপনি jQuery AJAX ব্যবহার করেন—

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

Blade এ টোকেন রাখতে হবে—
<meta name="csrf-token" content="{{ csrf_token() }}">

8️⃣ গুরুত্বপূর্ণ পয়েন্ট
* Laravel GET রিকোয়েস্টে CSRF চেক করে না।
* সবসময় POST, PUT, PATCH, DELETE রিকোয়েস্টে টোকেন থাকতে হবে।
* @csrf ব্যবহার করলে স্বয়ংক্রিয়ভাবে সিকিউরিটি বজায় থাকে।



