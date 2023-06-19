@extends('layouts.app')

@section('content')
    <div class="container p-4">
        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                @endforeach
            </div>
        @endif
        <form action="{{ route('user.apartment.update', $apartment) }}" method="POST" enctype="multipart/form-data"
            class="form-input-image">

            @csrf
            @method('PUT')
            <div class="row row-cols-1 row-cols-md-2 pt-3">
                <div>
                    {{-- TITLE --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title of the apartment</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="insert the title of your apartment" value="{{ old('title', $apartment->title) }}">
                    </div>

                    {{-- ROOMS --}}
                    <div class="mb-3">
                        <label for="rooms" class="form-label">Rooms</label>
                        <input type="text" class="form-control" id="rooms" name="rooms"
                            placeholder="insert the number of rooms" value="{{ old('rooms', $apartment->rooms) }}">
                    </div>

                    {{-- BATHROOMS --}}
                    <div class="mb-3">
                        <label for="bathrooms" class="form-label">Bathrooms</label>
                        <input type="text" class="form-control" id="bathrooms" name="bathrooms"
                            placeholder="insert the number of bathrooms"
                            value="{{ old('bathrooms', $apartment->bathrooms) }}">
                    </div>

                    {{-- BEDS --}}
                    <div class="mb-3">
                        <label for="beds" class="form-label">Beds</label>
                        <input type="text" class="form-control" id="beds" name="beds"
                            placeholder="insert the number of beds" value="{{ old('beds', $apartment->beds) }}">
                    </div>

                    {{-- SQUARE METERS --}}
                    <div class="mb-3">
                        <label for="square_meters" class="form-label">Square meters</label>
                        <input type="text" class="form-control" id="square_meters" name="square_meters"
                            placeholder="insert the Square meters"
                            value="{{ old('square_meters', $apartment->square_meters) }}">
                    </div>


                    {{-- COVER IMAGE --}}

                    <div class="mb-3 @if (!$apartment->cover_image) d-none @endif" id="image-input-container">
                        <label for="cover_image" class="form-label">Image</label>
                        <input class="form-control select_img" type="file" id="cover_image" name="cover_image">
                        <!-- anteprima immagine upload -->
                        <img class="img-fluid my-3" id="preview" @if ($apartment->cover_image) src="{{ asset('storage/' . $apartment->cover_image) }}" @endif>
                        <!-- /anteprima immagine upload -->
                    </div>

                    {{-- ADDRESS --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="insert the address" value="{{ old('address', $apartment->address) }}">
                    </div>


                    {{-- VISIBILITY --}}
                    <div>
                        <p>Set the visibility on our platform</p>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="visible" id="visible" autocomplete="off" {{ old('visible', $apartment->visible)? 'checked' : null }}
                                value="1">
                            <label class="btn btn-outline-primary" for="visible">Visible</label>

                            <input type="radio" class="btn-check" name="visible" id="notVisible" autocomplete="off" {{ old('visible', $apartment->visible)== 0? 'checked' : null }}
                                value="0">
                            <label class="btn btn-outline-primary" for="notVisible">Not Visible</label>
                        </div>
                    </div>

                    {{-- PRICE --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">Set the price</label>
                        <input type="text" class="form-control" id="price" name="price"
                            placeholder="insert the price" value="{{ old('price', $apartment->price) }}">
                    </div>
                </div>
                <div>
                    <P>Click on the services offered in your apartment</P>

                    <div class="btn-group row row-cols-4 row-cols-xol-6 gap-2" role="group"
                        aria-label="Basic checkbox toggle button group">

                        @foreach ($services as $service)
                            {{-- <input type="checkbox" class="btn-check" id="{{$service->id}}" autocomplete="off">
                            <label class="btn btn-outline-primary" for="{{$service->id}}">{{$service->name}}</label> --}}

                            <input type="checkbox" class="btn-check" id="{{ $service->id }}"
                                @if ($errors->any()) {{ in_array($service->id, old('service', [])) ? 'checked' : null }}
                                @else
                                    {{ $apartment->services->contains($service->id) ? 'checked' : null }} @endif
                                autocomplete="off" value="{{ $service->id }}" name="service[]">
                            <label
                                class="btn btn-outline-dark d-flex p-1 m-0 justify-content-center align-items-center rounded-2 flex-column"
                                for="{{ $service->id }}">{!! $service->icon !!}{{ $service->name }}</label><br>
                        @endforeach
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
        </form>
    </div>



    </div>
@endsection
