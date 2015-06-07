<h2 class="headline">Kommentar schreiben</h2>
@if(Auth::check())
    <div class="row">
        <div class="col-md-2">
            <div class="comment_write_user">
                <a href="http://summoner.flashignite.com/{{ trim(strtolower(Auth::user()->summoner->region)) }}/{{ trim(Auth::user()->summoner->name) }}">
                    <img class="comment_write_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/{{ Auth::user()->summoner->profileIconId }}.png" class="img-circle" alt="{{ Auth::user()->summoner->name }}" />
                </a>
                <div style="font-weight: bold;text-align: center;">
                    <a href="http://summoner.flashignite.com/{{ trim(strtolower(Auth::user()->summoner->region)) }}/{{ trim(Auth::user()->summoner->name) }}">{{ Auth::user()->summoner->name }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            {{ Form::open(array('action' => 'PostController@saveComment', 'method' => 'post')) }}
            <input type="hidden" name="post_id" value="{{ $post->id }}" />
            <textarea name="comment" class="comment_textarea" placeholder="Verfasse hier deinen Kommentar ..."></textarea>
            <br/>
            {{ Form::submit("Kommentar abschicken", array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
@else
    <div class="center">
        <a href="/login">Bitte einloggen</a> um Kommentare schreiben zu können.<br/>
        Noch keinen Account? <a href="/users/create">Jetzt kostenlos anmelden!</a>
    </div>
@endif
<br/>
<h2 class="headline">Kommentare</h2>
@foreach($post->comments as $comment)
    @if($comment->parent_comment == 0)
    <div class="row comment_element">
        <div class="col-md-1 center" style="padding-right: 0px;">
            @if($comment->user)
                <a href="http://summoner.flashignite.com/{{ trim(strtolower($comment->user->summoner->region)) }}/{{ trim($comment->user->summoner->name) }}"><img class="comment_user_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/{{ $comment->user->summoner->profileIconId }}.png" class="img-circle" alt="{{ $comment->user->summoner->name }}" /></a>
            @else
                <img class="comment_user_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/1.png">
            @endif
        </div>
        <div class="col-md-11 ">
            <div class="comment_info">
                @if($comment->user)
                    <a href="http://summoner.flashignite.com/{{ trim(strtolower($comment->user->summoner->region)) }}/{{ trim($comment->user->summoner->name) }}"><span class="comment_summoner">{{ trim($comment->user->summoner->name) }}</span></a>
                @else
                    <span style="font-weight: bold;color: #555;">Gel&ouml;schter User</span>
                @endif
                <span class="comment_bull">&bull;</span>
                <span class="comment_date">{{ trim(Helpers::diffForHumans($comment->created_at)) }}</span>
            </div>
            <div class="comment_content">{{ $comment->comment }}</div>
            <div class="comment_bar">
                <span class="answer">Auf Kommentar antworten</span>
            </div>
            <div class="comment_answers">
                <div class="write_answer">
                    <!-- Dieser Service ist momentan noch deaktiviert.-->
                    {{ Form::open(array('action' => 'PostController@saveComment', 'method' => 'post')) }}
                    <div><textarea name="comment" class="answer_input" placeholder="Antwort hier verfassen ..."></textarea></div>
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                    <input type="hidden" name="parent_comment" value="{{ $comment->id }}" />
                    <div>{{ Form::submit("Antwort absenden", array('class' => 'btn btn-primary')) }}</div>
                    {{ Form::close() }}
                </div>
                @foreach($post->comments as $answer)
                    @if($answer->parent_comment == $comment->id)
                        <div class="row comment_answer">
                            <div class="col-md-1 center" style="padding-right: 0px;">
                                @if($answer->user)
                                    <a href="http://summoner.flashignite.com/{{ trim(strtolower($answer->user->summoner->region)) }}/{{ trim($answer->user->summoner->name) }}"><img class="comment_user_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/{{ $answer->user->summoner->profileIconId }}.png" class="img-circle" alt="{{ $answer->user->summoner->name }}" /></a>
                                @else
                                    <img class="comment_user_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/1.png">
                                @endif
                            </div>
                            <div class="col-md-11 ">
                                <div class="comment_info">
                                    @if($answer->user)
                                        <a href="http://summoner.flashignite.com/{{ trim(strtolower($answer->user->summoner->region)) }}/{{ trim($answer->user->summoner->name) }}"><span class="comment_summoner">{{ trim($answer->user->summoner->name) }}</span></a>
                                    @else
                                        <span style="font-weight: bold;color: #555;">Gel&ouml;schter User</span>
                                    @endif
                                    <span class="comment_bull">&bull;</span>
                                    <span class="comment_date">{{ trim(Helpers::diffForHumans($answer->created_at)) }}</span>
                                </div>
                                <div class="comment_content">
                                    {{{ $answer->comment }}}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endforeach

<script>
    $(document).ready(function(){
        $(".comment_element .comment_bar .answer").click(function(){
            if($(this).hasClass("active")){
                $(this).parent().parent().find(".write_answer").hide();
                $(this).removeClass("active");
            } else {
                $(this).parent().parent().find(".write_answer").show();
                $(this).addClass("active");
            }
        });
    });
</script>