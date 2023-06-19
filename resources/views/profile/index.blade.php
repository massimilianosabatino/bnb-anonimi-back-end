@extends('layouts.app')
@section('content')

<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Profile') }}
    </h2>
    <div class="card p-4 mb-4 bg-white shadow rounded-lg">
        <header>
            <h2 class="text-secondary">
                {{ __('Profile Information') }}
            </h2>
    
            <p class="mt-1 text-muted">
                {{ __("View your account's profile information and email address.") }}
            </p>
        </header>
        <div class="mb-2">
            <label for="name">{{__('Name')}}</label>
            <input class="form-control" type="text" name="name" id="name" autocomplete="name" value="{{old('name', $user->name)}}" disabled >
        </div>

        <div class="mb-2">
            <label for="email">
                {{__('Email') }}
            </label>

            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email)}}" disabled />

        </div>

    </div>

    <div class="card p-4 mb-4 bg-white shadow rounded-lg">


        @include('profile.partials.delete-user-form')

    </div>
</div>

@endsection
