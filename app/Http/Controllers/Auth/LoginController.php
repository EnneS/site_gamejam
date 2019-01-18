<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Auth\EloquentUserProvider;
use App\Student;
use Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(){
      include(app_path() . '/CAS/CAS_controller.php');

    	$login = $_SESSION['phpCAS']['user'];
    	$student = Student::where('login', $login)->first();
    	if($student == null){
    		$student = Student::create([
    			'login' => $login,
          'first_name' => 'null',
          'last_name' => 'null',
    		]);
    	}
     	auth()->login($student, true);
    	session_destroy();
    	unset($_SESSION['phpCAS']);
      return redirect('/');
    }

    public function logout(){
      auth()->logout();
      include(app_path() . '/CAS/CAS_logout.php');
    }

    public function AdminLogin(Request $request){
      if ($request->password == config('app.admin_password')){
        $user = Student::where('admin', 1)->first();
        auth()->login($user, true);
        return auth()->user();
      } else {
        return response()->json(['success' => false, 'message' => 'Mot de passe erroné'], 403);
      }
    }

    public function AdminLogout(){
      auth()->logout();
      return redirect('/');
    }
}

?>
