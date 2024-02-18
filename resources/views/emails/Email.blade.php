{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zoom Meeting</title>
</head>

<body style="margin: 0px;">
<h1>Your Meeting Is Scheduled.</h1>
<br>
<p>{{ $details['user'] }} is iviting you to a scheduled Zoom Meeting.</p>
<br>

<p>Topic : {{ $details['topic'] }}</p>
<p>Time : {{ $details['time'] }}</p>
<br>

<p>join Meeting</p>
<p>URL: {{ $details['join_url'] }}</p>
<br>

<p>Meeting ID: {{ $details['id'] }}</p>
<p>Password: {{ $details['pass'] }}</p>
<p>TimeZone: {{ $details['timezone'] }}</p>
</body>

</html> --}}



<!DOCTYPE html>

<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><!--[if !mso]><!-->
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css?family=Quattrocento" rel="stylesheet" type="text/css"/><!--<![endif]-->
<style>
		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 0;
		}

		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: inherit !important;
		}

		#MessageViewBody a {
			color: inherit;
			text-decoration: none;
		}

		p {
			line-height: inherit
		}

		.desktop_hide,
		.desktop_hide table {
			mso-hide: all;
			display: none;
			max-height: 0px;
			overflow: hidden;
		}

		.image_block img+div {
			display: none;
		}

		@media (max-width:700px) {
			.desktop_hide table.icons-inner {
				display: inline-block !important;
			}

			.icons-inner {
				text-align: center;
			}

			.icons-inner td {
				margin: 0 auto;
			}

			.row-content {
				width: 100% !important;
			}

			.mobile_hide {
				display: none;
			}

			.stack .column {
				width: 100%;
				display: block;
			}

			.mobile_hide {
				min-height: 0;
				max-height: 0;
				max-width: 0;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide,
			.desktop_hide table {
				display: table !important;
				max-height: none !important;
			}
		}
	</style>
</head>
<body style="background-color: #cbb6b4; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
<table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #cbb6b4; background-image: none; background-position: top left; background-size: auto; background-repeat: no-repeat;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; background-position: center top;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 680px;" width="680">
<tbody>
<tr>
<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
<div class="spacer_block block-1" style="height:30px;line-height:30px;font-size:1px;"> </div>
<table border="0" cellpadding="15" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
<tr>
<td class="pad">
<div style="font-family: sans-serif">
<div class="" style="font-size: 14px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 21px; color: #000; line-height: 1.5;">
<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 25.5px; letter-spacing: 6px;"><span style="font-size:17px;"><strong>{{env('APP_NAME')}}</strong></span></p>
</div>
</div>
</td>
</tr>
</table>
<br>


	<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation"  style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
		<tr>
			<td class="pad" style="padding-bottom:15px;padding-left:30px;padding-right:30px;padding-top:10px;">
				<div style="font-family: sans-serif">
					<div class="" style="font-size: 14px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; 
					mso-line-height-alt: 21px; color: #000; line-height: 1.5;">
						@if($details['type']=='add')
							<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">{{ $details['user'] }} Is Inviting You In A Scheduled Zoom Meeting.</p>
						@elseif($details['type']=='edit')
							<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">{{ $details['user'] }}  Scheduled Zoom Meeting Has Been Changed.</p>
						@else
						<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">{{ $details['user'] }}  Scheduled Zoom Meeting Has Been Chanceled.</p>
						@endif
					</div>
				</div>
			</td>
		</tr>
	</table>

	@if($details['type']=='edit' || $details['type']=='add')
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		</tbody>
		</table>
		<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;" width="100%">
		<tbody>
		<tr>
		<td>
		<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 680px;" width="680">
		<tbody>
		<tr>
		<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" class="heading_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
		<tr>
		{{-- <td class="pad" style="width:100%;text-align:center;">
		<h1 style="margin: 0; color: #555555; font-size: 15px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: 700; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">Topic :  {{ $details['topic'] }}</span></h1>
		</td> --}}
		</tr>
		</table>
		<table border="0" cellpadding="0" cellspacing="0" class="heading_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
		<tr>
		<td class="pad" style="width:100%;text-align:center;">
		<h1 style="margin: 0; color: #555555; font-size: 15px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: 700; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">Date And Time  : {{ $details['date'] }} {{ $details['time'] }} </span></h1>
		</td>
		</tr>
		</table>
		<br>
		<table border="0" cellpadding="0" cellspacing="0" class="heading_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
		<tr>
		<td class="pad" style="width:100%;text-align:center;">
		<h1 style="margin: 0; color: #555555; font-size: 15px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: 700; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder"></span></h1>
		</td>
		</tr>
		</table>
		<br>
		<table border="0" cellpadding="0" cellspacing="0" class="heading_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
		<tr>
		<td class="pad" style="width:100%;text-align:center;">
		<h1 style="margin: 0; color: #555555; font-size: 15px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: 700; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">Join Meeting Via Click On Below Link</span></h1>
		</td>
		</tr>
		</table>
		<br>
		<table border="0" cellpadding="0" cellspacing="0" class="heading_block block-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
		<tr>
		<td class="pad" style="width:100%;text-align:center;">
		<h1 style="margin: 0; color: #555555; font-size: 15px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: 700; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">{{ $details['join_url'] }}</span></h1>
		</td>
		</tr>
		</table>
		<br>
		{{-- <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
		<tr>
		<td class="pad" style="width:100%;text-align:center;">
		<h1 style="margin: 0; color: #555555; font-size: 15px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: 700; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder"></span></h1>
		</td>
		</tr>
		</table> --}}
		<br>
		{{-- <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
		<tr>
		<td class="pad" style="width:100%;text-align:center;">
		<h1 style="margin: 0; color: #555555; font-size: 15px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: 700; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">Meeting Id :{{ $details['id'] }}</span></h1>
		</td>
		</tr>
		</table> --}}
		{{-- <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-8" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
		<tr>
		<td class="pad" style="width:100%;text-align:center;">
		<h1 style="margin: 0; color: #555555; font-size: 15px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: 700; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">Password :{{ $details['pass'] }}</span></h1>
		</td>
		</tr>
		</table> --}}
		{{-- <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-8" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
			<tr>
			<td class="pad" style="width:100%;text-align:center;">
			<h1 style="margin: 0; color: #555555; font-size: 15px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: 700; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">TimeZone :{{ $details['timezone'] }}</span></h1>
			</td>
			</tr>
			</table>
			<br>
		</td>
		</tr>
		</tbody>
		</table> --}}

	@else
		<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td class="pad" style="padding-bottom:15px;padding-left:30px;padding-right:30px;padding-top:10px;">
			<div style="font-family: sans-serif">
			<div class="" style="font-size: 14px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; 
			mso-line-height-alt: 21px; color: #000; line-height: 1.5;">
			<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;"> Scheduled Zoom Meeting for {{$details['date']}} at {{$details['time']}} by {{$details['user']}} has been canceled.</p>
			</div>
			</div>
			</td>
			</tr>
			</table>
	@endif

</td>
</tr>
</tbody>
</table>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
<tbody>
<tr>
<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
<table border="0" cellpadding="0" cellspacing="0" class="icons_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td class="pad" style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;">
<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td class="alignment" style="vertical-align: middle; text-align: center;"><!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
<!--[if !vml]><!-->
<table cellpadding="0" cellspacing="0" class="icons-inner" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;"><!--<![endif]-->
<tr>
<td style="vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 6px;"><a href="{{env('APP_URL')}}" style="text-decoration: none;" target="_blank"><img align="center" alt="Designed with BEE" class="icon" height="32" src="{{ asset(env('LOGO')) }}" style="display: block; height: auto; margin: 0 auto; border: 0;" width="34"/></a></td>
<td style="font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; font-size: 15px; color: #0d395c; vertical-align: middle; letter-spacing: undefined; text-align: center;"><a href="{{env('APP_URL')}}" style="color: #0d395c; text-decoration: none;" target="_blank">{{env('APP_NAME')}}</a></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table><!-- End -->
</body>
</html>