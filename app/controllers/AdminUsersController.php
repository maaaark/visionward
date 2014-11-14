<?php

class AdminUsersController extends \BaseController {
	
	public function index() {
		$users = User::orderBy("id", "ASC")->get();
		return View::make("admin.users.index", compact("users"));
	}
	
	public function edit($id) {
		$user = User::find($id);
		$roles = Role::all();
		return View::make("admin.users.edit", compact("user", "roles"));
	}
	
	
	public function create() {
		$roles = Role::all();
		return View::make("admin.users.create", compact("roles"));
	}
	
	public function save() {
		$input = Input::all();
		$roles = Input::get('role');
		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{
	        $user = User::create($input);
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			// Role
			foreach($user->roles as $role) {
				$user->roles()->detach($role->id);
			}
			
			$roles = Input::get('role');
			if(is_array($roles))
			{
			   foreach($roles as $role) {
					$user->roles()->attach($role);
			   }
			}
			
			return Redirect::to('/admin/users')->with("success", "User erstellt");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/users/create")
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all())->with('roles', $roles);
		}
        
	}
	
	public function update() {
		$input = Input::all();
		$roles = Input::get('role');
		
		$validation = Validator::make($input, User::$rules);
		if ($validation->passes())
		{
			$user = User::find(Input::get('id'));
			
			
			// Role
			foreach($user->roles as $role) {
				$user->roles()->detach($role->id);
			}
			
			$roles = Input::get('role');
			if(is_array($roles))
			{
			   foreach($roles as $role) {
					$user->roles()->attach($role);
			   }
			}

			$user->update($input);
			if(Input::get('password') != "") {
				$user->password = Hash::make(Input::get('password'));
			}
			$user->save();
			
	        return Redirect::to('/admin/users/edit/'.Input::get('id'))->with("success", "User updated");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/users/edit/".Input::get('id'))
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all())->with('roles', $roles);
		}
        
	}
	
	public function destroy($id)
    {
        $user = User::find($id);
		foreach($user->roles() as $roles) {
			$role->user->detach($role->id);
		}
		$user->delete();
        return Redirect::to('/admin/users')->with("success", "User wurde gelöscht");
    }
	
}