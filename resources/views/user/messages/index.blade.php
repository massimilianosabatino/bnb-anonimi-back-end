@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Navigation bar --}}
    <div class="button-bar my-4">
        <a href="{{ route('user.apartment.show', $apartment_id) }}" type="button" class="btn btn-outline-secondary ms-auto">Back</a>
    </div>
    {{-- /Navigation bar --}}
    <div class="row my-4">
        <div class="col">
            <h1>Messaggi ricevuti</h1>
        </div>
    </div>
    <div class="row">
        {{-- Messages toas --}}
        @if (session('message'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3" id="message">
            <div class="toast show align-items-center my-bg-success border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex py-2">
                    <div class="toast-body fw-bold">
                        {{ session('message') }}
                    </div>
                    <button type="button" class="btn-close me-3 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif
        {{-- /Messages toas --}}
        <div class="col">
            {{-- With messages --}}
            @if ($messages->isNotEmpty())
            @foreach ($messages as $message)
            <div class="accordion" id="accordion-{{ $loop->index }}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                        <button class="accordion-button @if(!$loop->first) collapsed @endif" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}"
                            aria-expanded="@if($loop->first)true @else false @endif"
                            aria-controls="collapse-{{ $loop->index }}">
                            <div class="d-flex justify-content-between w-100">
                                <div class="name">{{ $message->name }}</div>
                                <div class="date me-5">{{ $message->send_date }}</div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $loop->index }}"
                        class="accordion-collapse collapse @if($loop->first) show @endif"
                        aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#accordion-{{ $loop->index }}">
                        <div class="accordion-body">
                            {{ $message->content }}
                        </div>
                        {{-- Delete button --}}
                        <div class="ms-4 mb-4">
                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                data-bs-target="#delete{{ $message->id }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                        {{-- /Delete button --}}
                    </div>
                </div>
            </div>

            {{-- Delete modal --}}
            <div class="modal fade" id="delete{{ $message->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>Cancellare messaggio di {{ $message->name }}, del {{ $message->send_date }} ?</div>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('user.message.destroy', $message) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                <button type="submit" class="btn btn-danger">Cancella</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Delete modal --}}
            @endforeach
            {{-- /With messages --}}
            {{-- Without messages --}}
            @else
            <h2>Nessun messaggio per questo appartamento</h2>
            @endif
            {{-- Without messages --}}
        </div>

    </div>
</div>

@endsection