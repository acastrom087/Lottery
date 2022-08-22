<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #735A5A;">
            Draws
        </h2>
    </x-slot>

    <section class="py-6">
        <div>
            <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                <div class="mt-6 grid grid-cols-3 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @forelse ($draws as $draw)
                        <div class="flex justify-center border-2 rounded-sm px-4 py-2">
                            <div class="group relative">
                                <div
                                    class="w-full bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                    <img src="img/lot.jpg"
                                        alt="Front of men&#039;s Basic Tee in black."
                                        class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                                </div>
                                <div class="mt-4 flex justify-between" style="color: #735A5A;">
                                    <div>
                                        <h3 class="text-2xl">
                                            <a href="#">
                                                <span aria-hidden="true" class="absolute inset-0"></span>
                                                {{ $draw->name }}
                                            </a>
                                        </h3>
                                        <p class="mt-1 text-sm">Deadline: {{ $draw->deadline }}</p>
                                    </div>
                                </div>
                                <div class="flex justify-center py-2">
                                    <button type="button"
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xl text-white uppercase tracking-wides disabled:opacity-25 transition ease-in-out duration-150"
                                        style="background-color: #E09020;">
                                        <a href="draws/bid/{{ $draw->id }}">Bid</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-3 m-2">
                            <div>
                                <h4>Draws not found</h4>
                            </div>
                        </div>
                    @endforelse

                    <!-- More products... -->
                </div>
            </div>
        </div>

    </section>
</x-app-layout>
