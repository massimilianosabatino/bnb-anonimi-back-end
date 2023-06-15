@extends('layouts.app')

@section('content')
    <div class="container">
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
                        <td>{{ $apartment->price }}</td>
                        <td>{{ $apartment->slug }}</td>
                        <td>
                            <a href="{{ route('user.dashboard.show', $apartment) }}" role="button" class="btn btn-success">Info</a>
                        </td>
                        <td>
                            <a href="{{ route('user.dashboard.edit', $apartment) }}" role="button" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('user.dashboard.destroy', $apartment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input id='alert' type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                        <td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
