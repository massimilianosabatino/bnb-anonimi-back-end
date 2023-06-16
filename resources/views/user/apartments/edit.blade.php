@extends('layouts.app')

@section('content')
    <div class="container p-4">
        <form action="{{ route('user.apartment.update',$apartment) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- TITLE --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title of the apartment</label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="insert the title of your apartment" value="{{ old('title') }}">
            </div>

            {{-- ROOMS --}}
            <div class="mb-3">
                <label for="rooms" class="form-label">Rooms</label>
                <input type="text" class="form-control" id="rooms" name="rooms"
                    placeholder="insert the number of rooms" value="{{ old('rooms') }}">
            </div>

            {{-- BATHROOMS --}}
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="text" class="form-control" id="bathrooms" name="bathrooms"
                    placeholder="insert the number of bathrooms" value="{{ old('bathrooms') }}">
            </div>

            {{-- BEDS --}}
            <div class="mb-3">
                <label for="beds" class="form-label">Beds</label>
                <input type="text" class="form-control" id="beds" name="beds"
                    placeholder="insert the number of beds" value="{{ old('beds') }}">
            </div>

            {{-- SQUARE METERS --}}
            <div class="mb-3">
                <label for="square_meters" class="form-label">Square meters</label>
                <input type="text" class="form-control" id="square_meters" name="square_meters"
                    placeholder="insert the Square meters" value="{{ old('square_meters') }}">
            </div>

            {{-- COVER IMAGE --}}
            <div class="thumb-input-wrapper">
                {{-- <div class="mb-3 d-none" id="link-input">
            <label for="cover_image" class="form-label">Cover Image File</label>
            <input class="form-control" type="file" id="cover_image" name="cover_image">
        </div> --}}
                <div class="mb-3" id="link-file">
                    <label for="thumb" class="form-label">Cover Image Link</label>
                    <input type="text" class="form-control" id="cover_image" name="cover_image"
                        placeholder="Insert the cover image link" value="{{ old('cover_image') }}">
                </div>
            </div>

            {{-- ADDRESS --}}
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="insert the address"
                    value="{{ old('address') }}">
            </div>


            {{-- VISIBILITY --}}
            <div>
                <p>Set the visibility on our platform</p>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="visible" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="visible">Visible</label>

                    <input type="radio" class="btn-check" name="btnradio" id="notVisible" autocomplete="off">
                    <label class="btn btn-outline-primary" for="notVisible">Not Visible</label>
                </div>
            </div>

            {{-- PRICE --}}
            <div class="mb-3">
                <label for="price" class="form-label">Set the price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="insert the price"
                    value="{{ old('price') }}">
            </div>

            <button type="submit" class="btn btn-success">Create</button>
        </form>

    </div>
@endsection
