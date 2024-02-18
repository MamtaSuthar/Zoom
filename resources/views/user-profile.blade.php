@extends('layouts.user_type.auth')

@section('content')

<div>
{{-- User Profile --}}
    <div class="container-fluid py-4">
        <a href="{{url('/')}}" class="btn join btn-sm mb-3" type="button"><i class="fas fa-arrow-left"></i></a>
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{url('user-profile')}}" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    @if(Auth::user()->role !=1 )
                        <div class="form-group">
                            <label for="user.emp_id" class="form-control-label">{{ __('Employee ID') }}</label>
                            <div>
                                <input class="form-control @error('emp_id') is-invalid @enderror" type="text" value="{{Auth::user()->emp_id}}" placeholder="Employee ID" id="user.emp_id" name="emp_id" {{(Auth::user()->role != 1)?'disabled' : ''}}>
                            </div>
                            {{-- @error('emp_id')
                                <p class="text-danger text-xs mt-2">*{{ $message }}</p>
                            @enderror --}}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.name" class="form-control-label">{{ __('Full Name') }}</label>
                                <div>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter Your Full Name" id="user.name" name="name" value="{{ucfirst(Auth::user()->name)}}">
                                </div>
                                {{-- @error('name')
                                    <p class="text-danger text-xs mt-2">*{{ $message }}</p>
                                @enderror --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.email" class="form-control-label">{{ __('Email') }}</label>
                                <div>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Enter Your Email Address" id="user.email" name="email" value="{{Auth::user()->email}}" {{(Auth::user()->role != 1)?'disabled' : ''}}>
                                </div>
                                {{-- @error('email')
                                    <p class="text-danger text-xs mt-2">*{{ $message }}</p>
                                @enderror --}}
                            </div>
                        </div>
                    </div>
                    
                    <p>
                        <a class="" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                          <strong>Change Password</strong>
                        </a>
                    </p>

                    <div class="collapse" id="collapseExample">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user.password" class="form-control-label">{{ __('Old Password') }}</label>
                                    <div>
                                        <input class="form-control @error('old_password') is-invalid @enderror" type="password" placeholder="Enter Old Password" id="user.password" name="old_password" value="{{old('old_password')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user.password" class="form-control-label">{{ __('New Password') }}</label>
                                    <div>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Enter New Password" id="user.password" name="password" value="{{old('password')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user.password" class="form-control-label">{{ __('Confirm New Password') }}</label>
                                    <div>
                                        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" placeholder="Confirm New Password" id="user.password" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @if(Auth::user()->role != 1)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user.number" class="form-control-label">{{ __('Phone Number') }}</label>
                                    <div>
                                        <input class="form-control @error('phone') is-invalid @enderror" type="tel" placeholder="Enter Phone Number" id="user.number" name="phone"  maxlength="10" value="{{Auth::user()->phone}}" {{(Auth::user()->role != 1)?'disabled' : ''}}>
                                    </div>
                                    {{-- @error('phone')
                                        <p class="text-danger text-xs mt-2">*{{ $message }}</p>
                                    @enderror --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user.dob" class="form-control-label">{{ __('DOB') }}</label>
                                    <div>
                                        <input class="form-control @error('dob') is-invalid @enderror" type="date" placeholder="Select DOB" id="user.dob" name="dob" value="{{Auth::user()->dob}}">
                                    </div>
                                    {{-- @error('dob')
                                    <p class="text-danger text-xs mt-2">*{{ $message }}</p>
                                    @enderror --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user.location" class="form-control-label">{{ __('Location') }}</label>
                                    <div>
                                        <input class="form-control @error('location') is-invalid @enderror" type="text" placeholder="Location" id="user.location" name="location" value="{{Auth::user()->location}}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        @if(Auth::user()->role != 1)
                        <div class="col-md-3" id="country_field_selected">
                            <label for="country" class="form-control-label"><span class="text-danger"></span>{{ __('Country') }}</label>
                            <select class="form-select" aria-label="Default select example" id="country_selected" name="country">
                                <option value="" selected disabled>Select Country</option>
                                @if($user->country != null)
                                    <option value="{{$user->country_id}}" selected>{{$user->country_name}}</option>
                                @else
                                    <option value="" selected disabled>Select Country</option>
                                @endif
                            </select>    
                        </div>

                        <div class="col-md-3" id="country_field">
                            <label for="country" class="form-control-label"><span class="text-danger"></span>{{ __('Country') }}</label>
                            <select class="form-select" aria-label="Default select example" id="country" name="country">
                                <option value="" selected disabled>Select Country</option>
                                @foreach($countries as $country) 
                                    <option value={{$country->id}}>{{$country->name}}</option>
                                @endforeach
                            </select>    
                        </div>
                        <div class="col-md-3">
                            <label for="state" class="form-control-label"><span class="text-danger"></span>{{ __('State') }}</label>
                            <select class="form-select" aria-label="Default select example" id="state" name="state">
                                @if($user->state != null)
                                    <option value="{{$user->state_id}}" selected>{{$user->state_name}}</option>
                                @else
                                    <option value="" selected disabled>Select State</option>
                                @endif
                            </select>    
                        </div>
                        <div class="col-md-3">
                            <label for="city" class="form-control-label"><span class="text-danger"></span>{{ __('City') }}</label>
                            <select class="form-select" aria-label="Default select example" id="city" name="city">
                                @if($user->city != null)
                                    <option value="{{$user->city_id}}" selected>{{$user->city_name}}</option>
                                @else
                                    <option value="" selected disabled>Select City</option>
                                @endif
                            </select>    
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pin_code" class="form-control-label"><span class="text-danger"></span>{{ __('Pin Code') }}</label>
                                <div>
                                    <input class="form-control @error('pin_code') is-invalid @enderror" type="text" placeholder="Enter Pin Code" id="pin_code" name="pin_code" value="{{$user->pin_code}}" maxlength="6">
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    @if(Auth::user()->role != 1)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.designation" class="form-control-label">{{ __('Designation') }}</label>
                                    <div>
                                        <input class="form-control @error('designation') is-invalid @enderror" type="text" placeholder="Enter Your Designation" id="user.designation" name="designation" value="{{Auth::user()->designation}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="user.blood_group">
                                    <label for="user.blood_group" class="form-control-label">{{ __('Blood Group') }}</label>
                                    <div class="@error('blood_group')border border-danger rounded-3 @enderror">
                                    <select class="form-select" aria-label="Default select example" id="user.blood_group" name="blood_group">
                                        <option selected value="" disabled>Select Your Blood Group</option>
                                            <option value="O positive" {{(Auth::user()->blood_group == 'O positive')?'selected':''}}>O positive</option>
                                            <option value="O negative" {{(Auth::user()->blood_group == 'O negative')?'selected':''}}>O negative</option>
                                            <option value="A positive" {{(Auth::user()->blood_group == 'A positive')?'selected':''}}>A positive</option>
                                            <option value="A negative" {{(Auth::user()->blood_group == 'A negative')?'selected':''}}>A negative</option>
                                            <option value="B positive" {{(Auth::user()->blood_group == 'B positive')?'selected':''}}>B positive</option>
                                            <option value="B negative" {{(Auth::user()->blood_group == 'B negative')?'selected':''}}>B negative</option>
                                            <option value="AB positive" {{(Auth::user()->blood_group == 'AB positive')?'selected':''}}>AB positive</option>
                                            <option value="AB negative" {{(Auth::user()->blood_group == 'AB negative')?'selected':''}}>AB negative</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="user.about">{{ 'About Me' }}</label>
                            <div>
                                <textarea class="form-control @error('about_me') is-invalid @enderror" id="user.about" rows="3" placeholder="Say something about yourself" name="about_me">{{Auth::user()->about_me}}</textarea>
                            </div>
                            {{-- @error('about_me')
                                <p class="text-danger text-xs mt-2">*{{ $message }}</p>
                            @enderror --}}
                        </div>

                        <div class="form-group">
                            {{-- @if(Auth::user()->profile_pic==null || Auth::user()->profile_pic=='' )
                                <img src="{{asset(env('AdMINPROFILE'))}}" width="100" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            @else
                                <img src="{{asset('public/assets/profile_pic/'.Auth::user()->profile_pic)}}" width="100" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            @endif --}}
                            <img src="{{(Auth::user()->profile_pic)==null?asset(env('AdMINPROFILE')):asset('public/assets/profile_pic/'.Auth::user()->profile_pic)}}" width="100" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        </div>

                        <div class="form-group">
                            <label for="user.profile_pic">{{ 'Upload your profile photo' }}</label>
                            <div>
                                <input class="form-control @error('profile_pic') is-invalid @enderror" type="file" id="user.profile_pic" name="profile_pic">
                            </div>
                            {{-- @error('profile_pic')
                                <p class="text-danger text-xs mt-2">*{{ $message }}</p>
                            @enderror --}}
                        </div>
                    @endif

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn join btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script>
    $(document).ready(function () {
        // alert('alert message');
        $('#country_field').hide();
        $('#country').on('change',function(){
            var country_id = $(this).val();
            $('#state').html('');
            $.ajax({
                type: "GET",
                url: "{{url('get-states')}}/"+country_id,
                success: function (response) {
                    console.log(response.data)
                    $('#state').append('<option value="" selected disabled>Select State</option>')
                    $.each(response.data, function (index, value) { 
                        $('#state').append('<option value="'+value.id+'">'+value.name+'</option>')
                    });
                    
                }
            });
        })

        $('#state').on('change',function(){
            var state_id = $(this).val();
            console.log(state_id)
            $('#city').html('');
            $.ajax({
                type: "GET",
                url: "{{url('get-cities')}}/"+state_id,
                success: function (response) {
                    $('#city').append('<option value="" selected disabled>Select City</option>')
                    $.each(response.data, function (index, value) { 
                        $('#city').append('<option value="'+value.id+'">'+value.city+'</option>')
                    });
                    
                }
            });
        })

        $('#country_selected').on('click',function(){
            $('#country_field_selected').hide();
            $('#country_field').show();
            $('#state').html('');
            $('#city').html('');
            $('#state').append('<option value="" selected disabled>Select State</option>')
            $('#city').append('<option value="" selected disabled>Select City</option>')            
        })
    });
</script>    
@endpush