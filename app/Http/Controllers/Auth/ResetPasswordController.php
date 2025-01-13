<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\VerificationCodeRequest;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function reset(ResetPasswordRequest $request)
    {

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $verified = $user->verificationCode;
        $is_verified = $verified->is_verified;

        if (!$is_verified) {
            return $this->customeRespone(null, 'You Can\'t reset password ', 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message'  =>  'Password Reset Successfully'
        ], 200);
    }

    public function sendRestEmail(EmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!empty($user)) {
            $code = sprintf("%04d", mt_rand(1, 999999));

            // prepare message
            $data['code'] = $code;
            $data['email'] = $user->email;
            $data['title'] = "Reset Password";
            $data['body']  = "Welcom To Freelanser Business Managment Website";

            // send mail to user
            Mail::send('email_interface', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });

            //save the code for user to compare
            $code = VerificationCode::create([
                'user_id' => $user->id,
                'code'    => $code
            ]);

            return response()->json([
                'message'  =>  'Mail send successfuly'
            ], 200);
        }
        return response()->json([
            'message'  =>  'User Not Found'
        ], 404);
    }

    public function checkTheCode(VerificationCodeRequest $request)
    {
        $user = Auth::user();
        $code = VerificationCode::where('code', $request->code)
            ->where('user_id', $user->id)->first();
        if ($code) {

            $code->code = null;
            $code->is_verified = 1;
            $code->save();
            return response()->json([
                'message'  =>  'Done!'
            ], 200);
        }
        return response()->json([
            'message'  =>  'Error'
        ], 404);
    }



    public function changePassword(ChangePasswordRequest $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if ( !( Hash::check($request->current_password, $user->password) ) ) {

            return response()->json([
                'message'  =>  'Current password is incorrect'
            ], 422);
        }
        $user->update([
            'password' => bcrypt($request->new_password)
        ]);

        return response()->json([
            'message'  =>  'Password Changed Successfully'
        ], 200);
    }
}
