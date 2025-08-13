# Nested Data Validation

Laravel-এ তুমি মাল্টিডাইমেনশনাল অ্যারে বা nested objects ভ্যালিড করতে পারো ডট নোটেশন ব্যবহার করে।

# blade form example 
<label>Street:</label>
<input type="text" name="address[street]" value="{{ old('address.street') }}">
@error('address.street')
    <p style="color:red">{{ $message }}</p>
@enderror

<label>City:</label>
<input type="text" name="address[city]" value="{{ old('address.city') }}">
@error('address.city')
    <p style="color:red">{{ $message }}</p>
@enderror

<label>Zip:</label>
<input type="text" name="address[zip]" value="{{ old('address.zip') }}">
@error('address.zip')
    <p style="color:red">{{ $message }}</p>
@enderror

# validation 
<?php 
$request->validate([
    'name' => 'required|string|min:3|max:50',
    'email' => 'required|email',
    'address.street' => 'required|string|max:100',
    'address.city' => 'required|string|max:50',
    'address.zip' => 'required|numeric',
]);
?>

