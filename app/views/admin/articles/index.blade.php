@extends('layouts.admin')
@section('title', "Artikel")
@section('content')
	<a href="/admin/articles/create" class="btn btn-primary">Neuen Artikel schreiben</a><br/>
	<br/>
	<table class="table table-striped">
			<tr>
				<th>Titel</th>
				<th>User</th>
				<th>Erstellt</th>
				<td>Status</td>
				<th>Korrigiert</th>
				<th>Öffentlich</th>
				<th>Löschen</th>
			</tr>
		@foreach($articles as $article)
			@if($article->published == 1 && $article->corrected == 0)
			<tr class="warning">
			@elseif($article->published == 1)
			<tr class="success">
			@elseif($article->corrected == 1)
			<tr class="info">
			@else
			<tr>
			@endif
				<td><a href="/admin/articles/{{ $article->id }}/edit">{{ $article->title }}</a></td>
				<td><a href="/admin/articles/{{ $article->id }}/edit">{{ $article->user->first_name }}</a></td>
				<td>{{ $article->created_at }}</td>
				<td>
					@if($article->published == 1)
						Veröffentlicht
					@elseif($article->corrected == 1)
						Korrigiert
					@else
						Warte auf Korrektur
					@endif
				</td>
				<td>{{ $article->corrected }}</td>
				<td>{{ $article->published }}</td>
				<td><a href="/admin/articles/{{ $article->id }}/delete" class="delete">Löschen</a></td>
			</tr>
		@endforeach
	</table>
	{{ $articles->links() }}<br/>
	<a href="/admin/articles/create" class="btn btn-primary">Neuen Artikel schreiben</a>
	
@stop