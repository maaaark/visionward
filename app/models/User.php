<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $connection = 'mysql2';
	protected $table = 'users';
	protected $fillable = array('password', 'username', 'first_name', 'last_name', 'email', 'roles', 'description', 'image', 'task', 'autor_text', 'twitter', 'twitch', 'order', 'updated_at', 'created_at');
	
	public static $rules = array(
		'email'=>'required|unique:users',
		'summoner_name'=>'required',
        'region'=>'required',
        'password' => 'confirmed|min:5'
	);
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public function posts() {
		return $this->hasMany('Post');
	}

    public function comments() {
        return $this->hasMany('Comment');
    }

	public function roles()
    {
        return $this->belongsToMany('Role');
    }
	
	public function hasRole($key)
    {
        foreach($this->roles as $role){
            if($role->name === $key)
            {
                return true;
            }
        }
        return false;
    }

    public function summoner() {
        return $this->hasOne("Summoner", "summoner_id", "summoner_id");
    }

    public function userlevel() {
        return $this->hasOne("Level", "level", "level");
    }

    public function addExp($exp) {
        if(Auth::check()){
            $user = Auth::user();
            $user->exp = $user->exp + $exp;
            $user->save();

            if($user->exp >= $user->userlevel->end_exp) {
                $user->level = $user->level +1;
                $user->save();
            }
        }
    }

    public function addSummoner($region, $summoner_name){
        $region = trim(strtolower($region));
        if(isset($this->allowed_regions[$region]) && isset($this->allowed_regions[$region]["status"]) && $this->allowed_regions[$region]["status"] == true){
            $data = Summoner::where('name', 'LIKE', trim($summoner_name))->where("region","=",$region)->first();

            $need_api_request = true;
            if(isset($data["id"]) && $data["id"] > 0){
                $date1   = date('Y-m-d H:i:s');
                $date2   = $data["last_update_maindata"];
                $diff    = abs(strtotime($date2) - strtotime($date1));
                $mins    = floor($diff / 60);

                if($mins < $this->summoner_update_interval){
                    $need_api_request = false;
                }
            }

            if($need_api_request){
                $clean_summoner_name = str_replace(" ", "", $summoner_name);
                $clean_summoner_name = strtolower($clean_summoner_name);
                $clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');

                $api_key 		   = Config::get('api.key');
                $summoner_name_url = trim(str_replace(" ", "%20", $region));
                $summoner_data     = $this->allowed_regions[$region]["api_endpoint"]."/api/lol/".$region."/v1.4/summoner/by-name/".$clean_summoner_name."?api_key=".$api_key;
                $json = @file_get_contents($summoner_data);
                if($json === FALSE) {
                    return Redirect::to("/")->with("error", "There was an error with the Riot API, please try again later! Code: 005");
                } else {
                    $obj = json_decode($json, true);
                    $summoner = Summoner::where("name","=",$obj[$clean_summoner_name]["name"])->where("region","=",$region)->first();
                    if(!$summoner) {
                        $summoner = new Summoner;
                    }
                    $summoner->summoner_id = $obj[$clean_summoner_name]["id"];
                    $summoner->name = $obj[$clean_summoner_name]["name"];
                    $summoner->profileIconId = $obj[$clean_summoner_name]["profileIconId"];
                    $summoner->summonerLevel = $obj[$clean_summoner_name]["summonerLevel"];
                    $summoner->revisionDate = $obj[$clean_summoner_name]["revisionDate"];
                    $summoner->region = $region;
                    $summoner->last_update_maindata = date('Y-m-d H:i:s');
                    $summoner_stats = $this->allowed_regions[$region]["api_endpoint"]."/api/lol/".$region."/v1.3/stats/by-summoner/".$summoner->summoner_id."/summary?season=".$this->current_season."&api_key=".$api_key;
                    $json2 = @file_get_contents($summoner_stats);
                    if($json2 === FALSE) {
                        return View::make('searches.show_result', compact('searchString', 'news', 'champs', 'players', 'teams', 'summoner'));
                    } else {
                        $obj2 = json_decode($json2, true);
                        if(isset($obj2["playerStatSummaries"])){
                            foreach($obj2["playerStatSummaries"] as $gamemode){
                                if($gamemode["playerStatSummaryType"] == 'RankedSolo5x5'){
                                    $summoner->ranked_wins   = $gamemode['wins'];
                                    $summoner->ranked_losses = $gamemode['losses'];
                                    $summoner->ranked_data   = json_encode($gamemode);
                                }
                                if($gamemode["playerStatSummaryType"] == 'Unranked'){
                                    $summoner->unranked_wins = $gamemode['wins'];
                                    $summoner->unranked_data = json_encode($gamemode);
                                }
                                if($gamemode["playerStatSummaryType"] == 'RankedTeam5x5'){
                                    $summoner->teamranked_wins   = $gamemode['wins'];
                                    $summoner->teamranked_losses = $gamemode['losses'];
                                    $summoner->teamranked_data   = json_encode($gamemode);
                                }
                            }
                        }
                        $summoner = $this->updateRankedData($summoner, $summoner->summoner_id, $region);
                        $summoner->save();
                    }
                    $data = Summoner::where('name', 'LIKE', trim($summoner_name))->first();
                }
            }

            /* SUMMONER_DATEN anzeigen */
            if(isset($data["id"]) && $data["id"] > 0){
                include 'summoner/detail.init.php';
                $init = new SummonerInit;
                return $init->init($data, $region, $this->allowed_regions[$region]["name"], $this->summoner_update_interval);
            } else {
                echo "Summoner nicht gefunden";
            }
        } else {
            echo "gesperrte region";
        }
    }
}