@extends('layouts.user_type.auth')
@section('content')
    <div>
        <div class="container-fluid py-4 ">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('join Meeting') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <?php
                    $currenturl = url()->full();
                    
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ $currenturl }}" target="_blank" method="POST">
                                @csrf
                                <h3 class="my-3">What's your name ?</h3>
                                <input type="hidden" value="{{ $currenturl }}" name="url">
                                <input type="text" class="form-control" name="username" placeholder="Enter Url"><br>
                                <input type="submit" class="btn join" value="join now">
                            </form>
                        </div>
                        <div class="col-md-6"></div>
                    </div>

                    {{-- <div class="d-flex justify-content-end">
                        <button type="submit" class="btn join btn-md mt-4 mb-4">{{ 'Apply' }}</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
