১০. Validation Performance Best Practices
১. যতটা সম্ভব Custom Rule ব্যবহার করা
বড় বা জটিল লজিক Controller-এ রাখার বদলে Custom Rule Class ব্যবহার করো।

এতে কোড পুনঃব্যবহারযোগ্য হয় এবং Controller লাইট থাকে।
<?php 
use App\Rules\Uppercase;
$request->validate([
    'username' => ['required', new Uppercase()],
]);
?>

২. Form Request ব্যবহার করা
Form Request ক্লাসে সব ভ্যালিডেশন লজিক রাখলে Controller clean এবং reusable হয়।

ভ্যালিডেশন rules + custom messages + কাস্টম logic সব Form Request-এ রাখা যায়।

৩. Conditional Validation ব্যবহার করা
ভ্যালিডেশন সর্বদা প্রয়োজনীয় না হলে skip করা।

যেমন sometimes, required_if, required_without ইত্যাদি।
<?php 
$request->validate([
    'discount' => 'sometimes|numeric|min:0|max:100',
]);
?>

যদি ফিল্ডটি ফর্মে না আসে, Laravel ভ্যালিডেশন skip করবে।

৪. Avoid unnecessary DB checks
যদি শুধু format বা length চেক করতে হয়, DB চেক করার আগে basic validation করা।

উদাহরণ: unique:users,email ব্যবহার করতে হবে শুধু email field validate করার জন্য।

৫. Nested Validation শুধুমাত্র প্রয়োজন হলে ব্যবহার করা
প্রতিটি nested field validate করলে performance প্রভাবিত হতে পারে।

শুধু দরকারি nested ফিল্ড validate করো।