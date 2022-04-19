@extends('layouts.create-file')

@section('title','Create Post')

@section('content')


    <x-guest-layout>

        <x-create-post-card>

            <x-slot name="logo">

            </x-slot>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" action="{{route('posts.update', ['post'=>$post])}}">
            @csrf
            @method('PUT')

            <!-- caption -->
                <div>
                    <x-label for="caption" :value="__('Caption')"/>

                    <x-input id="caption" class="block mt-1 w-full" type="text" name="caption" :value="$post->caption"
                             required
                             autofocus/>
                </div>
                <!-- Image -->
                <div class="mt-4">
                    <div>
                        <x-label for="image" :value="__('Add photo')"/>

                        <x-input id="image" class="block mt-1 w-full" type="file" required name="image" required autofocus/>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                       href="{{route('posts.show',['post'=>$post])}}">
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
