@extends('layouts.app')

@section('content')
    <div class="container d-flex">
        <div class="row row-cols-3">
            @foreach ($galleries as $gallery)
                <div class="card p-0 hard-disk-zoppo col-3 m-3">
                    <img class="card-img-top" src="{{$gallery->image_path }}" alt="{{ $gallery->title }}">
                    <div class="card-body">
                        <p class="card-text">
                            {{ $gallery->title }}
                        </p>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-{{$gallery->id}}">
                            Elimina
                        </button>
                        <div class="modal fade" id="delete-{{$gallery->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Confermi di voler eliminare {{ $gallery->title }} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Chiudi</button>
                                        <form action="{{ route('user.gallery.destroy', $gallery) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Cancella</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </ul>
        </div>
    @endsection
