<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\Models\User;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotController extends Controller
{
    public function forgot(ForgotRequest $request){

        $email = $request->email;
        /** @var User */
        if(User::where('email',$email)->doesntExist()){

            return response([
                'message' => "User doesn't exist!"
            ],404);
        }
        // The following line of code produces a string of 10 characters.
        $token = Str::random(20);
        try{
           $deger = DB::table('password_resets')->updateOrInsert(
                ['email' => $email],
                ['token' => $token]);

            // Send email

            Mail::send("mails.forgot",["token" => $token],function(Message $message) use($email) {
                $message->to($email);
                $message->subject("Şifre sıfırlama");
            });

            return response([
                "message" => "E-mail kutunuzu kontrol ediniz!"
            ]);
        }catch(\Exception $ex){

            return response([
                    'message' => $ex->getMessage()
            ],400);
        }

    }


    public function reset(ResetRequest $request){

        $token = $request->input('token');

        if(!$passwordResets = DB::table('password_resets')->where('token', $token)->first()){
            return response([
               'message' => "Hatalı token"
            ],400);
        }

        $user = User::where('email',$passwordResets->email)->first();

        if(!$user){
            return response([
                'message' => "Token'in sahip olduğu  mail'e ait bir kullanıcı bulunamadı!"
            ]);
        }

        $user->password  = Hash::make($request->input('password'));
        $user->save();

        // Daha önce kayıt edilen tokeni siliyoruz.
         dd($passwordResets);
        $passwordResets->delete();
        return response([
            'message' => 'Başarılı'
        ]);
    }
}
