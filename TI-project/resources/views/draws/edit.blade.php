<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Editing {{$lottery->name}}
      </h2>
    </x-slot>
  
    <section class="flex justify-center py-6">
      <div class="m-4">
        <form method="POST" action="/manage-draws/{{$lottery->id}}">
          @csrf
          @method('PUT')
          <div class="py-4">
            <label for="name" class="block text-md font-medium text-gray-700">Name</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <input type="text" name="name" id="name" class="block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Enter a name" value= "{{$lottery->name}}" autofocus>
            </div>
          </div>
          <div class="py-4">
            <label for="balance" class="block text-md font-medium text-gray-700">Balance</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <input type="number" name="balance" id="balance" class="block w-full pl-6 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Enter a balance" value= "{{$lottery->balance}}">
            </div>
          </div>
          <div class="py-4">
            <label for="name" class="block text-md font-medium text-gray-700">Start Date</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <input type="datetime-local" name="start" id="start" class="block w-full pl-6 pr-12 sm:text-sm border-gray-300 rounded-md" value="{{ $start }}">
            </div>
          </div>
          <div class="py-4">
            <label for="name" class="block text-md font-medium text-gray-700">Deadline</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <input type="datetime-local" name="deadline" id="deadline" class="block w-full pl-6 pr-12 sm:text-sm border-gray-300 rounded-md" value="{{ $deadline }}">
            </div>
          </div>
          <div class="py-4">
            <label for="is_active" class="block text-md font-medium text-gray-700">Active</label>
            <div class="mt-1 relative rounded-md shadow-sm">
              <input type="checkbox" name="is_active" id="is_active" class="block px-4 sm:text-sm border-gray-300 rounded-md" {{$lottery->is_active == 'Yes' ? 'checked' : ''}}>
            </div>
          </div>
          <div class="flex justify-center text-white">
            <button type="submit" class="bg-gray-500 hover:bg-gray-700 rounded-md px-6 py-3">
              <span>
                Edit
              </span>
          </button>
          </div>
        </form>
      </div>
    </section>
  </x-app-layout>  