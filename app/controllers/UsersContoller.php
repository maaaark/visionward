<?php

class UsersController extends \BaseController {
    /**
     * Display the specified resource.
     * GET /teams/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($nickname)
    {
        $user = User::where("username", "=", $nickname)->first();
        return View::make('users.show', compact('user'));
    }

    public function index() {
        $users = User::orderBy("id", "ASC")->get();
        return View::make("users.index", compact("users"));
    }

    public function edit() {
        if(Auth::check()) {
            $user = Auth::user();
            return View::make("users.edit", compact("user"));
        } else {
            return Redirect::to("/login");
        }
    }


    public function create() {
        return View::make("users.create");
    }

    public function settings() {
        if(Auth::check()) {
            $user = Auth::user();
            return View::make("users.settings", compact('user'));
        } else {
            return Redirect::to('/login')->with("error", "Bitte einloggen.");
        }
    }

    public function save_settings() {
        if(Auth::check()) {
            $user = Auth::user();
            return View::make("users.settings", compact('user'));
        } else {
            return Redirect::to('/login')->with("error", "Bitte einloggen.");
        }
    }

    public function verify_summoner() {
        if (Auth::check())
        {
            $user = User::find(Auth::user()->id);
            if($user->summoner_veryfied == 0) {
                $api_key = Config::get('api.key');
                $summoner_data = "https://".$user->region.".api.pvp.net/api/lol/".$user->region."/v1.4/summoner/".$user->summoner->summonerid."/runes?api_key=".$api_key;
                $json = @file_get_contents($summoner_data);
                if($json === FALSE) {
                    Session::flash('message', 'No Summoner found');
                    return Redirect::to('/einstellungen');
                } else {
                    $obj = json_decode($json, true);
                    $runes = $obj[$user->summoner->summonerid]["pages"];

                    foreach($runes as $page) {
                        if($page["name"] == $user->verify_string) {
                            $user->summoner_veryfied = 1;
                            $user->save();
                            return Redirect::to('/einstellungen')->with("success", "Summoner wurde verifiziert!");
                        }
                    }
                }
            } else {
                // No correct summoner status
                return View::make('users.verify', compact('user', 'runes'));
            }
            return View::make('users.verify', compact('user', 'runes'));
        } else {
            return Redirect::to('/login')->with("error", "Bitte einloggen.");
        }
    }

    public function save() {
        $input = Input::all();
        $validation = Validator::make($input, User::$rules);



        if ($validation->passes())
        {
                $user = User::create($input);
                $summoner_found = $user->addSummoner(Input::get('region'), Input::get('summoner_name'), $user);
                if($summoner_found) {
                    $user->password = Hash::make(Input::get('password'));
                    $user->verify_string = str_random(10);
                    $user->save();
                    return Redirect::to('/login')->with("success", "User erstellt - Bitte einloggen");
                } else {
                    $messages = $validation->messages();
                    return Redirect::to("/register")
                        ->withInput()
                        ->withErrors($validation)
                        ->with('error', 'There were validation errors.')->with('input', Input::all())->with('messages', $messages);
                }
        } else {
            $messages = $validation->messages();
            return Redirect::to("/register")
                ->withInput()
                ->withErrors($validation)
                ->with('error', 'There were validation errors.')->with('input', Input::all())->with('messages', $messages);
        }

    }

    public function updateAccount() {
        $input = Input::all();
        $validation = Validator::make($input, User::$rules);
        if ($validation->passes())
        {
            $user = Auth::user();
            $user->update($input);
            if(Input::get('password') != "") {
                $user->password = Hash::make(Input::get('password'));
            }
            $user->save();
            return Redirect::to('/account/edit/')->with("success", "Eingaben gespeichert!");
        } else {
            $messages = $validation->messages();
            return Redirect::to("/account/edit/")
                ->withInput()
                ->withErrors($validation)
                ->with('error', 'Es sind Fehler aufgetreten!.')->with('input', Input::all());
        }
    }


    public function login()
    {
        if(Auth::check()) {
            return Redirect::to('/users');
        } else {
            return View::make("users.login")->with("error", "Fehler beim einloggen. Username/Passwort falsch.");
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to("/")->with("success", "Du wurdest ausgeloggt");
    }

    public function doLogin()
    {
        // validate the info, create rules for the inputs
        $rules = array();

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('/login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email' 	=> Input::get('email'),
                'password' 	=> Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                return Redirect::to("/");

            } else {
                // validation not successful, send back to form
                return Redirect::to('/login');

            }

        }
    }

}