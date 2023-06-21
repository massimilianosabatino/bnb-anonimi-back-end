@extends('layouts.app')

@section('content')
<ul>
    @if ($messages->isNotEmpty())
    @foreach ($messages as $message)
    <li>
        <a href="{{ route('user.message.show', $message) }}">{{ $message->name }}</a>
    </li>
        
    @endforeach
    @else
    picche
    @endif
</ul>
@endsection