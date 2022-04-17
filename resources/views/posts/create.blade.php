@extends('layouts.create-file')

@section('title','Create Post')

@section('content')
    <x-guest-layout>
        <x-create-post-card>

            <x-slot name="logo">

            </x-slot>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" action="{{route('posts.store')}}">
            @csrf

            <!-- caption -->
                <div>
                    <x-label for="caption" :value="__('Caption')"/>

                    <x-input id="caption" class="block mt-1 w-full" type="text" name="caption" :value="old('caption')"
                             required
                             autofocus/>
                </div>
                <!-- Image -->
                <div class="mt-4">
                    <x-label for="image_filepath" :value="__('Image')"/>

                    <x-input id="image_filepath" class="block mt-1 w-full" type="text" name="image_filepath"
                             :value="old('image_filepath')"
                             autofocus/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{route('posts.index')}}">
                        {{ __('Cancel?') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Submit') }}
                    </x-button>
                </div>
            </form>
        </x-create-post-card>
    </x-guest-layout>

@endsection
