<?php

namespace App\Traits;
use GuzzleHttp\Client;
use Log;
use App\Models\ZoomApi;
use App\Models\Zoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

/**
 * trait ZoomMeetingTrait
 */
trait ZoomMeetingTrait
{
    public $client;
    public $jwt;
    public $headers;

    public function checkvaliditiy($type,$details)
    {
       
        if($type==0){
            $secret = $details['api_secret'];
            $payload = [
                'iss' => $details['api_key'],
                'exp' => strtotime('+1 minute'),
            ];
            $token =  \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
        }else{
            $token = $this->generateZoomToken();
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.zoom.us/v2/users/me');
    
        if ($response->ok()) {
            // API keys are valid
            $userData = $response->json();
            return $userData;
        } else {
            // API keys are invalid
            $error = $response->json();
            return $error;
        }
    }

    public function abc()
    {
        $this->client = new Client();
        $this->jwt = $this->generateZoomToken();
        $this->headers = [
            'Authorization' => 'Bearer '.$this->jwt,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ];
        return $this;
    }

    public function generateZoomToken()
    {   
        $user =  Auth::user()->id;   
        $zoomapi = ZoomApi::where('active',1)->where('user_id',$user)->where('status','!=',0)->first();
        
        if(!empty($zoomapi)){
            $key = $zoomapi->api_key;
            $secret = $zoomapi->api_secret;
        }else{
            $zoomapi1 = ZoomApi::where('status',0)->where('active',1)->first();
            $key = $zoomapi1->api_key;
            $secret = $zoomapi1->api_secret;
        }

        $payload = [
            'iss' => $key,
            'exp' => strtotime('+1 minute'),
        ];
        return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
    }

    private function retrieveZoomUrl()
    {
        return env('ZOOM_API_URL', '');
    }

    public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);

            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : '.$e->getMessage());

            return '';
        }
    }

    public function create($data)
    {
        $this->abc();
        $path = 'users/me/meetings';
        $url = $this->retrieveZoomUrl();
 
        if(!isset($data['participant_video'])){
            $data['participant_video']=false;
        }
        if(!isset($data['host_video'])){
            $data['host_video']=false;
        }
        if(!isset($data['enable_join_before_host'])){
            $data['enable_join_before_host']=false;
        }
        if(!isset($data['mute_participants_upon_entry'])){
            $data['mute_participants_upon_entry']=false;
        }

        $body = [
            'headers' => $this->headers,
            'body'    => json_encode([
                'topic'      => $data['topic'],
                'type'       => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $this->toZoomTimeFormat($data['meeting_date']),
                'duration'   => $data['duration'],
                'agenda'     => (! empty($data['agenda'])) ? $data['agenda'] : null,
                'timezone'     => $data['timezone'],
                'settings'   => [
                    'host_video'        => ($data['host_video'] == "on") ? true : false,
                    'participant_video' => ($data['participant_video'] == "on") ? true : false,
                    'join_before_host' => ($data['enable_join_before_host'] == "on") ? true : false,
                    'mute_upon_entry' => ($data['mute_participants_upon_entry'] == "on") ? true : false,
                    'waiting_room'      => true,
                ],
            ]),
        ];

       
        $response =  $this->client->post($url.$path, $body);
        $data = json_decode($response->getBody(), true);
  
        $user =  Auth::user()->id;   
        $zoomapi = ZoomApi::where('active',1)->where('user_id',$user)->where('status','!=',0)->first();
     
        if(!empty($zoomapi)){
            $dataid = $zoomapi->id;
        }else{
            $zoomapi1 = ZoomApi::where('status',0)->where('active',1)->first();
            $dataid = $zoomapi1->id;
        }

        Zoom::create([
            'data' => json_encode($data),
            'api_uid'=> $dataid,
            'created_by'=>Auth::user()->id
        ]);

        return [
            'success' => $response->getStatusCode() === 201,
            'data'    => $data,
        ];
    }

    public function update($id, $data)
    {
        $this->abc();
        $path = 'meetings/'.intval($id);
        $url = $this->retrieveZoomUrl();

        $zoomid = $data['id'];

        $body = [
            'headers' => $this->headers,
            'body'    => json_encode([
                'topic'      => $data['topic'],
                'type'       => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $this->toZoomTimeFormat($data['start_time']),
                'duration'   => $data['duration'],
                'agenda'     => (! empty($data['agenda'])) ? $data['agenda'] : null,
                'timezone'     => 'Asia/Kolkata',
                'settings'   => [
                    'host_video'        => ($data['host_video'] == "true") ? true : false,
                    'participant_video' => ($data['participant_video'] == "true") ? true : false,
                    'join_before_host' => ($data['enable_join_before_host'] == "true") ? true : false,
                    'mute_upon_entry' => ($data['mute_participants_upon_entry'] == "true") ? true : false,
                    'waiting_room'      => true,
                ],
            ]),
        ];
        $response =  $this->client->patch($url.$path, $body);
        $body1 = [
            'headers' => $this->headers,
            'body'    => json_encode([]),
        ];
        $response1 =  $this->client->get($url.$path, $body1);
        $data = json_decode($response1->getBody(), true);
       
        
        $user =  Auth::user()->id;   
        $zoomapi = ZoomApi::where('active',1)->where('user_id',$user)->where('status','!=',0)->first();
     
        if(!empty($zoomapi)){
            $dataid = $zoomapi->id;
        }else{
            $zoomapi1 = ZoomApi::where('status',0)->where('active',1)->first();
            $dataid = $zoomapi1->id;
        }

        Zoom::where('id',$zoomid)->update([
            'data' => json_encode($data),
            'api_uid'=> $dataid
        ]);
  
        return [
            'success' => $response->getStatusCode() === 204,
            'data'    => $data,
        ];
    }

    public function get($data)
    {
        if(count($data)!=0){
            $this->abc();
    
            $data1= array();
            foreach($data as $d){
                $id = json_decode($d->data);
                $id =$id->id;
                $path = 'meetings/'.$id;
                $url = $this->retrieveZoomUrl();
                $this->jwt = $this->generateZoomToken();
                $body = [
                    'headers' => $this->headers,
                    'body'    => json_encode([]),
                ];
                $response =  $this->client->get($url.$path, $body);

                $val = json_decode($response->getBody(), true);
            
                if($val['status']=='started'){
                    $data1[] = array('id' => $id, 'data' => $val);
                }
            
            }
            $data1 = array_filter($data1);
            return [
                'success' => $response->getStatusCode() === 204,
                'data'    => $data1,
            ];
        }else{
            return [
                'success' => 404,
                'data'    => '',
            ];
        }

    }

    /**
     * @param string $id
     * 
     * @return bool[]
     */
    public function delete($id)
    {
        $this->abc();
        $path = 'meetings/'.$id;
        $url = $this->retrieveZoomUrl();
        $body = [
            'headers' => $this->headers,
            'body'    => json_encode([]),
        ];
        $response =  $this->client->delete($url.$path, $body);
       
        return [
            'success' => $response->getStatusCode() === 204,
        ];
    }
}
?>