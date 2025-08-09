📍 Slot কী?
Slot হলো Component-এর ভেতরে dynamic content পাঠানোর একটি সিস্টেম।
অ্যাট্রিবিউট দিয়ে ডেটা পাঠানোর বদলে, আমরা HTML বা যেকোনো কন্টেন্ট পাঠাতে পারি।

1️⃣ Default Slot ($slot)
যখন Component-এ কোনো কন্টেন্ট পাঠানো হয় এবং তার জন্য আলাদা কোনো নাম দেওয়া হয় না, তখন সেটা $slot-এ জমা হয়।

# components/alert.blade.php
<div class="bg-red-500 text-white p-3 rounded">
    {{ $slot }}
</div>

# welcome.blade.php
<x-alert>
    This is an error message!
</x-alert>


2️⃣ Named Slots (<x-slot:name>)
যদি Component-এ একাধিক জায়গায় আলাদা আলাদা কন্টেন্ট পাঠাতে হয়, তাহলে Named Slots ব্যবহার করা হয়।

# components/card.blade.php
<div class="border rounded p-3">
    <h2 class="font-bold">{{ $title }}</h2>
    <div>{{ $slot }}</div>
</div>

#welcome.blade.php
<x-card>
    <x-slot:title>
        Laravel Tips
    </x-slot:title>

    This is the card body content.
</x-card>

📌 এখানে:
<x-slot:title> → $title নামে ডেটা পাঠাচ্ছে।
$slot → body content।


3️⃣ Multiple Named Slots
তুমি একাধিক Named Slots ব্যবহার করতে পারো।

#components/layout.blade.php
<div class="border rounded p-3">
    <header>{{ $header }}</header>
    <main>{{ $slot }}</main>
    <footer>{{ $footer }}</footer>
</div>

#welcome.blade.php 
<x-layout>
    <x-slot:header>
        This is the header
    </x-slot:header>

    This is the main body content.

    <x-slot:footer>
        This is the footer
    </x-slot:footer>
</x-layout>


4️⃣ Default Content in Slots
যদি কোনো slot এ কন্টেন্ট পাঠানো না হয়, তাহলে ডিফল্ট কন্টেন্ট দেখানো যায়।

#components/alert.blade.php
<div class="bg-blue-500 text-white p-3 rounded">
    {{ $slot ?? 'Default alert message!' }}
</div>

#welcome.blade.php
<x-alert />
