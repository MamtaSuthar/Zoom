<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\{User};
use Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role','=', '2')->get();
        return view('client.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.add_client');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $client_store=$request->validate([
            'name'=>'required|max:100',
            'email'=>'required|email|unique:users|max:100',
            'password' => 'required|string|min:8|confirmed',
            'phone'=>'required|regex:/^[7-9]\d{0,9}$/',
            'location'=>'required|max:100',
            'about_me'=>'required',
        ]);
        
        $client_store['password']= Hash::make($request->input('password'));
        $client_store['role']= '2';

        // dd($client_store);

        $users= User::create($client_store);
     
        return redirect()->back()->with('success','Record Inserted Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users=User::where('role','=', '2')->find($id);
        return view('client.edit_client',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $client_update= $request->validate([
            'name'=>'required|max:100',
            'email'=>'required|email|max:100',
            'password' =>'required|string|min:8|confirmed',
            'phone'=>'required|regex:/^[7-9]\d{0,9}$/',
            'location'=>'required|max:100',
            'about_me'=>'required',
        ]);
        
        $client_update['password']= Hash::make($request->input('password'));
        $users= User::find($id)->update($client_update);

        return redirect()->back()->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users= User::destroy($id);
        return redirect()->back();
    }
}
