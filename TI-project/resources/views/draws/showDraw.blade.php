<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Draws
      </h2>
    </x-slot>
  
    <section class="flex justify-center py-6">
        <div class="grid grid-flow-col grid-cols-3 gap-4 text-center">
            @forelse ($draws as $draw)
                    <div class="rounded-lg border-solid">
                        <div class="mb-4"> 
                            <div class="bg-gray-200 py-3 text-lg font-extrabold">
                                <h4>{{$draw->name}}</h4>
                            </div>
                            <div class="my-3 card-body">
                                <h1 class="text-3xl font-semibold py-4">{{$draw->name}}</h1>
                                <div class="m-2 font-medium">
                                    <p>Closing date:</p>
                                    <p class="date">{{ $draw->deadline }}</p>
                                </div>
                                <div class="py-4">
                                    <button class="px-3 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" type="button"><a href="draws/bid/{{ $draw->id }}">Bid</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-3 m-2 align-middle">
                        <h4>Draws not found</h4>
                    </div>
                @endforelse
        </div>
    </section>
  </x-app-layout> 