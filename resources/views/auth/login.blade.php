@extends('layouts.app')

@section('content')
    <div class="h-full relative">
        <div class="text-2xl text-neutral-600 p-2 fixed w-full">
            <span class="font-bold">
                Sheems
            </span>
        </div>
        <div class="h-full flex justify-center items-center">
            <div class="p-1 rounded-lg drop-shadow-lg drop-shadow-xl bg-white">
                <img
                    style="height: 250px"
                    class="mx-auto"
                    src="{{ asset('./assets/welcome.svg') }}"
                />
                <div class="p-1">
                    <div class="p-1">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <input hidden value="mikekkamara@gmail.com" type="email" name="email" />
                            <h6 class="text-sm text-center tracking-wide">
                                Enter your password to continue
                            </h6>
                            <input
                                class="p-2 ring-1 ring-gray-200 bg-transparent outline-0 m-1 rounded-sm mt-2"
                                type="password"
                                name="password"
                                maxlength="8"
                                placeholder="********"
                                autofocus
                            />
                            <div class="p-2">
                                <button type="submit" class="bg-indigo-700 hover:bg-indigo-500 text-white rounded p-1">
                                    Login
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
