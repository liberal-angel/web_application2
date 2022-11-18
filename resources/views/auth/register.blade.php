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
    .logo{
        margin: auto;
        width: 20%;
    }
    .input_list{
        display: flex;
        justify-content: center;
        padding: 10px 20px;
    }
    .input_txt{
        width: 100%;
        height: 25px;
        border: solid 2px;
    }
    .til{
        display: flex;
        justify-content: center;
        font-size: small;
    }
    .ml-4{
        margin-left: 50%;
    }
</style>
<div class="home">
    <x-guest-layout>
        <div class="list">
            <x-auth-card>
                    <x-slot name="logo">
                        <div class="logo">
                            <x-application-logo/>
                        </div>
                    </x-slot>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="til">
                        <h1>新規作成して下さい</h1>
                    </div>
                    <div class="input_list">
                        <table>
                            <tr> <!-- Name -->
                                <th>
                                    <p>名前</p>
                                </th>
                                <td>
                                    <x-input id="name" class="input_txt" type="text" name="name" :value="old('name')" required autofocus />
                                </td>
                            </tr>
                            <tr> <!-- Email Address -->
                                <th>
                                    <p>メールアドレス</p>
                                </th>
                                <td>
                                    <x-input id="email" class="input_txt" type="email" name="email" :value="old('email')" required />
                                </td>
                            </tr>
                            <tr> <!-- Password -->
                                <th>
                                    <p>パスワード</p>
                                </th>
                                <td>
                                    <x-input id="password" class="input_txt" type="password" name="password" required autocomplete="new-password" />
                                </td>
                            </tr>
                            <tr> <!-- Confirm Password -->
                                <th>
                                    <p>（再）パスワード</p>
                                </th>
                                <td>
                                    <x-input id="password_confirmation" class="input_txt" type="password" name="password_confirmation" required />
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                        {{ __('すでに登録済の方') }}
                                    </a>
                                </th>
                                <td>
                                    <x-button class="ml-4">
                                        {{ __('新規作成') }}
                                    </x-button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </x-auth-card>
        </div>
    </x-guest-layout>
</div>
