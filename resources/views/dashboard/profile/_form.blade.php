<div class="form-row">
    <div class="col-md-6">
        <x-form.input label='First Name' name="first_name"  :value="$user->profile->first_name"/>
    </div>
    <div class="col-md-6">
        <x-form.input label='LastName' name="last_name"  :value="$user->profile->last_name"/>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <x-form.input label='Birthday' name="birthday" type='date' :value="$user->profile->birthday"/>
    </div>
    <div class="col-md-6">
        {{-- <x-form.radio-check label='Gender'  name="gender"  :options="['male'=>'Male' , 'female'=>'Female']" :checked="$user->profile->gender"/> --}}
    </div>
</div>
<div class="form-row">
    <div class="col-md-4">
        <x-form.input label='Street Address' name="street_address"  :value="$user->profile->street_address"/>
    </div>
    <div class="col-md-4">
        <x-form.input label='City' name="city"  :value="$user->profile->city"/>
    </div>
    <div class="col-md-4">
        <x-form.input label='State' name="state"  :value="$user->profile->state"/>
    </div>
</div>
<div class="form-row">
    <div class="col-md-4">
        <x-form.input label='Postal Code' name="postal_code"  :value="$user->profile->postal_code"/>
    </div>
    <div class="col-md-4">
        <x-form.select label='Country' first_option="akl"  :options="$countries" name="country" :selected="$user->profile->country"/>
    </div>
    <div class="col-md-4">
        <x-form.select label='Locale' first_option="akl" :options="$locale" name="locale"  :selected="$user->profile->locale"/>
    </div>
</div>


<div class="mt-3">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save'}}</button>
</div>