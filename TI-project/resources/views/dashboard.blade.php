<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <section class="flex flex-nowrap justify-center py-12">
        <div class="grid grid-cols-3 gap-4 text-center">
            <div class="rounded-lg border-solid">
                <div class="mb-4"> 
                    <div class="my-3 card-body">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                          </svg>
                        <div class="py-4">
                            <button class="px-3 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" type="button"><a href="/draws">Draws</a></button>
                        </div>
                    </div>
                </div>
            </div>
            @can('CreateDraws')
            <div class="rounded-lg border-solid">
                <div class="mb-4"> 
                    <div class="my-3 card-body">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                          </svg>
                        <div class="py-4">
                            <button class="px-3 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" type="button"><a href="/manage-draws">Management</a></button>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            <div class="rounded-lg border-solid">
                <div class="mb-4"> 
                    <div class="my-3 card-body">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                          </svg>
                        <div class="py-4">
                            <button class="px-3 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" type="button"><a href="/bids">My Bids</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
