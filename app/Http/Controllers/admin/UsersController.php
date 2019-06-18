<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;
class UsersController extends Controller
{
    public function index(){
        $users = User::all();
//        dd($users);
        return view('admin.users.index',['users'=>$users]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit',['user'=>User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->username =  request('username');
        $user->email =  request('email');
        $user->firstname =  request('firstname');
        $user->lastname =  request('lastname');
        $user->save();
        return redirect('admin/users');
    }
    /**
     * Show the form for changing the user password.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        return view('admin.users.edit_password',['user'=>User::findOrFail($id)]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('admin/users');
    }
    /*
     * https://stackoverflow.com/questions/39586104/change-password-user-laravel-5-3
     * */
    public function updatePassword(Request $request, User $user)
    {
//        dd($request["password"]);
        if(auth()->check())
        {
            $request_data = $request->all();
            $validator = $this->admin_credential_rules($request_data);
            if($validator->fails())
            {
                return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
            }
            else
            {
                $current_password = $user->password;
                if(Hash::check($request_data['current-password'], $current_password))
                {


                    $user->password = Hash::make($request_data['password']);;
                    $user->save();
                    return "ok";
                }
                else
                {
                    $error = array('current-password' => 'Please enter correct current password');
                    return response()->json(array('error' => $error), 400);
                }
            }
        }
        else
        {
            return redirect()->to('/');
        }
    }
    public function admin_credential_rules(array $data)
    {
        $messages = [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'current-password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',
        ], $messages);

        return $validator;
    }
}
