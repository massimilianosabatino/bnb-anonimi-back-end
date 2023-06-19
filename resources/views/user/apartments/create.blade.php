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
        <form action="{{ route('user.apartment.store') }}" method="POST" enctype="multipart/form-data"
            class="form-input-image">
            @csrf
            <div class="row row-cols-1 row-cols-md-2 pt-3">
                <div>
                    {{-- TITLE --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Nome dell'appartamento</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="inserisci nome dell'appartamento" value="{{ old('title') }}">
                    </div>

                    {{-- ROOMS --}}
                    <div class="mb-3">
                        <label for="rooms" class="form-label">Stanze</label>
                        <input type="text" class="form-control" id="rooms" name="rooms"
                            placeholder="inserisci numero delle stanze" value="{{ old('rooms') }}">
                    </div>

                    {{-- BATHROOMS --}}
                    <div class="mb-3">
                        <label for="bathrooms" class="form-label">Bagni</label>
                        <input type="text" class="form-control" id="bathrooms" name="bathrooms"
                            placeholder="inserisci numero di bagni" value="{{ old('bathrooms') }}">
                    </div>

                    {{-- BEDS --}}
                    <div class="mb-3">
                        <label for="beds" class="form-label">Letti</label>
                        <input type="text" class="form-control" id="beds" name="beds"
                            placeholder="inserisci numero dei letti" value="{{ old('beds') }}">
                    </div>

                    {{-- SQUARE METERS --}}
                    <div class="mb-3">
                        <label for="square_meters" class="form-label">Metri quadri</label>
                        <input type="text" class="form-control" id="square_meters" name="square_meters"
                            placeholder="inserisci metri quadri" value="{{ old('square_meters') }}">
                    </div>


                    {{-- COVER IMAGE --}}

                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Immagine</label>
                        <input class="form-control select_img" type="file" id="cover_image" name="cover_image">
                        <!-- anteprima immagine upload -->
                        <img id="preview" class="img-fluid my-3">
                        <!-- /anteprima immagine upload -->
                    </div>

                    {{-- ADDRESS --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Indirizzo</label>
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="Esempio: Via del Corso,9,Roma" value="{{ old('address') }}">
                    </div>



                    {{-- VISIBILITY --}}
                    <div>
                        <p>Scegli la visibilità dell'appartamento</p>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="visible" id="visible" autocomplete="off" checked
                                value="1">
                            <label class="btn btn-outline-primary" for="visible">Visibile</label>

                            <input type="radio" class="btn-check" name="visible" id="notVisible" autocomplete="off"
                                value="0">
                            <label class="btn btn-outline-primary" for="notVisible">Non Visibile</label>
                        </div>
                    </div>

                    {{-- PRICE --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">Prezzo</label>
                        <input type="text" class="form-control" id="price" name="price"
                            placeholder="Stabilisci Prezzo" value="{{ old('price') }}">
                    </div>
                </div>
                {{-- SERVICES --}}
                <div>
                    <P>Seleziona i servizi del tuo appartamento</P>

                    <div class="btn-group row row-cols-4 row-cols-xol-6 gap-2" role="group"
                        aria-label="Basic checkbox toggle button group">

                        @foreach ($services as $service)
                            {{-- <input type="checkbox" class="btn-check" id="{{$service->id}}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="{{$service->id}}">{{$service->name}}</label> --}}

                            <input type="checkbox" class="btn-check" id="{{ $service->id }}"
                                {{ in_array($service->id, old('service', [])) ? 'checked' : null }} autocomplete="off"
                                value="{{ $service->id }}" name="service[]">
                            <label
                                class="btn btn-outline-dark d-flex p-1 m-0 justify-content-center align-items-center rounded-2 flex-column"
                                for="{{ $service->id }}">{!! $service->icon !!}{{ $service->name }}</label><br>
                        @endforeach


                    </div>

                </div>
            </div>




            <button type="submit" class="btn btn-success">Crea</button>
        </form>

    </div>
@endsection
