<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;
use PDOException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Google\Cloud\Firestore\FirestoreClient;

class ChatController extends Controller
{
    private static $firestoreProjectId;
    private static $firestoreClient;

	public function index()
    {
		$data = User::where('terminated',0)->where('uuid','!=',Auth::user()->uuid)->get();
        return view('chat',compact('data'));
    }

	public function getuserlist(Request $request)
    {
	    self::$firestoreProjectId = 'team-conference';
        self::$firestoreClient = new FirestoreClient([
            'projectId' => self::$firestoreProjectId,
        ]);

        $collectionRef = self::$firestoreClient
        ->collection('events')
        ->document('messages')
        ->collection('events_data');

        $documents = $collectionRef
        ->where('user_id', '=', Auth::user()->uuid)
        ->documents();

        $uniqueDataArray = [];
        foreach ($documents as $document) {
            $data = $document->data();

            // Check if the receiver_id already exists in $uniqueDataArray
            $receiverIdExists = false;

            foreach ($uniqueDataArray as $uniqueData) {
                if ($uniqueData['receiver_id'] == $data['receiver_id']) {
                    $receiverIdExists = true;
                    break;
                }
            }

            if (!$receiverIdExists) {
                // Get user details based on receiver_id
                $userDetails = User::where('uuid', $data['receiver_id'])->first();

                if ($userDetails != null) {
                    // Merge data and user details
                    $mergedData = array_merge($data, $userDetails->toArray());

                    // Add the merged data to $uniqueDataArray
                    $uniqueDataArray[] = $mergedData;
                }
            }
        }
        $documents1 = $collectionRef
        ->where('receiver_id','=',Auth::user()->uuid)
        ->documents();
        
        foreach ($documents1 as $document) {
            $data = $document->data();

            // Check if the user_id already exists in $uniqueDataArray
            $receiverIdExists = false;

            foreach ($uniqueDataArray as $uniqueData) {
                if ($uniqueData['user_id'] == $data['user_id']) {
                    $receiverIdExists = true;
                    break;
                }
            }

            if (!$receiverIdExists) {
                // Get user details based on user_id
                $userDetails = User::where('uuid', $data['user_id'])->first();

                if ($userDetails != null) {
                    // Merge data and user details
                    $mergedData = array_merge($data, $userDetails->toArray());

                    // Add the merged data to $uniqueDataArray
                    $uniqueDataArray[] = $mergedData;
                }
            }
        }

        return response()->json(['success' => true,'data'=>$uniqueDataArray]);
    }

    public function getchat(Request $request)
    {
	    $user = User::where('uuid',$request->id)->first();
        $user['sender_pic'] = Auth::user()->profile_pic;

        self::$firestoreProjectId = 'team-conference';
        self::$firestoreClient = new FirestoreClient([
            'projectId' => self::$firestoreProjectId,
        ]);
   
        $collectionRef = self::$firestoreClient
        ->collection('events')
        ->document('messages')
        ->collection('events_data');

        $documents = $collectionRef
        ->where('user_id', '=', Auth::user()->uuid)
        ->where('receiver_id','=',($request->id))
        ->documents();

        $documents1 = $collectionRef
        ->where('user_id', '=', ($request->id))
        ->where('receiver_id','=',Auth::user()->uuid)
        ->documents();

        $dataArray = [];
        foreach ($documents as $document) {
            $data = $document->data();
            $data['status'] = 1; // Set status to 1 if user_id = Auth::user()->uuid
            $data['sent_at'] = Carbon::parse($data['sent_at'])->format('Y-m-d h:i:s A');
            $dataArray[] = $data;
        }

        foreach ($documents1 as $document) {
            $data = $document->data();
            $data['status'] = 2; // Set status to 2 if user_id != Auth::user()->uuid
            $data['sent_at'] = Carbon::parse($data['sent_at'])->format('Y-m-d h:i:s A');
            $dataArray[] = $data;
        }
    
        // Sort the merged data by date
        usort($dataArray, function ($a, $b) {
            $dateA = $a['sent_at']; // Assuming 'date' is the field name containing the date
            $dateB = $b['sent_at'];
            return strtotime($dateA) - strtotime($dateB); // Sort in Asc order
        });

        return response()->json(['success' => true,'userdata'=>$user,'data'=>$dataArray]);
    }


	public function sendMessage(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'message' => 'required_without:chat_mes_file',
            'chat_mes_file' => 'required_without:message',
			'user_id'       => 'required',
            'receiver_id'    => 'required',
        ]);
      
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['success' => false,'errors' => $errors], 422);
        }

        if ($request->file('chat_mes_file')) {
            $file = $request->file('chat_mes_file');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/chat_mes_file'), $filename);
            $data['chat_mes_file'] = $filename;
        }
      
        $mytime = Carbon::now();
        self::$firestoreProjectId = 'team-conference';
        self::$firestoreClient = new FirestoreClient([
            'projectId' => self::$firestoreProjectId,
        ]);

        $data['message'] = $request->input('message');
        $data['user_id'] = str_replace('"', '', Auth::user()->uuid); // Extract the user ID
        $data['receiver_id'] = str_replace('"', '', $request->input('receiver_id'));
        $data['sent_at'] = $mytime->toDateTimeString();

        $docRef = self::$firestoreClient->collection('events')->document('messages')->collection('events_data')->add($data);

        $collectionRef = self::$firestoreClient
        ->collection('events')
        ->document('messages')
        ->collection('events_data');

        $user = User::where('id',$request->input('receiver_id'))->first();
        $user['sender_pic'] = Auth::user()->profile_pic;
        $user['sent_at']  = Carbon::parse($data['sent_at'])->format('Y-m-d h:i:s A');

        return response()->json(['success' => true,'data'=>$user]);
    }

    public function getMessages()
    {
        // Retrieve messages from Firebase database
        $firebase = app('firebase.database');
        $messages = $firebase->getReference('messages')->getSnapshot()->getValue();

        return response()->json(['messages' => $messages]);
    }
}
