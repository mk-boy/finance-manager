@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile_info">
        <p>
            <b>ID: </b>{{ $user_info->id }}
        </p>

        <p>
            <b>Почта: </b>{{ $user_info->email }}
        </p>

        <p>
            <b>Имя: </b>{{ $user_info->name }}
        </p>

        <p>
            <b>Дата создания: </b>{{ $user_info->id }}
        </p>
    </div>
    <div class="profile_actions">
        <a href="{{ route('profile.edit') }}">Редактирование профиля</a>
    </div>
</div>
@endsection