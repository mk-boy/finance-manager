@extends('layouts.app')

@section('content')
    <form action="{{ route('profile.edit') }}" method="POST">
        @csrf
        <input name="name" type="text" value="{{ $user_info->name }}">
        <input name="email" type="text" value="{{ $user_info->email }}">
        <input type="submit" value="Сохранить">
    </form>
@endsection