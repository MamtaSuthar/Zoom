@extends('layouts.user_type.auth')

<style>
    .loader {
        border: 3px solid #f3f3f3;
        border-radius: 50%;
        border-top: 3px solid #3498db;
        width: 50px;
        height: 50px;
        margin: auto;
        /* position: fixed;
        left: 630px;
        top: 300px; */
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .padding {
        padding: 0;
        margin: 0;
    }
</style>

@section('content')
    <div>
        <div class="container-fluid py-4 ">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Create Meeting') }}</h6>



                    <div class="float-right" style="text-align:right; margin-right:12px;">
                        <a href="{{route('meet')}}" class="btn join fl-right">Go Back</a>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="row">
                        {{-- create meetings --}}
                        <div class="col-md-5">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3><b>Premium video meetings. Now free for everyone.</b></h3>
                                    <p>We re-engineered the service that we built for secure business meetings, Google Meet,
                                        to make it free and available for all.</p>
                                    <form id="addSessionForm" method="POST">
                                        @csrf
                                        <input type="hidden" name="meetingtime" value="{{ $time }}" id="meetTime">
                                        <div class="dropdown">
                                            <a type="button" class="btn join " data-bs-toggle="dropdown">
                                                <i class="fas fa-tv"></i>
                                                New Meeting
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a type="submit" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal" onclick="submitsession();">
                                                        <i class="fas fa-link mr-4"></i>
                                                        Create a meeting for later</a>
                                                </li>
                                                {{-- <li><a class="dropdown-item" href="{{ route('googlechat') }}"><i
                                                            class="fas fa-plus"></i> Start an instant meeting</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#"><i class="far fa-calendar"></i>
                                                        Schedule in Google
                                                        Calendar</a></li> --}}
                                            </ul><br>

                                        </div>
                                    </form>

                                    <div class="row">
                                        <h5><b>To join a Meeting Enter code First </b></h5>
                                        <div class="col-md-8">
                                            <input class="form-control" id="codeinput" type="text"
                                                placeholder="Enter a code or link" onkeyup="code();">
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#" id="codebtn" type="button"
                                                class="btn btn-transparant d-none">join</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- space column  --}}
                        <div class="col-md-1"></div>
                        {{-- google meet image --}}
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <img src="https://www.gstatic.com/meet/user_edu_get_a_link_light_90698cd7b4ca04d3005c962a3756c42d.svg"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Here's the link to your meeting</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="loader mt-3"></div>

                                    <p class="d-none" style="font-size:15px;" id="para">Copy this link and send it to
                                        people
                                        that you want to meet
                                        with. Make sure that you save it
                                        so that you can use it later, too.</p>
                                    <input class="form-control d-none" type="text" id="getlink" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="d-flex justify-content-end">
                        <button type="submit" class="btn join btn-md mt-4 mb-4">{{ 'Apply' }}</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function submitsession() {
        event.preventDefault();
        var form = document.getElementById('addSessionForm');
        var formData = new FormData(form);
        $.ajax({
            url: "{{ url('googlechat/') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
                $('#getlink').val(data.data.meet_link);
                $('#para').removeClass('d-none');
                $('#getlink').removeClass('d-none');
                $('.loader').addClass('d-none');
                $('#codebtn').attr('href', data.data.meet_link);
            },
        });
    }
</script>


<script>
    function code() {
        var code = $('#codeinput').val();
        console.log(code);
        $('#codebtn').attr('href', code);
        if (code != '') {
            $('#codebtn').removeClass('d-none');
            $('#codebtn').addClass('btn btn-primary');
            $("#codebtn").prop("disabled", false);
        } else {
            $('#codebtn').removeClass('d-none');
            $("#codebtn").prop("disabled", true);
        }
    }
</script>
