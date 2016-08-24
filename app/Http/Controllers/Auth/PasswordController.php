<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\Http\Requests\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\Caterer;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Mandrill;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
     
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function checkEmailExists(Request $request)
    {
//        dd(User::where(['email' => $request->email, 'is_user' =>1])->first());
        $this->validate($request, ['email' => 'required|email']);
        if ($request->role == 'user') {
            $user = User::where(['email' => $request->email, 'is_user' => 1])->first();
            if (!$user)
                return response()->json(['success' => 0, 'error' => 'Email does not exists.']);

            $token = csrf_token();
            if ($reset = PasswordReset::where(['email' => $request->email, 'role' => $request->role])->first())
                $reset->delete();
            PasswordReset::create(['email' => $request->email, 'token' => $token, 'role' => $request->role]);
            $this->sendMail($token,$request->role,$request->email);
            return response()->json(['success' => 1, 'message' => 'We sent a message to your email.Please check Your email and follow the link given in.']);
        } elseif ($request->role == 'caterer') {
            if (Caterer::where('email', $request->email)->first()) {
                $token = csrf_token();
                PasswordReset::create(['email' => $request->email, 'token' => $token, 'role' => $request->role]);
                $this->sendMail($token,$request->role,$request->email);
                return response()->json(['success' => 1, 'message' => 'We sent a message to your email.Please check Your email and follow the link given in.']);
            }
            return response()->json(['success' => 0, 'error' => 'Email does not exists.']);
        }
    }


    public function checkEmail(Request $request)
    {
        if (PasswordReset::where(['email' => $request->email, 'token' => $request->token, 'role' => $request->role])->first()) {
            PasswordReset::where(['email' => $request->email, 'token' => $request->token, 'role' => $request->role])->delete();
            return Redirect::to("/#/passwordReset?email=$request->email&role=$request->role");
        } else {
            PasswordReset::where(['email' => $request->email, 'token' => $request->token, 'role' => $request->role])->delete();
            return Redirect::to('/#/login');
        }
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($request->role == 'user') {
            $user = User::where(['email' => $request->email, 'is_user' => 1])->first();
            if ($user->update(['password' => bcrypt($request->password)])) {
                $attempt = auth('user')->attempt(['email' => $request->email, 'password' => $request->password, 'is_user' => 1]);
                session(['role' => 'user']);
                return response()->json(['success' => 1]);
            }
        }

        if ($request->role == 'caterer') {
            $caterer = Caterer::where(['email' => $request->email, 'is_user' => 1])->get();
            if ($caterer->update(['password' => bcrypt($request->password)])) {
                $attempt = auth('caterer')->attempt(['email' => $request->email, 'password' => $request->password]);
                session(['role' => 'caterer']);
                return response()->json(['success' => 1]);
            }
        }
    }


    public function sendMail($token,$role, $email)
    {
        try {
            $mandrill = new Mandrill('5lflfmsstLJrAvfqEir6Lg');
            $message = array(
                'html' => '<a href="http://apero.dev/auth/passwordReset/checkEmail/?role=' . $role .'&email=' . $email .'&token='. $token .'">Pass the link</a>',
                'text' => 'Please follow the link below to reset the password.',
                'subject' => 'Reset password',
                'from_email' => 'bastianjung8@gmail.com',
                'from_name' => 'Example Name',
                'to' => array(
                    array(
                        'email' => $email,
                        'name' => 'Recipient Name',
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'bastinjung8@gmail.com'),
                'important' => true,
                'track_opens' => null,
                'track_clicks' => null,
                'auto_text' => null,
                'auto_html' => null,
                'inline_css' => null,
                'url_strip_qs' => null,
                'preserve_recipients' => null,
                'view_content_link' => null,
                'bcc_address' => 'bastinjung8@gmail.com',
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'merge' => true,
                'merge_language' => 'mailchimp',
                'global_merge_vars' => array(
                    array(
                        'name' => 'merge1',
                        'content' => 'merge1 content'
                    )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => 'bastinjung8@gmail.com',
                        'vars' => array(
                            array(
                                'name' => 'merge2',
                                'content' => 'merge2 content'
                            )
                        )
                    )
                ),
                'tags' => array('password-resets'),
                'google_analytics_domains' => array('example.com'),
                'google_analytics_campaign' => 'bastinjung8@gmail.com',

            );
            $async = false;
            $ip_pool = 'Main Pool';
            $result = $mandrill->messages->send($message, $async, $ip_pool,\Carbon\Carbon::now()->toDateTimeString());
        } catch(Mandrill_Error $e) {
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            throw $e;
        }

    }

}
