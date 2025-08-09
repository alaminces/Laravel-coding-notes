📍 Data Passing কী?
Blade Component-এ আমরা HTML-এর attribute এর মাধ্যমে props (ডেটা) পাঠাতে পারি।
এই ডেটা component ফাইলে ব্যবহার করা যায়।

1️⃣ Anonymous Component-এ Data Passing : 
#Step 1: Component বানানো
php artisan make:component alert --view

#Step 2: resources/views/components/alert.blade.php ফাইলে:

@props(['type', 'message'])

<div class="{{ $type === 'success' ? 'bg-green-500' : 'bg-red-500' }} text-white p-3 rounded">
    {{ $message }}
</div>

📌 এখানে:
@props(['type', 'message']) → আমরা বলছি এই component দুইটি ডেটা নেবে: $type এবং $message।

যদি কোনো value না দেই, তাহলে error আসবে (ডিফল্ট value না দিলে)।

#Step 3: Component ব্যবহার
<x-alert type="success" message="Data saved successfully!" />
<x-alert type="error" message="Something went wrong!" />

2️⃣ Default Value সহ Data Passing
যদি কোনো ডেটা না পাঠানো হয়, তখন default value ব্যবহার করা যাবে।
# alert.blade.php:
@props(['type' => 'error', 'message' => 'Something went wrong!'])

<div class="{{ $type === 'success' ? 'bg-green-500' : 'bg-red-500' }} text-white p-3 rounded">
    {{ $message }}
</div>

এখন যদি শুধু <x-alert /> ব্যবহার করো, তবুও type="error" আর message="Something went wrong!" থাকবে।


3️⃣ Class-based Component-এ Data Passing : 
#Step 1: Component বানানো
php artisan make:component Alert

#এটি বানাবে:
app/View/Components/Alert.php
resources/views/components/alert.blade.php

#Step 2: Alert.php ফাইলে:
<?php 
namespace App\View\Components;
use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $message;

    public function __construct($type = 'error', $message = 'Something went wrong!')
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function render()
    {
        return view('components.alert');
    }
}
?>

#Step 3: alert.blade.php ফাইলে:
 
<div class="{{ $type === 'success' ? 'bg-green-500' : 'bg-red-500' }} text-white p-3 rounded">
    {{ $message }}
</div>

#Step 4: ব্যবহার
<x-alert type="success" message="Profile updated!" />


4️⃣ Dynamic Data Passing
তুমি PHP variable এর value পাঠাতেও পারো:

@php
    $msg = "User created successfully!";
@endphp

<x-alert type="success" :message="$msg" />

📌 Note: ভ্যারিয়েবল পাঠাতে হলে : (colon) দিতে হয়।








