<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function show()
    {
        var_dump(User::find(1)->toArray());
    }

    public function test(Request $request)
    {
        echo $request->get('content');
        $per_page =$request->get('per_page');
        $this->user = new User();
        $data = $this->user->where('id',1)
            ->where('content', 'aaa')
            ->take(10)
            ->get();

         $data = $this->user->where('id',1)
             ->where('content', 'aaa')
             ->paginate($per_page);

         $user = new User();
         $user->name = 'aaa';
         $user->save();
         var_dump($user);

         $user = $this->user->find(1);
         $user->name = 'aaa';
         $user->save();

    }
}
