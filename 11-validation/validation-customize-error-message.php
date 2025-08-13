১. সরাসরি Controller-এ কাস্টম মেসেজ দেওয়া
তুমি $request->validate() মেথডে দ্বিতীয় প্যারামিটার হিসেবে মেসেজের অ্যারে পাঠাতে পারো।

<?php 
$request->validate([
    'name'  => 'required|min:3',
    'email' => 'required|email',
], [
    'name.required' => 'নাম অবশ্যই দিতে হবে।',
    'name.min'      => 'নামের দৈর্ঘ্য অন্তত ৩ অক্ষর হতে হবে।',
    'email.required' => 'ইমেইল অবশ্যই দিতে হবে।',
    'email.email'    => 'সঠিক ইমেইল ফরম্যাট ব্যবহার করুন।',
]);

// others rules of validation
[
    // Required & Nullable
    'name.required' => 'নাম অবশ্যই দিতে হবে।',
    'email.required' => 'ইমেইল অবশ্যই দিতে হবে।',
    'password.required' => 'পাসওয়ার্ড অবশ্যই দিতে হবে।',
    'age.required' => 'বয়স অবশ্যই দিতে হবে।',
    'photo.required' => 'ছবি অবশ্যই দিতে হবে।',
    'name.nullable' => 'নাম খালি রাখা যেতে পারে।',

    // Email
    'email.email' => 'ইমেইল সঠিক ফরম্যাটে হতে হবে।',

    // Min & Max
    'name.min' => 'নাম অন্তত ৩ অক্ষরের হতে হবে।',
    'name.max' => 'নাম সর্বোচ্চ ৫০ অক্ষরের হতে পারবে।',
    'password.min' => 'পাসওয়ার্ড অন্তত ৮ অক্ষরের হতে হবে।',

    // Between & Size
    'age.between' => 'বয়স অবশ্যই ১৮ থেকে ৬০ এর মধ্যে হতে হবে।',
    'name.size' => 'নাম ঠিক ১০ অক্ষরের হতে হবে।',

    // Numeric & Integer
    'age.numeric' => 'বয়স অবশ্যই একটি সংখ্যা হতে হবে।',
    'age.integer' => 'বয়স অবশ্যই পূর্ণসংখ্যা হতে হবে।',

    // Digits
    'phone.digits' => 'ফোন নম্বর অবশ্যই ১১ সংখ্যার হতে হবে।',
    'phone.digits_between' => 'ফোন নম্বর অবশ্যই ১০ থেকে ১৫ সংখ্যার হতে হবে।',

    // Boolean
    'status.boolean' => 'স্ট্যাটাস অবশ্যই true অথবা false হতে হবে।',

    // In & Not In
    'role.in' => 'রোল অবশ্যই নির্দিষ্ট অপশনের মধ্যে হতে হবে।',
    'role.not_in' => 'নির্বাচিত রোল অনুমোদিত নয়।',

    // URL & IP
    'website.url' => 'ওয়েবসাইটের ঠিকানা সঠিক হতে হবে।',
    'server.ip' => 'সার্ভারের IP ঠিকানা সঠিক হতে হবে।',

    // Date
    'dob.date' => 'জন্মতারিখ সঠিক হতে হবে।',
    'dob.before' => 'জন্মতারিখ অবশ্যই ২০০৫ সালের আগে হতে হবে।',
    'dob.after' => 'তারিখ অবশ্যই ২০২০ সালের পরে হতে হবে।',

    // Confirmed
    'password.confirmed' => 'পাসওয়ার্ড নিশ্চিতকরণ মেলেনি।',

    // Unique & Exists
    'email.unique' => 'এই ইমেইল ইতিমধ্যে ব্যবহৃত হয়েছে।',
    'user_id.exists' => 'নির্বাচিত ব্যবহারকারী বিদ্যমান নেই।',

    // File & Image
    'photo.file' => 'ছবি অবশ্যই একটি ফাইল হতে হবে।',
    'photo.image' => 'ছবি অবশ্যই একটি ইমেজ ফাইল হতে হবে।',
    'photo.mimes' => 'ছবি অবশ্যই jpg, jpeg, png টাইপের হতে হবে।',

    // Max File Size
    'photo.max' => 'ছবির সাইজ সর্বোচ্চ ২MB হতে পারবে।',

    // Array
    'tags.array' => 'ট্যাগ অবশ্যই একটি অ্যারে হতে হবে।',

    // JSON
    'data.json' => 'ডেটা অবশ্যই একটি সঠিক JSON হতে হবে।',

    // Regex
    'username.regex' => 'ইউজারনেমে শুধুমাত্র অক্ষর ও সংখ্যা ব্যবহার করা যাবে।',

    // Same & Different
    'password.same' => 'পাসওয়ার্ড এবং নিশ্চিতকরণ অবশ্যই মিলতে হবে।',
    'username.different' => 'ইউজারনেম এবং পাসওয়ার্ড আলাদা হতে হবে।',

    // Compare
    'age.gt' => 'বয়স অবশ্যই ১৮ বছরের বেশি হতে হবে।',
    'age.gte' => 'বয়স অবশ্যই ১৮ বছর বা বেশি হতে হবে।',
    'age.lt' => 'বয়স অবশ্যই ৬০ বছরের কম হতে হবে।',
    'age.lte' => 'বয়স অবশ্যই ৬০ বছর বা কম হতে হবে।',
]
?>


২. Form Request Class-এ কাস্টম মেসেজ
যদি বড় প্রজেক্ট হয়, তাহলে Form Request Validation ব্যবহার করা ভালো।
এখানে মেসেজগুলো আলাদা মেথডে রাখা হয়।

#Step 1: Form Request তৈরি করা
php artisan make:request StoreUserRequest

#Step 2: rules() মেথডে রুলস এবং messages() মেথডে মেসেজ লিখো

public function rules()
{
    return [
        'name'  => 'required|min:3',
        'email' => 'required|email',
    ];
}

public function messages()
{
    return [
        'name.required' => 'নাম অবশ্যই দিতে হবে।',
        'name.min'      => 'নাম অন্তত ৩ অক্ষর হতে হবে।',
        'email.required' => 'ইমেইল দিতে হবে।',
        'email.email'    => 'সঠিক ইমেইল ফরম্যাট ব্যবহার করুন।',
    ];
}
