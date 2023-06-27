@extends('layouts.app')

@section('content')
    <div class="container p-3 apartmentIndex">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger my-3 col-6 col-md-3" id="autorizzazione">{{ $error }}</div>
            @endforeach
        @endif
        {{-- barra con back e aggiungi appartamento --}}
        <div class="my-5">
            <a href="{{ route('user.dashboard') }}" type="button" class="btn btn-outline-secondary mb-3">Back</a>
        </div>

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
        <div class="rounded-2 border bg-white shadow p-4 my-4 stampParent">
            <div class="my-2 d-flex justify-content-between">
                <h1 class="fs-3 fw-bold mb-3">Gestisci i tuoi appartamenti</h1>
                <a class="btn btn-primary mb-3" href="{{ route('user.apartment.create') }}">Aggiungi appartamento</a>
            </div>
            <table class="table align-middle ">
                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-start">Nome</th>
                        <th class="d-none d-lg-none d-xl-table-cell" scope="col">Stanze</th>
                        <th class="d-none d-lg-none d-xl-table-cell" scope="col">Bagni</th>
                        <th class="d-none d-lg-none d-xl-table-cell" scope="col">Letti</th>
                        <th class="d-none d-lg-none d-xl-table-cell" scope="col">Metri quadri</th>
                        <th class="d-none d-lg-none d-xl-table-cell" scope="col">Indirizzo</th>
                        <th scope="col">Visibilità</th>
                        <th scope="col">Prezzo</th>
                        <th class="text-center" scope="col" colspan="4">Funzioni</th>
                    </tr>
                </thead>


                <tbody class="text-center">
                    @foreach ($apartments as $apartment)
                        <tr>
                            <th scope="row" class="prova ">
                                {{-- @dump($apartment->sponsorships) --}}
                                @if (count($apartment->sponsorships) > 0)
                                    @if ($apartment->sponsorships->sortByDesc('pivot.finish_date')->first()->pivot->finish_date > now())
                                        <div>
                                            <span class="stamp">Sponsor</span>
                                        </div>
                                    @endif
                                @endif
                                {{ $loop->iteration }}
                            </th>
                            <td class="text-start">{{ $apartment->title }}</td>
                            <td class="d-none d-xl-table-cell">{{ $apartment->rooms }}</td>
                            <td class="d-none d-md-none d-lg-none d-xl-table-cell">{{ $apartment->bathrooms }}</td>
                            <td class="d-none d-md-none d-lg-none d-xl-table-cell">{{ $apartment->beds }}</td>
                            <td class="d-none d-md-none d-lg-none d-xl-table-cell">{{ $apartment->square_meters }} &#13217
                            </td>
                            <td class="d-none d-md-none d-lg-none d-xl-table-cell">{{ $apartment->address }}</td>
                            @if ($apartment->visible == true)
                                <td class="text-center"><i class="fa-solid fa-eye"></i></td>
                            @elseif ($apartment->visible == false)
                                <td class="text-center"><i class="fa-solid fa-eye-slash"></i></td>
                            @endif
                            <td>{{ $apartment->price }}€</td>
                            <td class="text-center">
                                <a href="{{ route('user.apartment.show', $apartment->id) }}" role="button"
                                    class="btn btn-success" title="Info"><i class="fa-solid fa-circle-info"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('user.sponsorship.index', $apartment) }}" role="button"
                                    class="btn btn-sponsor" title="Edit"><i
                                        class="fa-solid fa-money-bill-trend-up"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('user.apartment.edit', $apartment) }}" role="button"
                                    class="btn btn-warning" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            {{-- <td class="text-center d-none d-md-table-cell">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $apartment->id }}" title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td> --}}
                        </tr>
                        {{-- Modale delete --}}

                        {{-- <div class="modal fade" id="delete{{ $apartment->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>Cancella appartmento n°{{ $apartment->id }}: {{ $apartment->title }} ?</div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('user.apartment.destroy', $apartment) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annulla</button>
                                            <button type="submit" class="btn btn-danger">Cancella</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
