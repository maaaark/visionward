<h2 class="headline">Kommentar schreiben</h2>
@if(Auth::check())
    Eingeloggt als {{ Auth::user()->username }}:<br/>
    {{ Form::open(array('action' => 'PostController@saveComment', 'method' => 'post')) }}
    <input type="hidden" name="post_id" value="{{ $post->id }}" />
    <textarea name="comment" style="width: 100%; height: 120px;"></textarea>
    <br/>
    {{ Form::submit("Kommentar abschicken", array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
@else
    <div class="center">
        <a href="/login">Bitte einloggen</a> um Kommentare schreiben zu können.<br/>
        Noch keinen Account? <a href="/users/create">Jetzt kostenlos anmelden!</a>
    </div>
@endif
<br/>
<h2 class="headline">Kommentare</h2>
@foreach($post->comments as $comment)
<div class="row comment_bottom">
    <div class="col-md-2 center">
        @if($comment->user)
        <strong><a href="http://summoner.flashignite.com/{{ $comment->user->summoner->region }}/{{ $comment->user->summoner->name }}">{{ $comment->user->username }}</a></strong><br/>
        <a href="http://summoner.flashignite.com/{{ $comment->user->summoner->region }}/{{ $comment->user->summoner->name }}"><img width="50" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/{{ $comment->user->summoner->profileIconId }}.png" class="img-circle" alt="{{ $comment->user->summoner->name }}" /></a>
        <div class="badge"><a href="http://summoner.flashignite.com/{{ $comment->user->summoner->region }}/{{ $comment->user->summoner->name }}">Level {{ $comment->user->level }}</a></div><br/>
        @if($comment->user->summoner)
            <a href="http://summoner.flashignite.com/{{ $comment->user->summoner->region }}/{{ $comment->user->summoner->name }}"><img height="50" src="http://summoner.flashignite.com/img/stats/tiers/{{ $comment->user->summoner->solo_tier }}_I.png" alt=""></a><br/>
            {{ $comment->user->summoner->solo_tier }} {{ $comment->user->summoner->solo_division }}
        @endif
        @else
            Gelöschter User
        @endif
    </div>
    <div class="col-md-10 ">
        <div class="small">{{ Helpers::diffForHumans($comment->created_at) }}</div>
        {{ $comment->comment }}
    </div>
</div>
@endforeach