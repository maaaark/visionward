<div class="article">
{{ BBCode::render($post->content) }}<br/>
</div>
@if($post->show_autorbox == 1)
<div class="autor_box">
	<table>
		<tr>
			<td width="100">
				<a href="/users/{{ $post->user->id }}"><img src="/img/team/{{ $post->user->image }}" class="img-circle" width="75" /></a>
			</td>
			<td valign="top">
				Artikel wurde geschrieben von: <strong><a href="/users/{{ $post->user->id }}">{{ $post->user->first_name }} '{{ $post->user->username }}' {{ $post->user->last_name }}</a></strong><br/>
				<i>{{ $post->user->autor_text }}</i>
			</td>
		</tr>
	</table>
</div>
@endif
<br/>
@include("posts.comments")