Old Input ব্যবহার হয় ফর্ম সাবমিটের পর পুরানো ডাটা আবার ফর্মে দেখানোর জন্য।

1. Preserving Old Input
<?php 
return redirect()->back()->withInput();
?>

2. Retrieving Old Input in Blade
<input type="text" name="name" value="{{ old('name') }}">


3. Default Value সহ Old Input
<input type="text" name="name" value="{{ old('name', 'Default Name') }}">


4. Using Old Input with Validation Errors
<?php 
$request->validate([
    'name' => 'required',
]);

return back()->withInput();
?>
Blade এ:
<input type="text" name="name" value="{{ old('name') }}">
@error('name')
    <div class="text-red-500">{{ $message }}</div>
@enderror


5. Multiple Form Fields (Checkbox, Radio, Select)
Checkbox:
<input 
    type="checkbox" 
    name="subscribe" 
    value="1" 
    {{ old('subscribe') ? 'checked' : '' }}>

Select Option:
<select name="country">
    <option value="BD" {{ old('country') == 'BD' ? 'selected' : '' }}>Bangladesh</option>
    <option value="IN" {{ old('country') == 'IN' ? 'selected' : '' }}>India</option>
</select>


6. Combining Old Input with Model Data
<input type="text" name="name" value="{{ old('name', $user->name) }}">



