@extends('layouts.app')

@section('content')
<ul>
    
    @foreach ($messages as $message)
    <li>
        {{ $message->name }}
    </li>
        
    @endforeach
</ul>
@endsection