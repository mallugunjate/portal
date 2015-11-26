<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile\Position;
use App\Models\Profile\Profile;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    /*
    * Properties | define all the properties here 
    * to overwrite the laravel default properties such as routes.
    */
    private $redirectTo = '/home';
    private $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
        ]);
    }

    protected function sendRegistrationApproval($request, $user)
    {
        $approval_code = str_random(60).$request->get('store');
        $user->approved = 0;
        $user->approval_code = $approval_code; 
        $user->save();

        $managerProfile = Profile::getManagerProfile($request->get('store'));
        $managerEmail = Profile::getManagerEmail($request->get('store'));
        
        Mail::send( 'emails.approveRegistration',
                    [ 'approval_code'  => $approval_code,
                      'firstname'      => $user->firstname,
                      'lastname'       => $user->lastname,
                      // 'position'       => Position::find($request->position)->name
                    ], 
                    function ($m) use ($user, $managerEmail, $managerProfile) {
                        $m->to($managerEmail, $managerProfile->firstname)
                          ->sender(env('MAIL_USERNAME'), $name = null)
                          ->subject('Approve a new registration!');
                    }
                );

        
    }


    protected function sendRegistrationActivation($user)
    {
        
        $activation_code = str_random(60).$user->email;

        $user->activation_code =  $activation_code;
    
        $user->save();
        
        Mail::send( 'emails.confirmRegistration', 
                    ['activation_code'=>$activation_code], 
                    function ($m) use ($user) {
                        $m->to($user->email, $user->firstname)
                          ->sender(env('MAIL_USERNAME'), $name = null)
                          ->subject('Please activate your account!');
                    }
                );

    }


    public function getRegister()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost:8080/stores']);
        $storeobj_list = ($client->request('GET')->getBody()->getContents());
        
        return view('auth.register')->with('storeobj_list', $storeobj_list);
    }


    /* postRegister method overwriting the vendor method*/
    public function postRegister(Request $request)
    {
        
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        $this->sendRegistrationApproval($request, $user);
        
        return view('auth.activateAccount');

    }


    public function activateAccount($code, User $user)
    {
        $activatedUser = $user->activateAccount($code);
        if ($activatedUser) {
            \Session::flash('message', "Your acccount has been activated!");
            return redirect("/profile/create");
        }
        
        \Session::flash('message', 'Your account couldn\'t be activated, please try again');
        
        return redirect('/');
    }

    public function approveAccount($code, User $user)
    {
        $approvedUser = $user->approveAccount($code);
        if ($approvedUser) {
            \Session::flash('message', "User profile approved!");
            $this->sendRegistrationActivation($approvedUser);
        }
        
        \Session::flash('message', 'Your account couldn\'t be activated, please try again');
        
        return view('auth.approved');
    }

    protected function getCredentials(Request $request)
    {
        $creds = ( $request->only($this->loginUsername(), 'password' ) );
        $creds["active"] = 1;
        $creds["approved"] = 1;
        return ($creds);
    }
}
