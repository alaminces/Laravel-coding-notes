১. $request->validate() দিয়ে ডেটা ভ্যালিডেশন
Laravel-এ যখন ফর্ম সাবমিট হয়, তখন Controller-এ $request->validate() মেথড ব্যবহার করে ডেটা যাচাই (validation) করা হয়।
এটা স্বয়ংক্রিয়ভাবে চেক করবে যে ডেটা নির্দিষ্ট নিয়ম (rules) মেনে আছে কি না, আর যদি না মেনে থাকে তাহলে আগের পেজে রিডাইরেক্ট করে এরর মেসেজ দেখাবে।

<?php 
$validatedData = $request->validate([
    // সাধারণ
    'name'          => 'required|string|max:100',
    'email'         => 'required|email|unique:users,email',
    'password'      => 'required|string|min:8|confirmed', // confirmed এর জন্য password_confirmation ফিল্ড লাগবে
    
    // সংখ্যা
    'age'           => 'nullable|integer|min:18|max:65',
    'salary'        => 'nullable|numeric|min:0',
    
    // তারিখ এবং সময়
    'joining_date'  => 'required|date|after:today', // আজকের দিন থেকে পরের দিন হতে হবে
    'birth_date'    => 'nullable|date|before:today', // আজকের দিনের আগে হতে হবে
    
    // ফাইল আপলোড
    'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
    'resume'        => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB max
    
    // URL, IP, Boolean
    'website'       => 'nullable|url',
    'ip_address'    => 'nullable|ip',
    'terms'         => 'accepted', // checkbox এর জন্য: true, yes, 1 or on হতে হবে
    
    // Custom Regex (যেমন ফোন নম্বর)
    'phone'         => ['required', 'regex:/^(?:\+88|01)?\d{11}$/'],

    // Enum বা predefined values
    'role'          => 'required|in:admin,editor,user,subscriber',
    
    // Array validation
    'skills'        => 'nullable|array',
    'skills.*'      => 'string|max:50', // skills এর প্রতিটা আইটেম স্ট্রিং হবে
    
    // Nested fields validation (যেমন address)
    'address.street'  => 'required|string|max:255',
    'address.city'    => 'required|string|max:100',
    'address.zipcode' => 'nullable|digits:5',
], [
    // Custom Error Message
    'phone.regex' => 'ফোন নম্বর সঠিক ফরম্যাটে লিখুন (যেমন +8801xxxxxxxxx বা 01xxxxxxxxx)।',
    'terms.accepted' => 'অনুগ্রহ করে শর্তাবলী মেনে নিন।',
]);

// ভ্যালিডেটেড ডেটা দিয়ে ডেটাবেজ আপডেট বা ইনসার্ট
User::create([
    'name' => $validatedData['name'],
    'email' => $validatedData['email'],
    'password' => bcrypt($validatedData['password']),
    // অন্য ফিল্ডও যোগ করতে পারেন
]);

return redirect()->back()->with('success', 'Registration সফল হয়েছে!');

?>

২. ভ্যালিডেশন রুলস (Rules)
রুলস হলো এমন কিছু শর্ত যা বলে দেয় ডেটা কেমন হবে।
Laravel অনেক বিল্ট-ইন রুলস দেয়, যেমনঃ

required → ফিল্ড খালি রাখা যাবে না

nullable → ফিল্ড খালি থাকলেও সমস্যা নেই

email → সঠিক ইমেইল ফরম্যাট হতে হবে

min:value → ন্যূনতম value সংখ্যক অক্ষর/মান হতে হবে

max:value → সর্বোচ্চ value সংখ্যক অক্ষর/মান হতে হবে

between:min,max → মান min এবং max এর মধ্যে হতে হবে

size:value → মান ঠিক value দৈর্ঘ্যের হতে হবে

string → মান অবশ্যই টেক্সট (string) হতে হবে

numeric → মান অবশ্যই সংখ্যা হতে হবে

integer → মান অবশ্যই পূর্ণসংখ্যা হতে হবে

digits:value → মানে ঠিক value সংখ্যক ডিজিট থাকতে হবে

digits_between:min,max → ডিজিট সংখ্যা min এবং max এর মধ্যে হতে হবে

boolean → মান অবশ্যই true বা false হতে হবে

in:value1,value2,... → মান অবশ্যই নির্দিষ্ট লিস্টের মধ্যে থাকতে হবে

not_in:value1,value2,... → মান অবশ্যই নির্দিষ্ট লিস্টের বাইরে হতে হবে

url → সঠিক URL ফরম্যাট হতে হবে

ip → সঠিক IP ঠিকানা হতে হবে

ipv4 → সঠিক IPv4 ঠিকানা হতে হবে

ipv6 → সঠিক IPv6 ঠিকানা হতে হবে

date → সঠিক তারিখ হতে হবে

before:date → নির্দিষ্ট তারিখের আগে হতে হবে

before_or_equal:date → নির্দিষ্ট তারিখের আগে বা সমান হতে হবে

after:date → নির্দিষ্ট তারিখের পরে হতে হবে

after_or_equal:date → নির্দিষ্ট তারিখের পরে বা সমান হতে হবে

confirmed → মানের সাথে _confirmation ফিল্ডের মান মেলাতে হবে (যেমন: password & password_confirmation)

unique:table,column → মান অবশ্যই ডাটাবেসে ইউনিক হতে হবে

exists:table,column → মান অবশ্যই ডাটাবেসে বিদ্যমান থাকতে হবে

file → ইনপুট অবশ্যই ফাইল হতে হবে

image → ইনপুট অবশ্যই ছবি হতে হবে (jpeg, png, bmp, gif, svg, webp)

mimes:types → ফাইল অবশ্যই নির্দিষ্ট টাইপ হতে হবে (যেমন: mimes:jpg,png)

mimetypes:types → ফাইল অবশ্যই নির্দিষ্ট MIME টাইপ হতে হবে

max:value (file) → ফাইল সাইজ সর্বোচ্চ value কিলোবাইট হতে হবে

active_url → URL DNS এ রেজিস্টার্ড হতে হবে

timezone → সঠিক টাইমজোন হতে হবে

distinct → অ্যারের প্রতিটি মান ইউনিক হতে হবে

array → ইনপুট অবশ্যই অ্যারে হতে হবে

json → ইনপুট অবশ্যই JSON ফরম্যাট হতে হবে

present → ফিল্ড অবশ্যই রিকুয়েস্টে থাকতে হবে, কিন্তু খালি থাকতে পারে

regex:pattern → নির্দিষ্ট রেগুলার এক্সপ্রেশন মেলাতে হবে

not_regex:pattern → নির্দিষ্ট রেগুলার এক্সপ্রেশন মেলানো যাবে না

same:field → মান অবশ্যই অন্য একটি ফিল্ডের মানের সমান হতে হবে

different:field → মান অবশ্যই অন্য একটি ফিল্ডের মান থেকে আলাদা হতে হবে

gt:field → মান অবশ্যই অন্য ফিল্ডের মান থেকে বড় হতে হবে

gte:field → মান অবশ্যই অন্য ফিল্ডের মানের সমান বা বড় হতে হবে

lt:field → মান অবশ্যই অন্য ফিল্ডের মান থেকে ছোট হতে হবে

lte:field → মান অবশ্যই অন্য ফিল্ডের মানের সমান বা ছোট হতে হবে