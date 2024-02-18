@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                <div class="card card-plain mt-8">
                    <div class="card-header pb-0 text-left bg-transparent">
                        <h4 class="mb-0">Change password</h4>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{url('/change-password-staff')}}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            {{-- <div>
                                <label for="email">Email</label>
                                <div class="">
                                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div> --}}
                            <div>
                                <label for="password">New Password</label>
                                <div class="">
                                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                </div>
                            </div>
                            <div>
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="">
                                    <input id="password-confirmation" name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password-confirmation" aria-label="Password-confirmation" aria-describedby="Password-addon">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn join w-100 mt-4 mb-0">Recover your password</button>
                            </div>
                        </form>
                    </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                        <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                    </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
