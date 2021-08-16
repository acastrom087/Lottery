<x-app-layout>
  
    <section class="flex justify-center py-12">
      <div class="text-center">
        @if ($prizes == null)
            <div class="uppercase">
                <p>No winners found</p>
            </div>
        @else
            <div class="py-6">
                <h2 class="uppercase">Email sent successfully</h2>
                <hr>
                @foreach ($prizes as $prize)
                    <p class="lowercase py-4">{{ $prize->email }}</p>
                @endforeach
            </div>
        @endif
      </div>
    </section>
  </x-app-layout>