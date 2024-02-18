{{-- @dd($username) --}}
<html>

<head>
    <title> OpenTok Getting Started </title>
    {{-- <script src="https://static.opentok.com/v2/js/opentok.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
   

    #mainvideoelement,#maincontainer{
        background-color: white;
        margin:2%;
        margin-bottom: 1%
    }
    #maincontainer{
        min-height: 80%;
    }

       .container-fluid{
        background-color: black
    }

    .content-wrapper {
        background: rgb(165, 122, 122);
    }


    .OT_widget-container {
        background: transparent !important;
        /* background-color: #eb4d4b !important; */
    }


    #publisher .OT_widget-container {
        background-color: #070707 !important;
    }
   
    #subscriber .OT_widget-container {
        background-color: #979797 !important;
    }

    body:not(.layout-fixed) .main-sidebar {
        height: 100vh !important;
        position: fixed !important;
    }
    body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: black;
    }
    .OT_publisher .OT_edge-bar-item.OT_mode-on,
    .OT_subscriber .OT_edge-bar-item.OT_mode-on,
    .OT_publisher .OT_edge-bar-item.OT_mode-auto.OT_mode-on-hold,
    .OT_subscriber .OT_edge-bar-item.OT_mode-auto.OT_mode-on-hold,
    .OT_publisher:hover .OT_edge-bar-item.OT_mode-auto,
    .OT_subscriber:hover .OT_edge-bar-item.OT_mode-auto,
    .OT_publisher:hover .OT_edge-bar-item.OT_mode-mini-auto,
    .OT_subscriber:hover .OT_edge-bar-item.OT_mode-mini-auto {
        text-align: center;
    }


    .mt-2,
    .my-2 {
        margin-top: 2.5rem !important;
    }


     .leave #leaveButton {
        /* position: absolute; */
        background-color: crimson;
        color: #fff;
        border: 1px solid rgb(190, 185, 185);
        border-radius: 50%;
        padding: 10px;
        font-size: 30px;
    }

     .leave p {
        left: 25px !important;
        margin-left:13px;
        /* position: absolute; */
        color: #fff;
        bottom: -83px;
        font-size: 11px;
    }

     .screen-share #screen-sharing-button {
        border: 1px solid rgb(190, 185, 185);
        border-radius: 50%;
        font-size: 30px;
        padding: 10px;
    }

     .screen-share p {
        position: absolute;
        color: #fff;
        left: 16px;
        bottom: -34px;
        font-size: 11px;
    }

     .video #mute-video-btn {
        border: 1px solid rgb(190, 185, 185);
        border-radius: 50%;
        font-size: 30px;
        padding: 10px;
    }

     .video #unmute-video-btn {
        border: 1px solid rgb(190, 185, 185);
        border-radius: 50%;
        font-size: 30px;
        padding: 10px;
    }

     .video p {
        position: absolute;
        color: #fff;
        bottom: -35px;
        left: 19px;
        font-size: 11px;
    }


     .chat #chat {
        border: 1px solid rgb(190, 185, 185);
        border-radius: 50%;
        font-size: 30px;
        padding: 10px;
    }

     .chat p {
        position: absolute;
        color: #fff;
        left: 28px;
        bottom: -35px;
        font-size: 11px;
    }

    .allbtn {
        height: 400px;
        padding-top: 113px;
    }

    #subscriber .OT_subscriber {
        width: 30%;
        height: 32%;
        position: relative;
        top: 20px;
        margin: 2px;
        border-radius: 6px;
        /* margin:auto; */
    }
    .OT_publisher{
        border-radius: 6px;
        margin:auto;
    }
    #publisher{
        
        width: 30%;
        height: 32%;
        position: relative;
        top: 22px;
        /* margin: 2px; */
        border-radius: 6px;
       
    }

    #subscriber .OT_subscriber video {

        position: absolute;

    }
    #openSidebarMenu {
        display: none;
    }

    .sidebarIconToggle {
        height: 22px;
        width: 22px;
        position: absolute;
        z-index: 99;
        top: 22px;
        left: 15px;
        transition: all 0.3s;
        cursor: pointer;
    }

    .spinner {
        height: 3px;
        background-color: #fff;
        transition: all 0.3s;
    }

    .spinner.middle,
    .spinner.bottom {
        margin-top: 3px;
    }

    #openSidebarMenu:checked~.sidebarIconToggle>.spinner.middle {
        opacity: 0;
    }

    #openSidebarMenu:checked~.sidebarIconToggle>.spinner.top {
        transform: rotate(135deg);
        margin-top: 8px;
    }

    #openSidebarMenu:checked~.sidebarIconToggle>.spinner.bottom {
        transform: rotate(-135deg);
        margin-top: -9px;
    }


    .header {
        background-color: #eb4d4b;
        top: 0;
        left: 0;
        width: 100%;
        height: 60px;
        position: fixed;
        z-index: 10;
        opacity: 0.8;
    }

    #sidebarMenu {
        border: 0.5px solid black;
        /* border-radius: 10px; */
        height: 600px;
        position: fixed;
        /* left: 0; */
        right: 0;
        top: 0;
        width: 370px;
        margin-top: 0px;
        transform: translateX(370px);
        z-index: 2;
        transition: transform 250ms ease-in-out;
        background: #070707;
    }

    #openSidebarMenu:checked~#sidebarMenu {
        transform: translateX(0);
    }

    .main {
        height: 100%;
        margin-top: 60px;
        padding: 10px 50px;
    }

    .menu {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .menu li {
        border-bottom: 1px solid rgba(255, 255, 255, 0.10);
        ;
    }

    .menu li a {
        color: #fff;
        display: block;
        padding: 20px;
        text-transform: uppercase;
        font-weight: bold;
        text-decoration: none;
    }

    .menu h1 {
        color: #dfdfdf
    }

    .myStyle {
        margin-right: 360px;
    }

    /* #mainsubscriber {
        width: 850px;
    } */

    #maincontainer {
        /* box-shadow: 3px 3px 6px #888888; */
        /* margin-right: 389px; */
        margin-top: 30px;
    }

    #subscriber {
        display: flex;
        /* flex-wrap: wrap; */
        flex-direction: row;
    }

    #chatdiv {
        margin-top: 50px;

    }

    #message {
        height: 50px;
    }

    #messages {
        height: 425px;
        overflow: auto;
        background-color: #fff;

    }

    #messages div {
        color: black;
        background-color: white;
        padding: 4px;
        margin: 2px 2px 4px 2px;
        width: 40%;
        word-wrap: break-word;
        border-radius: 5px;


    }

    .sendicon {
        font-size: 30px;
        margin-top: 8px;
    }

    #publisher .OT_name {
        display: none;
    }
    /* .footer{
    background-color: black;
    width: 100%;
    padding: 10px;
    background-color: black;
    position: absolute;
    } */

    .centered {
        color: white;
        position: absolute;
        top: 300%;
        left: 33%;
        transform: translate(-50%, -50%);;
}
</style>

<body>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input type="checkbox" id="openSidebarMenu">
                <label for="openSidebarMenu" class="sidebarIconToggle">

                </label>
                <div id="sidebarMenu">
                    <ul class="menu">
                        <h1
                            style="background-color: black; height: 50px; margin-top:0px; color:white;text-align:center;font-family:Bell MT;">
                            Let's Chat</h1>
                        <div id="messages" height="100%"></div>
                        <div id="chatdiv">
                            <form>
                                <div id="chatinput">
                                    <div class="row">
                                        <div class="col-md-9">

                                            <input type="text" class="form-control" id="message"
                                                aria-describedby="emailHelp" placeholder="Type your message...">

                                        </div>
                                        <div class="col-md-3">
                                            <div class="sendicon">
                                                <button style="background:none;border:none;">
                                                    <i style="color:white"
                                                        class="fa-sharp fa-solid fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="content p-4" id="mainvideoelement">
                    <div class="container-fluid" id="maincontainer">

                        <div class="sub-screen">
                            <div class="row">
                                    <div class="col-md" id="mainsubscriber">
                                    <div id="subscriber">
                                        
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div id="publisher" style="margin-left:15px"></div>
                                                    <div class="centered">    
                                                        <h6>You</h6>    
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                        <div class="col-md-3">
                            <div class="leave">
                                <button id="leaveButton"><i class="fa-solid fa-phone-slash"></i></button>
                                <p>Leave</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="screen-share">
                                <button id="screen-sharing-button"><i
                                        class="fa-sharp fa-solid fa-desktop"></i></button>
                                <p>Share screen</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="video">
                                <button id="mute-video-btn"><i
                                        class="fa-sharp fa-solid fa-video-slash"></i></button>

                                <button id="unmute-video-btn" style="display:none"><i
                                        class="fa-sharp fa-solid fa-video"></i></button>
                                <p>Your Video</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="chat">
                                <button id="chat" type="button" data-mdb-toggle="offcanvas"
                                    data-mdb-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                                        class="fa-solid fa-message"></i></button>
                                <p>Chat</p>
                            </div>
                        </div>

                </div>
            </div>
          
        </div>

    </div>
    <script>
        var zoomedIn = false;
        $(document).on('click', '.OT_video-element', function() {
            
            zoomedIn = !zoomedIn;
            if (zoomedIn) {
                $('.OT_fit-mode-contain').css({
                    'zoom': '200%',
                    'z-index': '50',

                });
            } else {
                $('.OT_fit-mode-contain').css({
                    'zoom': '100%',

                });
            }

        });
        $('#chat').click(function() {
            $('#maincontainer').toggleClass('myStyle');
            var checkbox = $('#openSidebarMenu');
            checkbox.prop('checked', !checkbox.prop('checked'));
        });
    </script>
    <script type="text/javascript">
        // Replace apiKey and sessionId with your own values:
        var session_key = '{{ $session_token }}';
        var api_key = '{{ env('OPENTOK_API_KEY') }}';
        var token = '{{ $opentok_token }}';
        var username = '{{ $username }}';


        let alreadySubscribed = false;
        session = OT.initSession(api_key, session_key);
        session.on("streamCreated", function(event) {
            subscriber = session.getSubscribersForStream(event.stream);
            var subscriberName = event.stream.name;
            for (let subscribers of subscriber) {
                if (subscriber.stream.connection.streamId === event.stream.connection.streamId) {
                    alreadySubscribed = true;
                }
            }
            if (!alreadySubscribed) {
                var subscriberOptions = {
                    insertMode: 'append',
                    publishAudio: false,
                    // publishVideo: false,
                    // width: '150px',
                    // height: '150px',
                    name: subscriberName // Set the subscriber name here
                };
                session.subscribe(event.stream, 'subscriber', subscriberOptions);
                publisherfunc(event.stream.name);
            }
        });

        var publisher = OT.initPublisher('publisher', {
                insertMode: 'append',
                // width: '100%',
                // height: '100%',
                publishAudio: false,
                // publishVideo: false,
                buttonDisplayMode: 'off',
                name: username,
            },
            error => {
                if (error) {
                    alert(error.message);
                }
            });
        session.connect(token, function(error) {
            console.log(session.connection)
            if (error) {
                alert('Unable to connect: ', error.message);
            } else {
                if (session.capabilities.publish === 1) {
                    session.publish(publisher);
                } else {
                    alert("You cannot publish an audio-video stream.");
                }
            }
        });


        // chat functionality
        var messageForm = document.querySelector("form");
        var messageInput = document.querySelector("#message");
        var messagesContainer = document.querySelector("#messages");
        // var name = document.querySelector("#username");

        //   send chat msg
        messageForm.addEventListener("submit", function(event) {
            event.preventDefault();
            console.log(event)
            var message = messageInput.value;
            var name = username;
            var data = {
                "text": message,
                "name": name,
            };
            console.log(data);

            session.signal({
                type: "chat",
                data: JSON.stringify(data),
            });
            messageInput.value = "";
        });

        // Receive chat messages
        session.on("signal:chat", function(event) {
            var data = JSON.parse(event.data);
            var message = document.createElement("div");
            var yourname = document.createElement("span");
            var time = document.createElement("span");
            yourname.style.cssText = "color: white; margin: 0px 10px;";
            time.style.cssText = "color: gray;";
            var senderName = data.name;
            message.textContent = data.text;
            yourname.textContent = data.name;

            // Create a new Date object
            const currentTime = new Date();
            // Get the current time components
            const hours = currentTime.getHours();
            const minutes = currentTime.getMinutes();
            const timeString = `${hours}:${minutes}`;
            time.textContent = timeString;
            messagesContainer.appendChild(yourname);
            messagesContainer.appendChild(time);
            messagesContainer.appendChild(message);
        });



        //for leave the call
        var leaveCallButton = document.getElementById("leaveButton");
        leaveCallButton.addEventListener("click", function() {
            session.disconnect();
        });

        // Screen sharing
        var screenSharingButton = document.getElementById("screen-sharing-button");
        screenSharingButton.addEventListener("click", function(event) {
            console.log(event);
            OT.registerScreenSharingExtension("chrome", "<your_extension_id>");
            var screenSharingPublisher = OT.initPublisher("screen-sharing", {
                videoSource: "screen",
                // width: "100%",
                // height: "100%"
            });
            session.publish(screenSharingPublisher, function(error) {
                if (error) {
                    console.log("Error publishing screen sharing:", error.message);
                } else {
                    console.log("Screen sharing published");
                }
            });
        });

        // video mute and unmute
        var muteBtn = document.getElementById('mute-video-btn');
        var unmuteBtn = document.getElementById('unmute-video-btn');
        // Add event listeners to the buttons
        muteBtn.addEventListener('click', function() {
            publisher.publishVideo(false);
            $('#unmute-video-btn').show();
            $('#mute-video-btn').hide();
        });

        unmuteBtn.addEventListener('click', function() {
            publisher.publishVideo(true);
            $('#mute-video-btn').show();
            $('#unmute-video-btn').hide();
        });
    </script>
    <script></script>
</body>

</html>
