<?php

use Alpha\Repositories\ClientsRepository;
use Alpha\Repositories\UsersRepository;

use Alpha\Forms\UserAddClientsForm;

/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends \BaseController
{

    protected $clientsRepository;
    protected $usersRepository;
    protected $userAddClientsForm;

    public function __construct(ClientsRepository $clientsRepository, UsersRepository $usersRepository, UserAddClientsForm $userAddClientsForm)
    {
        $this->clientsRepository = $clientsRepository;
        $this->usersRepository = $usersRepository;
        $this->userAddClientsForm = $userAddClientsForm;

    }    

    public function index()
    {
		$users = User::with('client')->get();
		
		//dd($users->first()->roles->first()->name);
		
        return View::make('users/index', compact('users'));
        //return View::make(Config::get('confide::signup_form'));
    }

    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
		$clients = Client::selectRaw("id, name AS text")->orderBy('text')->get();
		$roles = Role::orderBy('id')->lists('name','id');
        return View::make('users/register', compact('clients', 'roles'));
        //return View::make(Config::get('confide::signup_form'));
    }

    public function show($id)
    {

        try
        {
            $user = User::with('client')->findOrFail($id);

            return View::make('users/show', compact('user'));
        }
        catch (Exception $e)
        {
            Flash::error("User not found!");
            return Redirect::route('users');
        }   

    }

    public function edit($id)
    {

        try
        {
            $user = User::with('client')->findOrFail($id);
            $clients = Client::selectRaw("id, name AS text")->orderBy('text')->get();
            $roles = Role::orderBy('id')->lists('name','id');

            return View::make('users/edit', compact('user', 'clients', 'roles'));
        }
        catch (Exception $e)
        {
            Flash::error("User not found!");
            return Redirect::route('users');
        }         

    }

    public function destroy($id)
    {
        //dd($id);
        $user = User::find($id);
        $repo = App::make('UserRepository');

        $input = array(
            'username'  =>$user->username,
        );    

        if ($repo->userDelete($input)) {
            Flash::success("User $user->fullname has been deleted!");
            return Redirect::route('users');
        } else {
            Flash::error("Unable to delete user $user->name!");
            return Redirect::back();
        } 
    }

    public function update($id)
    {
        //dd($id);
        $user = User::find($id);
        //dd(Input::all());
        $repo = App::make('UserRepository');

        $input = array(
            'id'        =>$id,
            'fullname'  =>Input::get('fullname'),
            'client_id' =>Input::get('client_id'),     
            'username'  =>Input::get('username'),
            'email'     =>Input::get('email'),
        );    

        if ($repo->userUpdate($input)) {
            Flash::success("User info updated!");
            return Redirect::route('user_show', $user->id);
        } else {

            //dd($errors);
            Flash::error("Unable to update user info!");
            return Redirect::back();
        } 
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {
        //dd(Input::all());
        $repo = App::make('UserRepository');
        $user = $repo->signup(Input::all());

        if ($user->id) {
            if (Config::get('confide::signup_email')) {
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }

            return Redirect::route('users')
                ->with('notice', Lang::get('confide::confide.alerts.account_created'));
        } else {
            $errors = $user->errors();

            //dd($errors->first('client_id', ':message'));

            return Redirect::action('UsersController@create')
                ->withInput(Input::except('password'))
                ->withErrors($errors);
        }
    }

    /**
     * Displays the login form
     *
     * @return  Illuminate\Http\Response
     */
    public function login()
    {
        if (Confide::user()) {
            return Redirect::to('/admin');
        } else {
            //return View::make(Config::get('confide::login_form'));
            return View::make('users/login');
        }
    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function doLogin()
    {
        //dd(Input::all());
        $repo = App::make('UserRepository');
        $input = Input::all();

        if ($repo->login($input)) {
            return Redirect::intended('/admin'); // if intended url not found, it will fallback to /admin
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                //$err_msg = 'Incorrect Email or Password.';
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::action('UsersController@login')
                ->withInput(Input::except('password'))
                ->with('error', $err_msg);
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     *
     * @return  Illuminate\Http\Response
     */
    public function confirm($code)
    {
        if (Confide::confirm($code)) {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@login')
                ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        //return View::make(Config::get('confide::forgot_password_form'));
        return View::make('users/forgot');
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function doForgotPassword()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Redirect::action('UsersController@doForgotPassword')
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function resetPassword($token)
    {
        // return View::make(Config::get('confide::reset_password_form'))
        //         ->with('token', $token);
        return View::make('users/reset')->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function doResetPassword()
    {

        //dd(Input::all());
        $repo = App::make('UserRepository');
        $input = array(
            'token'                 =>Input::get('token'),
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::action('UsersController@resetPassword', array('token'=>$input['token']))
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    public function changePassword()
    {
        return View::make('users/change_password');
    }

    public function clientChangePassword()
    {
        return View::make('clientviews/change_password');
    }

    public function doChangePassword()
    {
        $repo = App::make('UserRepository');
        $input = array(
            'username'              =>Auth::user()->username,
            'password_old'          =>Input::get('password_old'),
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password_confirmation'),
        );    

        if ($repo->changePassword($input)) {
            Flash::success("Password successfully changed!");
            return Redirect::route('profile');
        } else {
            Flash::error("Unable to change your password!");
            return Redirect::back();
        } 
    }

    public function doClientChangePassword()
    {
        $repo = App::make('UserRepository');
        $input = array(
            'username'              =>Auth::user()->username,
            'password_old'          =>Input::get('password_old'),
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password_confirmation'),
        );    

        if ($repo->changePassword($input)) {
            Flash::success("Password successfully changed!");
            return Redirect::route('client_profile');
        } else {
            Flash::error("Unable to change your password!");
            return Redirect::back();
        } 
    }

    public function userChangePassword($id)
    {

        try
        {
            $user = User::with('client')->findOrFail($id);

            return View::make('users/user_change_password', compact('user'));
        }
        catch (Exception $e)
        {
            Flash::error("User not found.");
            return Redirect::back();
        }   
    }   

    public function doUserChangePassword($id)
    {
       
        $user = User::find($id);
        //dd($user->username);
        $repo = App::make('UserRepository');
        $input = array(
            'username'              =>$user->username,
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password_confirmation'),
        );    

        if ($repo->userChangePassword($input)) {
            Flash::success("Password successfully changed!");
            return Redirect::route('user_show', $user->id);
        } else {
            Flash::error("Unable to change your password!");
            return Redirect::back();
        } 
    }     
    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function logout()
    {
        Confide::logout();

        return Redirect::route('login');
    }

    public function profile()
    {
        return View::make('users/profile');
    }

    public function addClient($id)
    {
        $user = $this->usersRepository->getById($id);
        $clients = $this->clientsRepository->getAllForSelectList();
        return View::make('users/add_client', compact('user', 'clients'));
    }  

    public function addClientStore($id)
    {
        $selectedClients = explode(",", Input::get('selectedClients'));

        $this->userAddClientsForm->validate(Input::all());

        $this->usersRepository->addClients($id, $selectedClients);

        Flash::success("Clients successfully associated with this user!");

        return Redirect::route('user_show', $id);

    }

    public function removeClient($id)
    {
        //dd($id);
        $user_id = Input::get('user_id');

        $this->usersRepository->removeClient($id, $user_id);

        Flash::success("Client successfully removed from this user!");

        return Redirect::route('user_show', $user_id);

    }               
}
