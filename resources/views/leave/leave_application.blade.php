@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4 col-lg-6">
        <a href="{{url('leave')}}" class="btn join btn-sm mb-3" type="button"><i class="fas fa-arrow-left"></i></a>
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Apply for leave') }}</h6>
            </div>
            <div class="card-body pt-4">
                <form class="forms-sample" action="{{route('leave.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col">
                            <label for="start_date">{{__('Start Date')}}</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value={{\Carbon\Carbon ::now()->toDateString()}}>
                        </div>
            
                        <div class="form-group col">
                            <label for="end_date">{{__('End Date')}}</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{old('end_date')}}">
                        </div>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="leave_type" id="leave_type1" value="First Half">
                        <label class="form-check-label" for="exampleRadios1">
                        {{__('First Half')}}
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="leave_type" id="leave_type2" value="Second Half">
                        <label class="form-check-label" for="exampleRadios2">
                            {{__('Second Half')}}
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="leave_type" id="leave_type3" value="Full Day">
                        <label class="form-check-label" for="exampleRadios3">
                            {{__('Full Day')}}
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="reason">{{__('Reason for leave')}}</label>
                        <textarea class="form-control @error('reason') is-invalid @enderror" name="reason" id="reason" rows="3">{{old('reason')}}</textarea>
                    </div>
                 
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-blue btn-md mt-4 mb-4">{{ 'Apply' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection