Laravel Custom Validation -এ দুই ধরনের পদ্ধতি আছে:
1️⃣ Custom Rule Class ব্যবহার করে
2️⃣ Closure-based (anonymous function) ভ্যালিডেশন

১. Custom Validation Rule Class
Step 1: Rule Class তৈরি করা
php artisan make:rule Uppercase
এটি app/Rules/Uppercase.php ফাইল তৈরি করবে।

Step 2: লজিক লেখা
<?php 
public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // চেক করছে সব অক্ষর বড় হাতের কিনা
        if (strtoupper($value) !== $value) {
            $fail('ফিল্ডের মান অবশ্যই বড় হাতের অক্ষর হতে হবে।');
        }
    }
?>

Step 3: Controller-এ ব্যবহার
<?php 
use App\Rules\Uppercase;

public function store(Request $request)
{
    $request->validate([
        'username' => ['required', new Uppercase],
    ]);
}
?>

✅ এখন username শুধুমাত্র বড় হাতের অক্ষর থাকলে ভ্যালিড হবে, অন্যথায় কাস্টম এরর দেখাবে।



২. Closure-based Custom Validation
যদি তুমি ছোট লজিক দ্রুত করতে চাও, তখন Closure ব্যবহার করতে পারো।

<?php 
$request->validate([
    'username' => ['required', function($attribute, $value, $fail) {
        if ($value !== strtoupper($value)) {
            $fail('ফিল্ডের মান অবশ্যই বড় হাতের অক্ষর হতে হবে।');
        }
    }],
]);
?>

ব্যাখ্যা:
$attribute → ফিল্ডের নাম
$value → ফিল্ডের মান
$fail() → যদি ভ্যালিডেশন ফেইল হয়, কাস্টম এরর পাস করে।

