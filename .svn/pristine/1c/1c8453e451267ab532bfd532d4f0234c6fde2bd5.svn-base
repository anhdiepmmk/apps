<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'app_users';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'birthday', 'sex', 'location', 'created_at',
        'updated_at', 'status'];

    public static function encryptPassword($password, $email = '')
    {
        return md5(env('APP_KEY') . $password . env('APP_KEY') . $email . env('APP_KEY'));
    }

    public function authenticate($email, $password)
    {
        $password = self::encryptPassword($password, $email);
        $user = $this->where(['email' => $email, 'password' => $password])->first();
        if(!empty($user)) {
            $this->where('id', $user->id)->update(['last_login'=>time()]);
            return $user;
        }
        return false;
    }

    public function getUserDetail($userId)
    {
        $user = $this->where('id', $userId)->first();
        $birthday = new \stdClass();
        $seperateDay = explode('-', $user->birthday);
        $birthday->day = @$seperateDay[0];
        $birthday->month = @$seperateDay[1];
        $birthday->year = @$seperateDay[2];
        $user->birthday = $birthday;
        return $user;
    }
    
    public function getUserByReferralKey($referralKey) 
    {
        return $this->where('referral_key', $referralKey)->first();
    }

    public function checkExisted($email)
    {
        $user = $this->where('email', $email)->first();
        return empty($user) ? false : $user->id;
    }

    public function saveUser($user)
    {
        $check = false;
        if (isset($user['id'])) {
            $check = $this->where(['id' => $user['id']])->count();
        }
        if (!empty($check)) {
            $user['updated_at'] = time();
            $this->where(['id' => $user['id']])->update($user);
            return $this->where(['id' => $user['id']])->first();
        } else {
            unset($user['id']);
            $user['password'] = self::encryptPassword($user['password'],
                    $user['email']);
            $user['created_at'] = time();
            $user['total_refer'] = 0;
            $user['referral_key'] = $this->generateReferralKey();
            $this->insert($user);
            return $this->where(['email' => $user['email']])->first();
        }
        
    }

    public function generateReferralKey()
    {
        while (true) {
            $referralKey = generateRandomString(env('REFERAL_KEY_LENGTH', 8));
            $check = $this->where('referral_key', $referralKey)->count();
            if (empty($check)) {
                return $referralKey;
            }
        }
    }
    
    public function validateUser($user) 
    {
        if($this->where('email', $user['email'])->count() > 0) {
            return [
                'status' => false,
                'message' => 'This email has been used before'
            ];
        }
        if(strlen($user['password']) < 6) {
            return [
                'status' => false,
                'message' => 'Password must contain at least 6 characters'
            ];
        }
        if($user['password'] != $user['confirmPassword']) {
            return [
                'status' => false,
                'message' => 'Password must be same with confirm password'
            ];
        }
        return [
            'status' => true,
            'message' => ''
        ];
        
    }

}
