<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #735A5A;">
            Creating a new draw
        </h2>
    </x-slot>

    <section class="text-xl flex justify-center py-6" style="color: #735A5A;">
        <div class="m-4">
            <form method="POST" action="/manage-draws">
                @csrf
                <div class="py-4">
                    <label for="name" class="block text-md font-medium">Name</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="text" name="name" id="name"
                            class="py-2 px-4 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Enter a name"
                            required>
                    </div>
                </div>
                <div class="py-4">
                    <label for="balance" class="block text-md font-medium">Balance</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="number" name="balance" id="balance"
                            class="py-2 block w-full px-4 sm:text-sm border-gray-300 rounded-md"
                            placeholder="Enter a balance" required>
                    </div>
                </div>
                <div class="py-4">
                    <label for="start" class="block text-md font-medium">Start Date</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="date" name="start" id="start"
                            class="py-2 px-4 block w-full sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                </div>
                <div class="py-4">
                    <label for="deadline" class="block text-md font-medium ">Deadline</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="date" name="deadline" id="deadline"
                            class="py-2 px-4 block w-full sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                </div>
                <div class="py-4 flex justify-center text-white">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xl uppercase tracking-wides disabled:opacity-25 transition ease-in-out duration-150"
                        style="background-color: #E09020;">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
