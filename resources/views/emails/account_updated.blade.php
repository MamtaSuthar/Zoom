<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Warriorrising</title>
      <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
   </head>
   <body style="background-color:#ffffff; font-family: 'Roboto', sans-serif;">
      <div style="width:575px; margin:30px auto;padding:0px 25px; background-color:#f9f9f9; border-top:4px solid #e40303">
         <div style="text-align:center; margin:25px;">
            <img src="{{asset('public/assets/img/fevicon.jpg')}}" class="logo" alt="team_conference" height="50" width="50"/> 
         </div>
         <div style="padding:0px 0px 40px; display: inline-block;">
            <div>
               <img src="{{asset('public/assets/img/banner-emp.png')}}" alt="img" width="100%" style=""/>
            </div>
            <div style="background-color:#fff;padding: 0px 20px 10px; overflow: hidden;">
               <p style="text-align:left; font-size:16px; font-weight:800; color:#353535; padding-top:30px; margin-bottom:2px;margin-top: 0px;">Hi {{$details->name}},</p>
               <p style="text-align:left; font-size:16px; font-weight:400; color:#353535; padding-top:30px; margin-bottom:10px;margin-top: 0px;">We are delighted to inform you that your account has been <b>updated</b> by our administration team. Welcome to <b>{{(env('APP_NAME'))}}</b>! We appreciate your presence as part of our community.</p>

               <div style="display: inline-block;width: 100%;padding:0px; border:1px solid #eaeaea">
                  <h2 style="border-bottom: 2px solid #e6e6e6;margin: 0px;padding:10px;font-size: 16px;font-weight: 500;">Employee Details</h2>
                  <div style="display:flex; flex-wrap:wrap; padding:10px 0px;">
                     <div style="width:29%;float:left;padding:10px;">
                        <h5 style="margin: 0px 0px 5px;color:#7e7e7e;font-weight: 400;font-size: 13px;">Employee ID</h5>
                        <p style="margin: 0px;color: #484747;font-size: 14px;font-weight: 500;">{{$details->emp_id}}</p>
                     </div>     
                     <div style="width:29%;float:left;padding:10px;">
                        <h5 style="margin: 0px 0px 5px;color:#7e7e7e;font-weight: 400;font-size: 13px;">Name</h5>
                        <p style="margin: 0px;color: #484747;font-size: 14px;font-weight: 500;">{{$details->name}}</p>
                     </div>     
                     <div style="width:29%;float:left;padding:10px;">
                        <h5 style="margin: 0px 0px 5px;color:#7e7e7e;font-weight: 400;font-size: 13px;">Email</h5>
                        <p style="margin: 0px;color: #484747;font-size: 14px;font-weight: 500;">{{$details->email}}</p>
                     </div>   
                     <div style="width:29%;float:left;padding:10px;">
                        <h5 style="margin: 0px 0px 5px;color:#7e7e7e;font-weight: 400;font-size: 13px;">Phone</h5>
                        <p style="margin: 0px;color: #484747;font-size: 14px;font-weight: 500;">+91{{$details->phone}}</p>
                     </div>             
                     <div style="width:29%;float:left;padding:10px;">
                        <h5 style="margin: 0px 0px 5px;color:#7e7e7e;font-weight: 400;font-size: 13px;">Department</h5>
                        <p style="margin: 0px;color: #484747;font-size: 14px;font-weight: 500;">{{$details->designation}}</p>
                     </div>
                     <div style="width:29%;float:left;padding:10px;">
                        <h5 style="margin: 0px 0px 5px;color:#7e7e7e;font-weight: 400;font-size: 13px;">Adress</h5>
                        <p style="margin: 0px;color: #484747;font-size: 14px;font-weight: 500;">{{$details->location}}</p>
                     </div>
                    
                  
                     {{-- <div style="width:29%;float:left;padding:10px;">
                        <h5 style="margin: 0px 0px 5px;color:#7e7e7e;font-weight: 400;font-size: 13px;">Password</h5>
                        <p style="margin: 0px;color: #484747;font-size: 14px;font-weight: 500;">will898977</p>
                     </div> --}}
                  </div>
               </div>
               <p style="text-align:left; font-size:15px; font-weight:600; color:#353535; margin-bottom: 5px; margin-top:20px; padding-bottom:30px;line-height:25px;border-bottom: 1px solid #e5e5e5;">Please click <a href="{{route('staff.password_reset',$details->token)}}">here</a> to complete your profile.</p>
               <div style="width:50%; float:left;">
                  <p style="font-size:14px; font-weight:400; color:#353535;margin-bottom: 5px;">{{(env('APP_NAME'))}}.com</p>
               </div>
               {{-- <div style="width:50%;float:left;">
                  <ul style="width:100%;list-style:none; padding:0px; text-align:right;">
                     <li style="margin-right:5px;float:right;"><a href="javascript:void(0);"><img src="{{asset('public/assets/img/fb.png')}}" alt="social" /></a></li>
                     <li style="margin-right:5px;float:right;"><a href="javascript:void(0);"><img src="{{asset('public/assets/img/tw.png')}}" alt="social" /></a></li>
                     <li style="margin-right:5px;float:right;"><a href="javascript:void(0);"><img src="{{asset('public/assets/img/lnk.png')}}" alt="social"/></a></li>
                  </ul>
               </div> --}}
            </div>
         </div>
      </div>
   </body>
</html>