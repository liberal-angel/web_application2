<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .home{
        position: relative;
        background-color: #2d197c;
        height: 100vh;
        width: 100vw;
    }
    .list{
        display: inline-block;
        border: black solid 1px;
        border-radius: 10px;
        padding: 10px 20px;
        width: 450px;
        background-color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .til{
        display: flex;
        justify-content: center;
        font-size: small;
    }
    .input_list{
        display: flex;
        justify-content: center;
    }
    .logo{
        margin: auto;
        width: 20%;
    }
    .ml-3{
        margin-left: 50%;
    }
    .input_txt{
        width: 100%;
        height: 25px;
        border: solid 2px;
    }
</style>
<body>
    <div class="home">
        <x-guest-layout>
            <div class="list">
                <x-auth-card>
                        <x-slot name="logo">
                            <div class="logo">
                                <x-application-logo/>
                            </div>
                        </x-slot>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <div class="til">
                        <h1>ログインして下さい</h1>
                    </div>
                    <div class="input_list">
                        <table>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <tr>
                                    <th><p>メールアドレス</p></th>
                                    <td style="width: 200px;">
                                        <!-- Email Address -->
                                        <div>
                                            <x-label for="email"/>
                                            <x-input id="email" class="input_txt" type="email" name="email" :value="old('email')" required autofocus />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><p>パスワード</p></th>
                                    <td style="width: 200px;">
                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-label for="password"/>
                                            <x-input id="password" class="input_txt" type="password" name="password" required autocomplete="current-password"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <!-- Remember Me -->
                                        <div class="block mt-4">
                                            <label for="remember_me" class="inline-flex items-center">
                                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="font-size: 15px;">
                                        @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                                {{ __('パスワードを忘れた場合') }}
                                            </a>
                                        @endif
                                    </th>
                                    <td>
                                        <x-button class="ml-3">
                                            {{ __('ログイン') }}
                                        </x-button>
                                    </td>
                            </form>
                                    <td>
                                        <a href="register"><button>新規作成</button></a>
                                    </td>
                                </tr>
                        </table>
                    </div>
                </x-auth-card>
            </div>
        </x-guest-layout>
    </div>
</body>
</html>

