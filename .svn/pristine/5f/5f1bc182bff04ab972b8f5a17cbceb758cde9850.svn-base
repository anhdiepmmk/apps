<?php

namespace App\Http\Controllers;

use App\AppUser;
use App\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use DB;

include (app_path() . DIRECTORY_SEPARATOR . 'Helper' . DIRECTORY_SEPARATOR . 'utility.php');

class UserController extends Controller
{

    protected $userKey = '';
    protected $user = [];
    protected $page = 'login';
    protected $request;
    protected $defaultPerPage = 10;

    public function __construct(Request $request)
    {
        $this->userKey = md5('user' . env('APP_KEY'));
        $user = @json_decode(cookie($this->userKey));
        if (!empty($user)) {
            $user = decrypt($user, env('APP_KEY'));
            if (!empty($user) && isset($user['id']) && !empty($user['id'])) {
                session(['user' => $user]);
            }
        } else {
            $user = session('user');
            if (empty($user)) {
                $user = [];
            }
        }
        if (!empty($user)) {
            $appUserModel = new AppUser();
            $this->user = $appUserModel->getUserDetail($user['id']);
        }
        $setting = Setting::find(1);
        $this->home = 'login';
        $this->request = $request;
        View::share('setting', $setting);
        View::share('home', $this->page);
        View::share('user', $this->user);
    }

    public function login()
    {
        if (!empty($this->user)) {
            return redirect('/');
        }

        if (empty($this->request->input('email')) || empty($this->request->input('password'))) {
            $this->request->session()->flash('error',
                'Please input email and password');
            return redirect('/user/login' . (empty($this->request->input('redirectTo')) ? '' : '?redirectTo=' . $this->request->input('redirectTo')));
        }
        $appUser = new AppUser();
        $user = $appUser->authenticate($this->request->input('email'),
            $this->request->input('password'));
        if (empty($user)) {
            $this->requestData = [];
            if (!empty($this->request->input('email'))) {
                $this->requestData['email'] = $this->request->input('email');
            }
            if (!empty($this->request->input('redirectTo'))) {
                $this->requestData['redirectTo'] = $this->request->input('redirectTo');
            }
            if (!empty($this->request->input('remember'))) {
                $this->requestData['remember'] = $this->request->input('remember');
            }
            $this->request->session()->flash('error',
                'Invalid email or password');
            return redirect('/user/login' . (empty($this->requestData) ? '' : '?' . \GuzzleHttp\Psr7\build_query($this->requestData)));
        }
        $userData = [
            'id' => $user->id,
            'email' => $user->email,
            'fullname' => $user->fullname,
        ];
        session(['user' => $user]);
        if ($this->request->input('remember') == 1) {
            cookie($this->userKey, encrypt(json_encode($user), env('APP_KEY')));
        }
        if (!empty($this->request->input('redirectTo'))) {
            return redirect($this->request->input('redirectTo'));
        } else {
            return redirect('/');
        }
    }

    public function loginForm()
    {
        if (!empty($this->user)) {
            return redirect('/');
        }
        $params = [
            'email' => empty($this->request->input('email')) ? '' : $this->request->input('email'),
            'password' => empty($this->request->input('password')) ? '' : $this->request->input('password'),
            'redirectTo' => empty($this->request->input('redirectTo')) ? '' : $this->request->input('redirectTo'),
            'remember' => empty($this->request->input('remember')) ? 0 : 1,
        ];
        return view('user.login', compact('params'));
    }

    public function registerForm($referralKey = '')
    {
        if (!empty($this->user)) {
            return redirect('/');
        }
        $userModel = new AppUser();
        $userData = [
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'password' => $this->request->input('password'),
            'confirmPassword' => $this->request->input('confirmPassword'),
            'birthday' => $this->request->input('birthday-day') . '-' . $this->request->input('birthday-month') . '-' . $this->request->input('birthday-year'),
            'sex' => $this->request->input('sex'),
            'location' => $this->request->input('location')
        ];
        $user = [];
        if(!empty($userData['email'])) {
            $validate = $userModel->validateUser($userData);
            if($validate['status']) {
                if (!empty($this->request->input('referralKey'))) {
                    $referralUser = $userModel->getUserByReferralKey($this->request->input('referralKey'));
                    if(!empty($referralUser)) {
                        $userData['referred_by'] = $referralUser->id;
                    }
                }
                unset($userData['confirmPassword']);
                $user = $userModel->saveUser($userData);
                if (!empty($referralUser) && !empty($user)) {
                    AppUser::where('id', $referralUser->id)->increment('total_refer', 1);
                }
            } else {
                $this->request->session()->flash('error', $validate['message']);
            }
        }
        if(empty($user)) {
            $userData['referralKey'] = empty($referralKey) ? $this->request->input('referralKey') : $referralKey;
            $userData['birthday'] = [];
            $userData['birthday']['day'] = $this->request->input('birthday-day');
            $userData['birthday']['month'] = $this->request->input('birthday-month');
            $userData['birthday']['year'] = $this->request->input('birthday-year');
            return view('user.register', compact('userData'));
        } else {
            session(['user' => $user]);
            return redirect('/');
        }
    }

    public function resetPassword()
    {
        $email = $this->request->input('email');
        $token = $this->request->input('token');
        
        return view('user.forgot');
    }

    public function forgotPasswordPost()
    {
        $userModel = new AppUser();
        $email = $this->request->input('email');
        $userId = $userModel->checkExisted($email);
        if($userId > 0) {
            $user = $userModel->getUserDetail($userId);
            $resetData = [
                'id' => $user->id,
                'reset_token' => generateRandomString(20),
                'reset_token_expire' => time() + 60 * 60 * 24,
            ];
            $userModel->saveUser($resetData);
        }
        return view('user.reset');
    }

    public function profileForm()
    {
        $this->page = 'profile';
        View::share('home', $this->page);
        return view('user.profile');
    }
    
    public function profilePost() 
    {
        $userData = [
            'id' => $this->user->id,
            'name' => $this->request->input('name'),
            'birthday' => $this->request->input('birthday-day') . '-' . $this->request->input('birthday-month') . '-' . $this->request->input('birthday-year'),
            'sex' => $this->request->input('sex'),
            'location' => $this->request->input('location')
        ];
        $user = (new AppUser())->saveUser($userData);
        return redirect('/user/profile')->with('message','Update Complete!');
    }
    
    public function passwordPost() 
    {
        return redirect('/user/profile')->with('message','Update Complete!');
    }

    public function referralForm()
    {
        $this->page = 'profile';
        View::share('home', $this->page);
        $referralList = AppUser::where('referred_by', '=', $this->user->id)->orderBy('created_at',
                'desc')->paginate($this->defaultPerPage);
        return view('user.referral',compact('referralList'));
    }

    public function logout()
    {
        session(['user' => null]);
        cookie($this->userKey, null, -1, '/');
        return redirect('/');
    }

}
