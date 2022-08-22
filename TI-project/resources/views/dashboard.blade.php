<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color: #735A5A;">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <section class="flex flex-nowrap justify-center py-12" style="color: #735A5A;">
        <div class="grid grid-cols-3 text-center">
            <div class="rounded-lg border-solid">
                <div class="mb-4">
                    <div class="flex justify-center my-3 card-body">
                        <img src="img/lottery.png" alt="" style="width: 75%">
                    </div>
                    <div class="py-2">
                        <button class="text-2xl px-3 py-2 rounded-lg text-white" type="button"
                            style="background-color: #E09020;"><a href="/draws">Draws</a></button>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border-solid">
                <div class="mb-4">
                    <div class="flex justify-center my-3 card-body">
                        <img src="img/admin.png" alt="" style="width: 50%">
                    </div>
                    <div class="py-2">
                        <button class="text-2xl px-3 py-2 rounded-lg text-white" type="button"
                            style="background-color: #E09020;"><a href="/manage-draws">Management</a></button>
                    </div>
                </div>
            </div>
            <div class="rounded-lg border-solid">
                <div class="mb-4">
                    <div class="flex justify-center my-3 card-body">
                        <img src="img/chest.png" alt="" style="width: 58%">
                    </div>
                    <div class="py-2">
                        <button class="text-2xl px-3 py-2 rounded-lg text-white" type="button"
                            style="background-color: #E09020;"><a href="/bids">Bids</a></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
