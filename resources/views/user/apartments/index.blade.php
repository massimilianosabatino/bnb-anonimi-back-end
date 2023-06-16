@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <a class="btn btn-primary" href="{{ route('user.apartment.create') }}">Create</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Rooms</th>
                    <th scope="col">Bathrooms</th>
                    <th scope="col">Beds</th>
                    <th scope="col">Square Meters</th>
                    <th scope="col">Address</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Longitude</th>
                    <th scope="col">Visible</th>
                    <th scope="col">Price</th>
                    <th scope="col">Slug</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>


            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $apartment->title }}</td>
                        <td>{{ $apartment->rooms }}</td>
                        <td>{{ $apartment->bathrooms }}</td>
                        <td>{{ $apartment->beds }}</td>
                        <td>{{ $apartment->square_meters }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>{{ $apartment->latitude }}</td>
                        <td>{{ $apartment->longitude }}</td>
                        @if ($apartment->visible == true)
                            <td><i class="fa-solid fa-check"></i></td>
                        @elseif ($apartment->visible == false)
                            <td><i class="fa-solid fa-xmark"></i></td>
                        @endif
                        <td>{{ $apartment->price }}€</td>
                        <td>{{ $apartment->slug }}</td>
                        <td>
                            <a href="{{ route('user.apartment.show', $apartment->id) }}" role="button"
                                class="btn btn-success">Info</a>
                        </td>
                        <td>
                            <a href="{{ route('user.apartment.edit', $apartment) }}" role="button"
                                class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#delete{{ $apartment->id }}">
                                Delete
                            </button>
                        </td>
                        <td>
                    </tr>
                    {{-- Modale delete --}}
                    <div class="modal fade" id="delete{{ $apartment->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">DELETE</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>Delete apartment n°{{ $apartment->id }}: {{ $apartment->title }} ?</div>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('user.apartment.destroy', $apartment) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
