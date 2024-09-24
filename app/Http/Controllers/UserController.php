<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $search = request()->input('search', null);

        $users = $this->getContactBase($search);

        return view('user.user', compact('users'));
    }

    protected function  getContactBase($search){

        if($search){
            $users = User::where('name', 'like', '%' . $search . '%')->get();
            return $users;

        } else {
            return User::all();
        }
    }

    public function viewUserId($id){

        $userId= DB::table('users')
        ->where('id', $id)
        ->first();

        return view('user.user', compact('userId'));
    }

    public function deleteUserId($id){

        $userId= DB::table('users')
        ->where('id', $id)
        ->delete();

        return back();
    }

    public function createUser(Request $request){

        $action = '';

        if(isset($request->id)){
            $action = 'updated';

            $request->validate([
                'name' => 'string|max:50',
            ]);

            User::where('id', $request->id)->update([
                'name' =>$request->name,
                'phone' =>$request->phone,
                'address' =>$request->address
        ]);

        } else {
            $action = 'add';

            $request->validate([
                'name' => 'string|max:50',
                'email' => 'email|unique:users',
                'password' => 'min:6'
        ]);

            User::insert([
                'name' =>$request->name,
                'email' =>$request->email,
                'password' =>Hash::make($request->password),
        ]);

        }

        return redirect()->route('user.user')->with('message', 'The usur was '. $action . ' successfully!');
    }
}
