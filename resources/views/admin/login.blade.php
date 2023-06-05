@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-md-6 col-sm-8">
                <x-card title="Вход">
                    <x-form method="POST" route='admin.login' class="p-2">
                        <x-input name="login" required>Логин</x-input>
                        <x-input name="password" type="password" required>Пароль</x-input>
                        <x-submit class="btn-success w-100">Войти</x-submit>
                    </x-form>
                </x-card>

            </div>
        </div>
    </div>
@endsection
