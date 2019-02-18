@extends('layouts.main')

@section('content')
	<div class="container h-100" style="background-color: ">
		<br>
		@guest
			<div class="text-xs-center h1 p-y-3">
				<p>Please log in to use service.</p>
			</div>
		@else
			@if(isset($tasks))
				@foreach($tasks as $task)
					<h3 class='ad-post-title'><a href="/{{$task->id}}">{{$task->title}}</a></h3>
					<p class='ad-post-meta'>Created {{ \Carbon\Carbon::parse($task->created_at)->format('Y-m-d H:i') }}</p>
					{{$task->description}}
					<br>
					<br>
					@guest
					@else
						@if (Auth::user()->id == $task->user_id)
							<a href="delete/{{$task->id}}"><button class="btn">Delete</button></a>
							<a href="/edit/{{$task->id}}"><button class="btn m-x-1">Edit</button></a>
							<br>
							<br>
						@endif
					@endguest
					<hr>
					<br>
					<br>
				@endforeach
				{{ $tasks->links() }}
			@endif
		@endguest
	{{--
            @if(isset($tasks))
                @foreach($tasks as $task)
                    <h3 class='ad-post-title'><a href="/{{$task->id}}">{{$task->title}}</a></h3>
                    <p class='ad-post-meta'>Created {{substr($task->created_at, 0, strpos($task->created_at, ' '))}} by {{$task->author}}</p>
                    {{$task->description}}
                    <br>
                    <br>
                    @guest
                    @else
                        @if (Auth::user()->name == $task->author)
                        <a href="delete/{{$task->id}}"><button class="btn">Delete</button></a>
                        <a href="/edit/{{$task->id}}"><button class="btn m-x-1">Edit</button></a>
                        <br>
                        <br>
                        @endif
                    @endguest
                    <hr>
                    <br>
                    <br>
                @endforeach
                {{ $tasks->links() }}
            @endif
            --}}
        </div>
    @endsection