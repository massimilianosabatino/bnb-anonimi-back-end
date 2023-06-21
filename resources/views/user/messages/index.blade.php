@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-4">
        <div class="col">
            <h1>Messaggi ricevuti</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($messages->isNotEmpty())
            @foreach ($messages as $message)
            <div class="accordion" id="accordion-{{ $loop->index }}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                        <button class="accordion-button @if(!$loop->first) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}"
                            aria-expanded="@if($loop->first)true @else false @endif" aria-controls="collapse-{{ $loop->index }}">
                            <div class="d-flex justify-content-between w-100">
                                <div class="name">{{ $message->name }}</div>
                                <div class="date me-5">{{ $message->send_date }}</div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $loop->index }}" class="accordion-collapse collapse @if($loop->first) show @endif" aria-labelledby="heading-{{ $loop->index }}"
                        data-bs-parent="#accordion-{{ $loop->index }}">
                        <div class="accordion-body">
                            {{ $message->content }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection