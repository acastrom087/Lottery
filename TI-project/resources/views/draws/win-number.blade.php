<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Winning Numbers
      </h2>
    </x-slot>
  
    <section class="flex justify-center py-6">
      <div class="flex px-4 py-4">
        <img src="{{url('/images/and-the-winner-is.jpg')}}" alt="Image">
      </div>
      <div class="grid grid-flow-col grid-cols-3 gap-4 text-center">
        <form action="/manage-draws/{{ $lottery->id }}/numbers" method="POST">
          @csrf
          <div class="rounded-lg border-solid">
            <div class="mb-4"> 
                <div class="bg-gray-200 py-3 text-lg font-extrabold">
                    <h4>Prize #1</h4>
                </div>
                <div class="my-3 card-body">
                  <p>Pays 60-1</p>
                  <h1 class="text-3xl font-semibold py-4">Number</h1>
                  <div class="m-2 font-medium">
                    <input type="number" name="st_number" id="st_number" required readonly>
                  </div>
                  <div class="py-4">
                      <button class="px-3 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" id="pz1" type="button">Generate</button>
                  </div>
                </div>
            </div>
          </div>
          <div class="rounded-lg border-solid">
            <div class="mb-4"> 
              <div class="bg-gray-200 py-3 text-lg font-extrabold">
                  <h4>Prize #2</h4>
              </div>
              <div class="my-3 card-body">
                <p>Pays 10-1</p>
                <h1 class="text-3xl font-semibold py-4">Number</h1>
                <div class="m-2 font-medium">
                  <input type="number" name="nd_number" id="nd_number" required readonly>
                </div>
                <div class="py-4">
                    <button class="px-3 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" id="pz2" type="button">Generate</button>
                </div>
              </div>
            </div>
          </div>
          <div class="rounded-lg border-solid">
            <div class="mb-4"> 
              <div class="bg-gray-200 py-3 text-lg font-extrabold">
                <h4>Prize #3</h4>
              </div>
              <div class="my-3 card-body">
                <p>Pays 5-1</p>
                <h1 class="text-3xl font-semibold py-4">Number</h1>
                <div class="m-2 font-medium">
                  <input type="number" name="rd_number" id="rd_number" required readonly>
                </div>
                <div class="py-4">
                  <button class="px-3 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" id="pz3" type="button">Generate</button>
                </div>
              </div>
            </div>
          </div>
          <div class="py-4">
            <input type="hidden" name="lottery_id" value="{{ $lottery->id }}">
            <button class="px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" type="submit">Save</button>
          </div>
        </form>
        <div class="m-4 py-4 text-center text-xl">
          @if (\Session::has('success'))
            <div class="alert alert-success">
              <ul>
                <li>{!! \Session::get('success') !!}</li>
                <a class="underline" href="/send-email">Report to the winners</a>
              </ul>
            </div>
          @endif
        </div>
      </div>
      <div class="flex px-4 py-4">
        <img src="{{url('/images/and-the-winner-is.jpg')}}" alt="Image">
      </div>
    </section>
  </x-app-layout>