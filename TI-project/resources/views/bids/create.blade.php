<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #735A5A;">
            {{ $lottery->name }} Bids
        </h2>
    </x-slot>
    <div class="m-4 py-4 text-center text-xl uppercase tracking-wider" style="color: #735A5A;">
        <h1>Make a new Bid</h1>
    </div>
    <section class="flex justify-center py-6" style="color: #735A5A;">
        <div class="m-4">
            <form method="POST" action="/draws/bid/{{ $lottery->id }}">
                @csrf
                <div class="py-4">
                    <input type="hidden" name="lottery_id" value="{{ $lottery->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <label for="bid" class="block text-md font-medium ">Bid</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="number" name="bid" id="bid" min="1"
                            class="py-2 px-4 block w-full sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                </div>
                <div class="py-4">
                    <label for="balance" class="block text-md font-medium ">Number</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="number" name="number" min="0" max="99"
                            class="py-2 px-4 block w-full sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                </div>
                <div class="flex justify-center text-white py-2">
                    @if ($result)
                        <span class="bg-gray-500 rounded-md px-6 py-3">
                            Expired
                        </span>
                    @else
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xl text-white uppercase tracking-wides disabled:opacity-25 transition ease-in-out duration-150"
                            style="background-color: #E09020;">
                            Save
                        </button>
                    @endif
                </div>
            </form>
            <div class="m-4 py-4 text-center text-xl">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
