@extends('layout')
@section('content')
<div class="container">
    @foreach ($blogs as $blog)
        {{ $blog->title }}
    @endforeach
</div>
{{ $blogs->onEachSide(2)->links('pagination') }}
@endsection