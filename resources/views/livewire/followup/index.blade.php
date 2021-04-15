<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Followup Customer
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($viewModal)
                @include('livewire.followup.view')
            @endif


            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Full Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Phone Number</th>
                    <th class="px-4 py-2" style="width:150px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $row)
                    <tr>
                        <td class="border px-4 py-2">{{ $row->full_name }}</td>
                        <td class="border px-4 py-2">{{ $row->email_address }}</td>
                        <td class="border px-4 py-2">{{ $row->phone_number }}</td>
                        <td class="border px-4 py-2">
                            <div class="grid place-content-center">
                                <button wire:click="view({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="border px-4 py-2 text-center" colspan="4">There's no data available</td>
                    </tr>
                @endforelse
                </tbody>

                {{ $customers->links() }}

            </table>
        </div>
    </div>
</div>
