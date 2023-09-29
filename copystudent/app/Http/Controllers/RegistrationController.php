<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class RegistrationController extends Controller
{
    public function accept(User $user1){

        User::where('id', $user1->id)->update(['accepted' => true]);
        User::where('id', $user1->id)->update(['admincheck' => true]);
        return redirect()->route('dashboard');
    }

    public function refuse(User $user){
        User::where('id', $user->id)->update(['admincheck' => true]);
        return redirect()->route('dashboard');
    }
}
