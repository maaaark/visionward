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
<?php $comments_status = false; ?>
@foreach($post->comments as $comment)
    @if($comment->parent_comment == 0)
    <?php $comments_status = true; ?>
    <div class="row comment_element">
        <div class="col-xs-1 center" style="padding-right: 0px;">
            @if($comment->user)
                <a href="http://summoner.flashignite.com/{{ trim(strtolower($comment->user->summoner->region)) }}/{{ trim($comment->user->summoner->name) }}"><img class="comment_user_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/{{ $comment->user->summoner->profileIconId }}.png" class="img-circle" alt="{{ $comment->user->summoner->name }}" /></a>
            @else
                <img class="comment_user_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/1.png">
            @endif
        </div>
        <div class="col-xs-11 ">
            <div class="comment_info">
                @if($comment->user)
                    <a href="http://summoner.flashignite.com/{{ trim(strtolower($comment->user->summoner->region)) }}/{{ trim($comment->user->summoner->name) }}"><span class="comment_summoner">{{ trim($comment->user->summoner->name) }}</span></a>
                    <span class="comment_bull">&bull;</span>
                    <span class="comment_user_level">Level {{ $comment->user["level"] }}</span>
                @else
                    <span style="font-weight: bold;color: #555;">Gel&ouml;schter User</span>
                @endif
                <span class="comment_bull">&bull;</span>
                <span class="comment_date">{{ trim(Helpers::diffForHumans($comment->created_at)) }}</span>
            </div>
            <div class="comment_content">{{ strip_tags($comment->comment) }}</div>
            <div class="comment_bar">
            	@if(Auth::check())
                <span class="rate">
                  @if(Helpers::getCommentVotes($comment->id) != 0)
                     <span class="current_vote">{{ Helpers::getCommentVotes($comment->id) }}</span>
                  @endif
                  @if(Helpers::checkCommentVoted("up", $comment->id))
                     <div class="vote_btn up active" data-id="{{ $comment->id }}" data-type="up"><i class="fa fa-chevron-up"></i></div>
                  @else
                     <div class="vote_btn up" data-id="{{ $comment->id }}" data-type="up"><i class="fa fa-chevron-up"></i></div>
                  @endif
                 |
                  @if(Helpers::checkCommentVoted("down", $comment->id))
                     <div class="vote_btn down active" data-id="{{ $comment->id }}" data-type="down"><i class="fa fa-chevron-down"></i></div>
                  @else
                     <div class="vote_btn down" data-id="{{ $comment->id }}" data-type="down"><i class="fa fa-chevron-down"></i></div>
                  @endif
                </span>
                <span class="comment_bull">&bull;</span>
                <span class="answer">Auf Kommentar antworten</span>
                @endif
            </div>
            <div class="comment_answers">
            	@if(Auth::check())
                <div class="write_answer">
                    <!-- Dieser Service ist momentan noch deaktiviert.-->
                    {{ Form::open(array('action' => 'PostController@saveComment', 'method' => 'post')) }}
                    <div><textarea name="comment" class="answer_input" placeholder="Antwort hier verfassen ..."></textarea></div>
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                    <input type="hidden" name="parent_comment" value="{{ $comment->id }}" />
                    <div>{{ Form::submit("Antwort absenden", array('class' => 'btn btn-primary')) }}</div>
                    {{ Form::close() }}
                </div>
                @endif
                @foreach($post->comments as $answer)
                    @if($answer->parent_comment == $comment->id)
                        <div class="row comment_answer">
                            <div class="col-xs-1 center" style="padding-right: 0px;">
                                @if($answer->user)
                                    <a href="http://summoner.flashignite.com/{{ trim(strtolower($answer->user->summoner->region)) }}/{{ trim($answer->user->summoner->name) }}"><img class="comment_user_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/{{ $answer->user->summoner->profileIconId }}.png" class="img-circle" alt="{{ $answer->user->summoner->name }}" /></a>
                                @else
                                    <img class="comment_user_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/1.png">
                                @endif
                            </div>
                            <div class="col-xs-11 ">
                                <div class="comment_info">
                                    @if($answer->user)
                                        <a href="http://summoner.flashignite.com/{{ trim(strtolower($answer->user->summoner->region)) }}/{{ trim($answer->user->summoner->name) }}"><span class="comment_summoner">{{ trim($answer->user->summoner->name) }}</span></a>
                                        <span class="comment_bull">&bull;</span>
                                        <span class="comment_user_level">Level {{ $answer->user["level"] }}</span>
                                    @else
                                        <span style="font-weight: bold;color: #555;">Gel&ouml;schter User</span>
                                    @endif
                                    <span class="comment_bull">&bull;</span>
                                    <span class="comment_date">{{ trim(Helpers::diffForHumans($answer->created_at)) }}</span>
                                </div>
                                <div class="comment_content">
                                    {{{ strip_tags($answer->comment) }}}
                                </div>
                                <div class="comment_bar">
                                    @if(Auth::check())
                                     <span class="rate">
                                       @if(Helpers::getCommentVotes($answer->id) != 0)
                                          <span class="current_vote">{{ Helpers::getCommentVotes($answer->id) }}</span>
                                       @endif
                                       @if(Helpers::checkCommentVoted("up", $answer->id))
                                          <div class="vote_btn up active" data-id="{{ $answer->id }}" data-type="up"><i class="fa fa-chevron-up"></i></div>
                                       @else
                                          <div class="vote_btn up" data-id="{{ $answer->id }}" data-type="up"><i class="fa fa-chevron-up"></i></div>
                                       @endif
                                      |
                                       @if(Helpers::checkCommentVoted("down", $answer->id))
                                          <div class="vote_btn down active" data-id="{{ $answer->id }}" data-type="down"><i class="fa fa-chevron-down"></i></div>
                                       @else
                                          <div class="vote_btn down" data-id="{{ $answer->id }}" data-type="down"><i class="fa fa-chevron-down"></i></div>
                                       @endif
                                     </span>
                                     @endif
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

@if($comments_status == false)
	<div style="padding: 25px;color: rgba(0,0,0,0.6);text-align: center;">
		Es wurden noch keine Kommentare gepostet.
	</div>
@endif

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
        
        $(".comment_element .comment_bar .rate .vote_btn").click(function(){
            if($(this).hasClass("active")){
               // Aktuelle Wertung ausgewählt -> nichts machen
            } else {
               var element = $(this);
               $.post("/comment/rateComment", {type: $(this).attr("data-type"), id: $(this).attr("data-id") }).done(function(data){
                  current_vote = element.parent().find(".current_vote");
                  if(typeof current_vote != "undefined" && typeof current_vote.html() && current_vote.html()){
                     current_vote.html(data);
                  } else {
                     console.log("update");
                     element.parent().html('<span class="current_vote">'+data+'</span> '+element.parent().html());
                  }
               });
            }
            $(this).parent().find(".active").removeClass("active");
            $(this).addClass("active");
            
            
        });
    });
</script>