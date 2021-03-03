@extends('layouts.app')

@section('content')
<div class="lg:flex-1 lg:mx-10 lg:mb-10" style="max-width: 700px">
    @include ('_publish-tweet-panel')

    @include ('_timeline')
</div>
@endsection
