<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\LoginFormRequest;
use Sentinel;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use App\Services\CondominioService;

class AuthController extends Controller
{
	use Helpers;

	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function teste()
	{
		//return view('admin.sessions.create');

		$user = app('Dingo\Api\Auth\Auth')->user();

		return $user;
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function logar()
	{
		//return view('admin.sessions.create');
		return $this->response->error('This is an error.', 440);
	}


	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function create()
	{
		//return view('admin.sessions.create');
		return view('admin.auth.login');
	}

	public function register()
	{
		//return view('admin.sessions.create');
		return view('admin.auth.register');
	}

	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function store(LoginFormRequest $request)
	{
		$input = $request->only('email', 'password');

		try {

			$post = $request->input();
			$user = Sentinel::findUserByCredentials([ 'email' => $post['email'] ]);

			if($user){
				if (Sentinel::authenticate($input, $request->has('remember'))) {
					$this->redirectWhenLoggedIn();
				}
			}

			\Session::flash('type', 'danger');
            \Session::flash('message', 'Dados de acesso inválidos');
            return redirect()->back()->withInput();

			//return redirect()->back()->withInput()->withErrorMessage('Invalid credentials provided');

		} catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
			return redirect()->back()->withInput()->withErrorMessage('User Not Activated.');
		} catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e) {
			return redirect()->back()->withInput()->withErrorMessage($e->getMessage());
		}

	}

	protected function redirectWhenLoggedIn()
	{
		// Logged in successfully - redirect based on type of user

		$user = Sentinel::getUser();

		$admin = Sentinel::findRoleBySlug('admins');
		$users = Sentinel::findRoleBySlug('users');


		if ($user->inRole($admin)) {
			return redirect()->intended('admin/dashboard');
		} elseif ($user->inRole($users)) {

			return redirect()->intended('/');
		}

		return redirect()->intended('admin');
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function destroy($id=null)
	{
		Sentinel::logout();

		return redirect()->intended('admin/login');
	}
}
