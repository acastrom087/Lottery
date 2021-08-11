<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        My bids
      </h2>
    </x-slot>
  
    <section class="flex justify-center py-6">
        <div class="px-6">
            <h2 class="text-center py-2"><strong>My list of bids</strong></h2>
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Draw
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Number
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bid
                                </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($bids as $bid)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $bid->lottery->name }}
                                        </div>
                                        </div>
                                    </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $bid->number }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">
                                        ${{ $bid->bid }}
                                    </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium" colspan="3">No bids found 😥</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
              {{ $bids->links() }}
        </div>
        @if ($prizes!=null)
        <div class="px-6">
          <h2 class="text-center py-2"><strong>Winner</strong></h2>
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                      <table class="min-w-full divide-y divide-gray-200">
                          <thead class="bg-gray-50">
                              <tr>
                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Draw
                                  </th>
                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Number
                                  </th>
                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Bid
                                  </th>
                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Profit
                                  </th>
                              </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-gray-200">
                              @forelse ($prizes as $prize)
                              <tr>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                  <div class="flex items-center">
                                      <div class="ml-4">
                                      <div class="text-sm font-medium text-gray-900">
                                          {{ $prize->ltname }}
                                      </div>
                                      </div>
                                  </div>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      <div class="text-sm text-gray-900">{{ $prize->number }}</div>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      <span class="text-sm font-medium text-gray-900">
                                      ${{ $prize->bid }}
                                      </span>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      <span class="text-sm font-medium text-gray-900">
                                      ${{ $prize->profit }}
                                      </span>
                                  </td>
                              </tr>
                              @empty
                              <tr>
                                  <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium" colspan="4">No winners found</td>
                              </tr>
                              @endforelse
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
      </div>
        @endif
    </section>
  </x-app-layout> 