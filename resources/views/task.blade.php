@extends('layouts.main')

@section('content')
	<div class="container">
		<br>
		@if(isset($tasks))
			@foreach($tasks as $task)
				<h3 class='ad-post-title'>{{$task->title}}</h3>
				<p class='ad-post-meta'>Created {{ \Carbon\Carbon::parse($task->created_at)->format('Y-m-d H:i') }}</p>
				{{$task->description}}
				<br>
				<br>
				@guest
                @else
                    @if (Auth::user()->id == $task->user_id)
					<a href="delete/{{$task->id}}"><button class="btn" type="submit">Delete</button></a> 
					<a href="/edit/{{$task->id}}"><button class="btn m-x-1" type="submit">Edit</button></a>
					@endif
                @endguest
			@endforeach
		@endif
	</div>
@endsection