@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
	<div class="row">
		<div class="col-md-9 news-detail">
			<div class="box">
				<div class="cover-frame">
					@if($article->cover!=null)
					<img src="{{ asset('images/article/'.$article->cover) }}" class="img-fluid cover">
					@endif
				</div>
				<div class="content">
					<div class="title">
						{{ $article->title }}
					</div>
					<p class="body">
						{!! $article->body !!}
					</p>
					<div class="date">
						{{ date("H:i, d M Y", strtotime($article->created_at)) }}
					</div>
					<div class="tags">
						@foreach($tagList as $tag)
						<div class="badge badge-info badge-default tag tag-searchable">{{ $tag }}</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="title">Related Articles</div>
			@foreach($related_articles as $article)
			<div class="news-box card">
				<div class="news-date">{{ date("H:i, d M Y", strtotime($article->created_at)) }}</div>
				<div class="news-img-frame">
					<img src="{{ asset('images/article/'.$article->cover) }}" class="card-img">
				</div>
				<div class="card-body">
					<div class="card-title"><a href="{{ url('articles/'.$article->id) }}">{{ $article->title }}</a></div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection