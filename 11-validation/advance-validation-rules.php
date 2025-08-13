<?php 
public function store(Request $request)
{
    $request->validate([
        // Date & Time
        'dob' => 'required|date|before:today',
        'event_date' => 'required|date|after_or_equal:today',

        // File Upload
        'photo' => 'required|image|mimes:jpg,png|max:2048',
        'resume' => 'nullable|file|mimetypes:application/pdf|max:5120',

        // Array
        'tags' => 'required|array',
        'tags.*' => 'distinct|string|max:20',

        // Sometimes
        'nickname' => 'sometimes|string|max:50',

        // Conditional
        'reason' => 'required_if:status,Rejected|string',
        'password' => 'required_with:password_confirmation|min:8',
        'discount' => 'required_with_all:start_date,end_date|numeric',
        'contact' => 'required_without_all:phone,email|string',
    ], [

        // Date & Time
        'dob.required' => 'জন্মতারিখ অবশ্যই দিতে হবে।',
        'dob.date' => 'জন্মতারিখ সঠিক হতে হবে।',
        'dob.before' => 'জন্মতারিখ অবশ্যই আজকের তারিখের আগে হতে হবে।',
        'event_date.required' => 'ইভেন্টের তারিখ দিতে হবে।',
        'event_date.date' => 'ইভেন্টের তারিখ সঠিক হতে হবে।',
        'event_date.after_or_equal' => 'ইভেন্টের তারিখ আজকের দিন বা তার পরে হতে হবে।',

        // File Upload
        'photo.required' => 'ছবি অবশ্যই দিতে হবে।',
        'photo.image' => 'ফাইলটি অবশ্যই একটি ছবি হতে হবে।',
        'photo.mimes' => 'ছবির ফরম্যাট অবশ্যই jpg বা png হতে হবে।',
        'photo.max' => 'ছবির সাইজ সর্বোচ্চ ২MB হতে পারবে।',
        'resume.file' => 'ফাইল অবশ্যই একটি ফাইল হতে হবে।',
        'resume.mimetypes' => 'ফাইল অবশ্যই PDF ফরম্যাট হতে হবে।',
        'resume.max' => 'ফাইলের সাইজ সর্বোচ্চ ৫MB হতে পারবে।',

        // Array
        'tags.required' => 'কমপক্ষে একটি ট্যাগ দিতে হবে।',
        'tags.array' => 'ট্যাগ অবশ্যই একটি অ্যারে হতে হবে।',
        'tags.*.distinct' => 'একই ট্যাগ দুইবার ব্যবহার করা যাবে না।',
        'tags.*.string' => 'প্রত্যেকটি ট্যাগ অবশ্যই টেক্সট হতে হবে।',
        'tags.*.max' => 'প্রত্যেকটি ট্যাগ সর্বোচ্চ ২০ অক্ষরের হতে পারবে।',

        // Sometimes
        'nickname.string' => 'নিকনেম অবশ্যই টেক্সট হতে হবে।',
        'nickname.max' => 'নিকনেম সর্বোচ্চ ৫০ অক্ষরের হতে পারবে।',

        // Conditional
        'reason.required_if' => 'কারণ অবশ্যই দিতে হবে যদি স্ট্যাটাস Rejected হয়।',
        'reason.string' => 'কারণ অবশ্যই টেক্সট হতে হবে।',
        'password.required_with' => 'পাসওয়ার্ড অবশ্যই দিতে হবে যখন নিশ্চিতকরণ দেওয়া হয়েছে।',
        'password.min' => 'পাসওয়ার্ড অন্তত ৮ অক্ষরের হতে হবে।',
        'discount.required_with_all' => 'ডিসকাউন্ট দিতে হবে যখন শুরু ও শেষ তারিখ দেওয়া আছে।',
        'discount.numeric' => 'ডিসকাউন্ট অবশ্যই একটি সংখ্যা হতে হবে।',
        'contact.required_without_all' => 'যোগাযোগের তথ্য দিতে হবে যদি ফোন বা ইমেইল দেওয়া না থাকে।',
        'contact.string' => 'যোগাযোগের তথ্য অবশ্যই টেক্সট হতে হবে।',
    ]);

    // যদি সব ভ্যালিডেশন পাস করে
    return back()->with('success', 'ফর্ম সফলভাবে সাবমিট হয়েছে!');
}
