<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{$lottery->name}} Bids
      </h2>
    </x-slot>
    <div class="m-4 py-4 text-center text-xl uppercase tracking-wider">
      <h1>Make a new Bid</h1>
    </div>
    <section class="flex justify-center py-6">
      <div class="m-4">
        <form method="POST" action="/draws/bid/{{$lottery->id}}">
          @csrf
          <div class="py-4">
            <input type="hidden" name="lottery_id" value="{{$lottery->id}}">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <label for="bid" class="block text-md font-medium text-gray-700">Bid</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <input type="number" name="bid" id="bid" min="1" class="block w-full sm:text-sm border-gray-300 rounded-md" required>
            </div>
          </div>
          <div class="py-4">
            <label for="balance" class="block text-md font-medium text-gray-700">Number</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <input type="number" name="number" min="0" max="99" class="block w-full pl-6 pr-12 sm:text-sm border-gray-300 rounded-md" required>
            </div>
          </div>
          <div class="flex justify-center text-white">
              @if ($result)
                <span class="bg-gray-500 rounded-md px-6 py-3">
                  Expired
                </span>
              @else
                <button type="submit" class="bg-gray-500 hover:bg-gray-700 rounded-md px-6 py-3">
                  <span>
                    Save
                  </span>
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