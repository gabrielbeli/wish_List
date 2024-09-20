<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiftController extends Controller
{
    public function index()
    {
        $gifts = $this->show();

        foreach ($gifts as $gift) {
            if ($gift->value_paid !== null) {
                $gift->difference = $gift->value_paid - $gift->value_to_pay;
            }
        }


        $users = User::all();

        return view('gifts.gifts', compact('gifts', 'users'));
    }


    protected function show()
    {
        $gifts = DB::table('gifts')
       ->join('users', 'users.id','gifts.user_id')
       ->select('gifts.*', 'users.name as usname')
       ->get();

        return $gifts;
    }

    public function viewGiftId($id){

        $giftId= DB::table('gifts')
        ->where('gifts.id', $id)
        ->join('users', 'users.id','gifts.user_id')
        ->select('gifts.*', 'users.name as usname')
        ->first();


        return view('gits.gifts', compact('giftId'));
    }

    public function deleteGift($id){

        $giftId = DB::table('gifts')
        ->where('id', $id)
        ->delete();

        return back();
    }

    public function addGift(){

        $users = User::all();
        $gifts = DB::table('gifts')->get();

        return view('gifts.gifts', compact('users', 'gifts'));
    }

    public function createGift(Request $request)
{


    $action = '';
    $users = User::all();

    if (isset($request->id)) {
        $action = 'atualizado';

        $request->validate([
            'name' => 'string|max:50',
            'user_id' => 'required|exists:users,id'
        ]);

        DB::table('gifts')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'value_to_pay' => $request->value_to_pay,
                'value_paid' => $request->value_paid,
                'user_id' => $request->user_id
            ]);
    } else {
        $action = 'adicionado';

        $request->validate([
            'name' => 'string|max:50|required',
        ]);

        DB::table('gifts')
            ->insert([
                'name' => $request->name,
                'value_to_pay' => $request->value_to_pay,
                'value_paid' => $request->value_paid,
                'user_id' => $request->user_id
            ]);
    }


    $gifts = $this->show();

    foreach ($gifts as $gift) {
        if ($gift->value_paid !== null) {
            $gift->difference = $gift->value_paid - $gift->value_to_pay;
        }
    }

    return view('gifts.gifts', compact('users', 'gifts'))->with('message', 'The gift was ' . $action . ' successfully!');
}

}
