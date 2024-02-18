@extends('layouts.user_type.auth')

@section('content')
<style>
    .chatbot-sidebar{
        width: 350px;
    height: 100%;
    float: left;
    -webkit-transition: all 0.3s ease-out 0s;
    -moz-transition: all 0.3s ease-out 0s;
    -ms-transition: all 0.3s ease-out 0s;
    -o-transition: all 0.3s ease-out 0s;
    transition: all 0.3s ease-out 0s;
    }
    .chatbot-body {
        /* float: right; */
        height: 100%;
        overflow: hidden;
        position: relative;
        padding: 0px;
        border-left: 1px solid #ddd;
        background: #fff;
    }
    .chatbot-sidebar .chat-me .chat-me-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #fff;
    }
     .chat-avatar img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #fff;
    }
    .chatbot-sidebar .chat-me {
    width: 100%;
    display: inline-block;
    padding: 0px 10px;
    border-bottom: 1px solid #ddd;
    height: 60px;
    line-height: 60px;
}
.chat-user-search {
    width: 100%;
    padding: 5px 10px;
}
.chat-user-search input.user-search {
    width: 100%;
    border: 1px solid #ddd;
    padding: 6px 10px;
}
.chatbot-sidebar .chat-me .chat-me-avatar {
    float: left;
    width: 40px;
    position: relative;
}
.chatbot-sidebar .chat-me .me-name {
    width: calc(100% - 80px);
    float: left;
    padding-left: 10px;
    font-size: 18px;
    font-weight: 600;
}
.online .fa {
    color: #1cc88a !important;
    font-size: 10px;
}
.offline .fa {
    color: #c8c8c7 !important;
}
.chatbot-sidebar .chat-me .chat-me-avatar .online-status {
    bottom: 0;
    position: absolute;
    right: 0;
}
.chatbot-sidebar .sidebar-user-list {
    height: auto;
    min-height: calc(100% - 150px);
    max-height: calc(100% - 150px);
    overflow-y: scroll;
    overflow-x: hidden;
}
.chatbot-sidebar ul.chatbot-list {
    width: 100%;
    float: left;
}
ul.chatbot-list li {
    padding: 8px 10px;
    overflow: hidden;
    width: 100%;
    cursor: pointer;
}
ul.chatbot-list li .chat-avatar .online-status {
    bottom: 0;
    position: absolute;
    right: 0;
}
ul.chatbot-list li .chat-avatar {
    float: left;
    width: 40px;
    position: relative;
}
ul.chatbot-list li .chat-user-info {
    width: calc(100% - 40px);
    float: left;
    padding-left: 10px;
}
ul.chatbot-list li .chat-user-info .chat-name {
    position: relative;
}
ul.chatbot-list li .chat-user-info .chat-preview {
    font-size: 12px;
    line-height: 18px;
    color: #a2a2a2;
}
.chatbot-welcome {
    padding: 150px 10px 100px 10px;
    text-align: center;
    -webkit-transition: all 0.3s ease-out 0s;
    -moz-transition: all 0.3s ease-out 0s;
    -ms-transition: all 0.3s ease-out 0s;
    -o-transition: all 0.3s ease-out 0s;
    transition: all 0.3s ease-out 0s;
}
.chatbot-welcome .wl-avatar {
    width: 100px;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
}
.chatbot-welcome .wl-avatar {
    width: 100px;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
}
.chatbot-welcome .wl-avatar img {
    width: 100px;
    height: 100px;
    border: 2px solid #ddd;
    border-radius: 50%;
}
.chatbot-welcome .wl-avatar .online-status {
    position: absolute;
    right: 18px;
    bottom: 0;
}
.btn-show-hide {
    float: left;
    margin-left: 20px;
    margin-right: 5px;
}
.chatbot-body .chatbot-header .contact-profile {
    float: left;
    margin-left: 15px;
}
.chatbot-body .chatbot-header {
    width: 100%;
    height: 60px;
    line-height: 60px;
    border-bottom: 1px solid #ddd;
    position: relative;
}
.chatbot-body .chatbot-header .contact-profile img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #f4f4f4;
}
.chatbot-body .chatbot-header .contact-name {
    font-size: 18px;
    margin-left: 8px;
    float: left;
    font-weight: 600;
}
ul.pik_icon {
    float: right;
    margin: 4px 12px 0px 0px;
}
.msgSearchBox {
    float: right;
    line-height: 22px;
    position: absolute;
    bottom: -45px;
    right: 0;
    left: 0;
    background: #d5eef9;
    padding: 5px;
    width: 95%;
    margin: 0 auto;
    z-index: 99999999;
    visibility: hidden;
    opacity: 1;
    -webkit-transition: all 0.3s ease-out 0s;
    -moz-transition: all 0.3s ease-out 0s;
    -ms-transition: all 0.3s ease-out 0s;
    -o-transition: all 0.3s ease-out 0s;
    transition: all 0.3s ease-out 0s;
}

.chatbot-body .chatbot-content {
    height: auto;
    /* min-height: calc(100% - 146px); */
    max-height: calc(100% - 146px);
    overflow-y: scroll;
    overflow-x: hidden;
    padding-left: 15px;
    padding-right: 15px;
    width: 100%;
}
.chatbot-body .chatbot-footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    z-index: 99;
    padding: 20px 30px;
    background: #fff;
    border-top: 1px solid #ddd;
}
.relative {
    position: relative;
}
.tw-loader {
    width: 80px;
    margin: 0 auto;
    overflow: hidden;
}
.chatbot-footer .chat-box {
    float: left;
    width: calc(100% - 55px);
    position: relative;
    margin-right: 15px;
}
.chatbot-footer .chat-files {
    width: 40px;
    height: auto;
    float: left;
    margin-top: 1px;
}
.message-bubble .message-bubble-inner .message-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #f4f4f4;
}
.chatbot-footer .chat-box {
    float: left;
    width: calc(100% - 55px);
    position: relative;
    margin-right: 15px;
}
a.newer_msg {
    position: absolute;
    left: 0;
    right: 0;
    width: 160px;
    height: auto;
    background: #fff;
    border: 1px solid #ddd;
    text-align: center;
    padding: 5px 5px;
    border-radius: 20px;
    z-index: 999;
    margin: 0 auto;
    line-height: 22px;
    color: #686868;
}
.chatbot-footer .chat-files {
    width: 40px;
    height: auto;
    float: left;
    margin-top: 1px;
}
.card .card-body input, .form-group input, input.form-control, .form-group textarea, .card .card-body textarea {
    padding: 10px 15px;
    -webkit-border-radius: 0px;
    border-radius: 0px;
    border-color: #dddddd;
    font-size: 14px;
}
.chatbot-footer .chat-box input.message {
    width: 100%;
    background: #f7f7f7;
    border-radius: 20px;
    padding: 10px 55px 10px 20px;
    position: relative;
    border-style: solid;
    border-width: 1px;
} 
.chat-box button.chat-submit {
    position: absolute;
    top: 0px;
    bottom: 0px;
    right: 0px;
    border: none;
    border-radius: 20px;
    padding: 10px 11px;
    cursor: pointer;
    width: 42px;
}
.chatbot-footer .chat-files .chat-file {
    float: left;
    background: #0d395c;
    height: 40px;
    width: 40px;
    line-height: 40px;
    text-align: center;
    border-radius: 50%;
    border-style: solid;
    border-width: 1px;
    margin-bottom: 0px;
}
.message-bubble-inner{
    text-align:right;
}
.relative {
    position: relative;
}
#message_list{
    margin-bottom:15%
}
.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right,.chatdiv img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}


.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
</style>

<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body chatbot-area p-0">
						<div class="chatbot-sidebar">
							<div class="chat-me">
								<a class="btnShowLeft userSidebarCollapse" href="javascript:void(0);"></a>
								<div class="chat-me-avatar">
                                    <img src="{{(Auth::user()->profile_pic)==''?asset(env('AdMINPROFILE')):asset('public/assets/profile_pic/'.Auth::user()->profile_pic)}}" alt="">
									<div class="online-status online"><i class="fa fa-circle"></i></div>
								</div>
								<div class="me-name">{{ucfirst(Auth::user()->name)}}</div>
							</div>
							<div class="chat-user-search">
                                <select id="chatUserSearch" name="chatUserSearch" onchange="myfun()" class="user-search form-select form-select-sm" placeholder="Search..">
                                    <option value="" selected disabled>Select</option>
                                    @foreach($data as $d)
                                    <option value="{{$d->uuid}}">{{$d->name}}</option>
                                    @endforeach
                                </select>
							</div>
							<div id="user_loader" class="tw-loader" style="display: none;">
								<div class="tw-ellipsis">
									<div></div><div></div><div></div><div></div>
								</div>						
							</div>
							<div class="sidebar-user-list">
								<ul class="chatbot-list" id="chat-users">
                                </ul>
							</div>
						</div>
						<div class="chatbot-body" id="welcome_id">
							<a class="btn-show-hide wl-Collapse userSidebarCollapse" href="javascript:void(0);"><i class="fa fa-exchange"></i></a>
							<div class="chatbot-welcome" >
								<h3>Welcome, {{ucfirst(Auth::user()->name)}}</h3>
								<div class="wl-avatar">
                                    <img src="{{(Auth::user()->profile_pic)==''?asset(env('AdMINPROFILE')):asset('public/assets/profile_pic/'.Auth::user()->profile_pic)}}" alt="">
									<div class="online-status online"><i class="fa fa-circle"></i></div>
								</div>
							</div>
						</div>
						<div class="chatbot-body d-none" id="message_chatbot" >
							<div class="chatbot-header">
								<a class="btn-show-hide userSidebarCollapse" href="javascript:void(0);">
                                    <i class="fa fa-exchange zoomicon" aria-hidden="true"></i>
                                </a>
								<div id="connect_user"><div class="contact-profile"><img class="contact_pic" src="{{asset(env('AdMINPROFILE'))}}"></div><div class="contact-name"></div></div>
							
								<div id="msgSearchBox_collapse" class="msgSearchBox">
									<input class="msgSearch" id="msgSearch" name="msgSearch" type="text" placeholder="Search..">
								</div>
								<a href="javascript:void(0);" id="older_msg" class="older_msg d-none" style="display: none;">Older Messages</a>
							</div>

							<ul class="chatbot-content" id="message_list">
                                
                           </ul>
							
							<div class="chatbot-footer">
								<div class="relative">
									<a href="javascript:void(0);" id="newer_msg" class="newer_msg d-none" style="display: none;">Newer Messages</a>
								</div>
								<div id="file_loader" class="tw-loader d-none">
									<div class="tw-ellipsis">
										<div></div><div></div><div></div><div></div>
									</div>						
								</div>
								<div class="chat-box">
									<form method="POST" id="chat_formid" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
										<input type="text" class="message" id="message" name="message" placeholder="Type a message">
										<button type="button" class="chat-submit join" onclick="chatsubmit()" id="chat_submit"><i class="fa fa-paper-plane-o"></i></button>
                                        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->uuid}}">
                                        <input type="hidden" id="receiver_id" name="receiver_id" >
                                        <input type="file" name="chat_mes_file[]" id="chat_mes_file" class="d-none" multiple="multiple" accept=".png,.jpg,.jpeg,.gif,.pdf,.csv">
									</form>
									
								</div>
								<div class="chat-files">
									<label for="chat_mes_file" class="chat-file" title="Attach files"><i class="fa fa-paperclip"></i></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection

@push('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-----Firebase----->
<script type="text/javascript" src="{{ asset('/public/js/firestore-config.js')}}"></script>

<script>

    $(document).ready(function() {
        getlist();
    });

    // Get Recivers Lists
        function getlist(){
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: "{{ route('getuserlist') }}",
                        type: "post",
                        
                        success: function(data) {
                            console.log(data);
                            $(".chatbot-list").html("");
                            $.each(data.data, function(key,val) {
                               
                                if(val.profile_pic!='' && val.profile_pic!=null ){
                                var image = `{{asset('public/assets/profile_pic/${val.profile_pic}') }}`;
                                }else{
                                    var image = `{{asset(env('AdMINPROFILE')) }}`;
                                }

                                $(".chatbot-list").append(` <li class="chat_user_active" id="chat_user_${val.id}" onclick="mychat('${val.uuid}')" >
                                                <div class="chat-avatar">
                                                    <img src="${image}" alt="">
                                                    <div class="online-status online"><i class="fa fa-circle"></i></div>
                                                </div>
                                                <div class="chat-user-info ">
                                                    <div class="chat-name">${val.name}</div>
                                                    <div class="chat-preview"></div>
                                                </div>
                                            </li>`)
                            });

                        }
                });
        }
      
    // On click Select Users
        function myfun(id){
            var id = $("#chatUserSearch").val();
            mychat(id);
        }

    // On click Users
        function mychat(id){
            $("#receiver_id").val(id);
            $("#message_chatbot").removeClass('d-none');
            $("#welcome_id").addClass('d-none');
            $(".contact-name").html(""); 
            $(".contact_pic").html("");
            $(".contact_pic").attr("src",'');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ route('getchat') }}",
                    type: "post",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        console.log(data);

                        $("#message_list").html("");
                        $(".contact-name").append(data.userdata.name);
                    
                        if(data.userdata.profile_pic!='' && data.userdata.profile_pic!=null ){
                            var image = `{{asset('public/assets/profile_pic/${data.userdata.profile_pic}') }}`;
                        }else{
                            var image = `{{asset(env('AdMINPROFILE')) }}`;
                        }
                            
                        $(".contact_pic").attr("src",image);

                        if(data.userdata.profile_pic!='' && data.userdata.profile_pic!=null ){
                            var image1 = `{{asset('public/assets/profile_pic/${data.userdata.profile_pic}') }}`;
                        }else{
                            var image1 = `{{asset(env('AdMINPROFILE')) }}`;
                        }

                        $.each(data.data, function(key,val) {
                            
                           if(val.status==1){

                                $("#message_list").append(`<li>
                                <div class="container ${val.message == null ? 'd-none' : ''}">
                                    <img src="${image}" alt="Avatar" style="width:100%;">
                                    <p>${val.message}</p>
                                    <span class="time-right">${val.sent_at}</span>
                                </div>
                                <div class="chatdiv ${val.chat_mes_file == undefined ? 'd-none' : ''}">

                                    ${val.chat_mes_file && (val.chat_mes_file.split('.')[1] =='jpg' || val.chat_mes_file.split('.')[1] =='jpeg' || val.chat_mes_file.split('.')[1] =='png' || val.chat_mes_file.split('.')[1] =='gif') ?
                                        `<img class="chat_image" src="{{asset('public/assets/chat_mes_file')}}/${val.chat_mes_file}" alt="Avatar" style="width:30%;">` :
                                        `<embed src="{{asset('public/assets/chat_mes_file')}}/${val.chat_mes_file}" width="70%" height="30%"/>`
                                    }
                                    <span class="time-right">${val.sent_at}</span>
                                </div>
                            </li>`);

                            }else{

                                $("#message_list").append(`<li>
                                <div class="container darker ${val.message == null ? 'd-none' : ''}">
                                    <img src="${image1}" alt="Avatar" style="width:100%;" class="right">
                                    <p>${val.message}</p>
                                    <span class="time-left">${val.sent_at}</span>
                                </div>
                                <div class="chatdiv ${val.chat_mes_file == undefined ? 'd-none' : ''}">
                                    
                                    ${val.chat_mes_file && (val.chat_mes_file.split('.')[1] =='jpg' || val.chat_mes_file.split('.')[1] =='jpeg' || val.chat_mes_file.split('.')[1] =='png' || val.chat_mes_file.split('.')[1] =='gif') ?
                                        `<img class="chat_image" src="{{asset('public/assets/chat_mes_file')}}/${val.chat_mes_file}" alt="Avatar"  class="right" style="width:30%;">` :
                                        `<embed src="{{asset('public/assets/chat_mes_file')}}/${val.chat_mes_file}" width="70%" height="30%"  class="right"/>`
                                    }
                                </div>
                            </li>`);

                            }
                                            
                        });

                    }
                })
        }

    // Send Maassege
        function chatsubmit() {

            var message = $("#message").val();
            if(message==null){
                message='';
            }
            var chat_mes_file = $('#chat_mes_file')[0].files[0];
            if(chat_mes_file == undefined){
                chat_mes_file = '';
            }
            var receiver_id = $("#receiver_id").val();
            var user_id = $("#user_id").val();

            var formData = new FormData();
            formData.append('message', message);
            formData.append('user_id', user_id);
            formData.append('receiver_id', receiver_id);
            formData.append('chat_mes_file', chat_mes_file);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('sendMessage') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                   
                        if(data.success==true){

                            if(data.data.sender_pic!='' && data.data.sender_pic!=null ){
                            var image = `{{asset('public/assets/profile_pic/${data.data.sender_pic}') }}`;
                            }else{
                                var image = `{{asset(env('AdMINPROFILE')) }}`;
                            }

                            $("#message_list").append(`<li>
                                <div class="container ${message == '' ? 'd-none' : ''}">
                                    <img src="${image}" alt="Avatar" style="width:100%;">
                                    <p>${message}</p>
                                    <span class="time-right">${data.data.sent_at}</span>
                                </div>
                                <div class="chatdiv ${chat_mes_file == undefined ? 'd-none' : ''}">

                                    ${chat_mes_file.name && (chat_mes_file.name.split('.')[1] =='jpg' || chat_mes_file.name.split('.')[1] =='jpeg' || chat_mes_file.name.split('.')[1] =='png' || chat_mes_file.name.split('.')[1] =='gif') ?
                                        `<img class="chat_image" src="{{asset('public/assets/chat_mes_file')}}/${chat_mes_file.name}" alt="Avatar" style="width:30%;">` :
                                        `<embed src="{{asset('public/assets/chat_mes_file')}}/${chat_mes_file.name}" width="70%" height="30%"/>`
                                    }
                                    
                                    <span class="time-right">${data.data.sent_at}</span>
                                </div>
                            </li>`);
                            
                        }
                        $("#message").html("");
                        $("#message").val("");
                        $("#chat_mes_file").html("");
                        $("#chat_mes_file").val("");
                        getlist();
                    },

                error: function (xhr, status, error) {
                    var errors = JSON.parse(xhr.responseText);
                    console.log(errors.errors);
                    toastr.error(errors.errors.message[0]);
                }
            });
        }
</script>

@endpush