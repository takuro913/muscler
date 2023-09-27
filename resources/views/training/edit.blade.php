

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
      {{ __('編集') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('training.update',$training->id) }}" method="POST">
            @method('put')
            @csrf
            <div class="flex flex-col mb-4">
              <x-input-label for="training" :value="__('トレーニングメニュー')" />
              <x-text-input id="training" class="block mt-1 w-full" type="text" name="training" value="{{$training->training}}" required autofocus />
              <x-input-error :messages="$errors->get('training')" class="mt-2" />
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="comment" :value="__('マッスルメモ')" />
              <x-text-input id="comment" class="block mt-1 w-full" type="text" name="comment" value="{{$training->comment}}" autofocus />
              <x-input-error :messages="$errors->get('comment')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
              <a href="{{ url()->previous() }}">
                <x-secondary-button class="ml-3">
                  {{ __('戻る') }}
                </x-primary-button>
              </a>
              <x-primary-button class="ml-3">
                {{ __('更新') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

