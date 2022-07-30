@extends('layouts.app')

@section('content')
<div class="vh-100 d-flex flex-column flex-md-row align-items-center justify-content-around">
    <div class="p-2 w-50 text-justify  d-none d-md-block">
        <p class="display-5 text-justify"><i class="fa-duotone fa-quote-left fa-2x"></i>
            We don't just offer a collection of words, but well-written
            content that represents your core values and conveys your
            message to the target audience.
        </p>
    </div>
    <div id="login">
        <router-view :errors="{{ $errors }}" old="{{ json_encode(old()) }}"></router-view>
    </div>
</div>
@endsection
