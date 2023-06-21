@extends('layouts.app')

@section('content')
<ul>
    {{ $message }}
    @foreach ($messages as $message)
    <li>
        {{ $message->name }}
    </li>
        
    @endforeach
</ul>
@endsection