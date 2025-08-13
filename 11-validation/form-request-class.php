Form Request ব্যবহার করলে ভ্যালিডেশন লজিক Controller থেকে আলাদা হয়ে যায় এবং কোড অনেক ক্লিন হয়।

১. Form Request তৈরি করা
php artisan make:request StoreUserRequest
এটি app/Http/Requests/StoreUserRequest.php ফাইল তৈরি করবে।

২. Form Request এ rules এবং authorize method
StoreUserRequest.php ফাইলটি খুললে দেখবে:
<?php 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    // কন্ট্রোলার থেকে ফর্মের ভ্যালিডেশন অনুমোদন
    public function authorize(): bool
    {
        // যদি সত্যি হয়, তাহলে ভ্যালিডেশন চলবে
        return true;
    }

    // ভ্যালিডেশন রুলস
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    // কাস্টম এরর মেসেজ
    public function messages(): array
    {
        return [
            'name.required' => 'নাম অবশ্যই দিতে হবে।',
            'name.min' => 'নাম অন্তত ৩ অক্ষরের হতে হবে।',
            'email.required' => 'ইমেইল অবশ্যই দিতে হবে।',
            'email.email' => 'ইমেইল ঠিকানা সঠিক হতে হবে।',
            'email.unique' => 'এই ইমেইল ইতিমধ্যে নিবন্ধিত হয়েছে।',
            'password.required' => 'পাসওয়ার্ড অবশ্যই দিতে হবে।',
            'password.min' => 'পাসওয়ার্ড অন্তত ৮ অক্ষরের হতে হবে।',
            'password.confirmed' => 'পাসওয়ার্ড নিশ্চিতকরণ মেলেনি।',
        ];
    }
}
?>

৩. Controller এ Form Request inject করা
<?php 
namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        // $request->validated() ব্যবহার করলে শুধু ভ্যালিড ডেটা আসে
        $data = $request->validated();

        // ডেটা সেভ করা
        User::create($data);

        return redirect()->back()->with('success', 'ব্যবহারকারী সফলভাবে যোগ হয়েছে!');
    }
}

?>

✅ Controller-এ এখন ভ্যালিডেশন লজিক নেই, সব Form Request এ আছে।


# Custom Logic Advance Validation
Laravel-এ withValidator method Form Request class-এর ভিতরেই লিখতে হবে।
এটি rules() method-এর পাশাপাশিই থাকে।

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required'
        ];

    }

    // custom error message 
    public function messages():array
    {
        return [
            'username.required' => 'নাম অবশ্যই দিতে হবে।'
        ];
    }

    // withValidator
    public function withValidator($validator)
    {
        $validator->after(function($validator) {
            if($this->username === 'Admin') {
                $validator->errors()->add('username','নাম "Admin" হতে পারবে না।');
            }
        });
    }
}
?>

