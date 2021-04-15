<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Customer Management
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

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Add new Customer</button>

            @if($viewModal)
                @include('livewire.customer.create')
            @endif


            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Full Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Phone Number</th>
                    <th class="px-4 py-2" style="width:300px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $row)
                    <tr>
                        <td class="border px-4 py-2">{{ $row->full_name }}</td>
                        <td class="border px-4 py-2">{{ $row->email_address }}</td>
                        <td class="border px-4 py-2">{{ $row->phone_number }}</td>
                        <td class="border px-4 py-2">
                            <div class="grid grid-cols-2 gap-2 place-content-center">
                                <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
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
