@extends('layouts.main-another')
@section('content')
<div class="wrap">
    @include('profile.partials.update-profile-information-form')

    @include('profile.partials.update-password-form')

    @include('profile.partials.delete-user-form')

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
            {{ __('ログアウト') }}
        </x-dropdown-link>
    </form>
</div>
@endsection