<div class="headline">{{ $post->title }}</div>
	
<div class="post_meta">
	{{ $post->created_at->diffForHumans() }} - gepostet von Mark -
	Kategorien:
	@foreach($post->categories as $category)
		<a href="/categories/{{ $category->slug }}">{{ $category->name }}</a>
	@endforeach
</div>

{{ $post->content }}<br/>
<br/><br/>
@include("layouts.disqus")