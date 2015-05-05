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
        <strong><a href="/users/{{ $comment->user->username }}">{{ $comment->user->username }}</a></strong><br/>
        <div class="badge"><a href="/users/{{ $comment->user->username }}">Level {{ $comment->user->level }}</a></div>
        @if($comment->user->summoner)
            <a href="http://summoner.flashignite.com/{{ $comment->user->summoner->region }}/{{ $comment->user->summoner->name }}"><img height="50" src="http://summoner.flashignite.com/img/stats/tiers/{{ $comment->user->summoner->solo_tier }}_I.png" alt=""></a><br/>
            {{ $comment->user->summoner->solo_tier }} {{ $comment->user->summoner->solo_division }}
        @endif
    </div>
    <div class="col-md-10 ">
        <div class="small">{{ Helpers::diffForHumans($comment->created_at)  }}</div>
        {{ $comment->comment }}
    </div>
</div>
@endforeach