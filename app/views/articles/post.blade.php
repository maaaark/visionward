{{ $article->content }}<br/>
@if($article->show_autorbox == 1)
<div class="autor_box">
	<table>
		<tr>
			<td width="100">
				<a href="/users/{{ $article->user->id }}"><img src="/img/team/{{ $article->user->image }}" class="img-circle" width="75" /></a>
			</td>
			<td valign="top">
				Artikel wurde geschrieben von: <strong><a href="/users/{{ $article->user->id }}">{{ $article->user->first_name }} '{{ $article->user->username }}' {{ $article->user->last_name }}</a></strong><br/>
				<i>{{ $article->user->autor_text }}</i>
			</td>
		</tr>
	</table>
</div>
@endif
<br/>
@include("layouts.disqus")