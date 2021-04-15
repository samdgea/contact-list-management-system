<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​


        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="formName" class="block text-gray-700 text-sm font-bold mb-2">Customer Name:</label>
                            <input type="text" value="{{ $customer->full_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="formEmail" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                            <input type="text" value="{{ $customer->email_address }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="formPassword" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                            <input type="text" value="{{ $customer->phone_number }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="formStatus" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                            <select class="form-control w-full" wire:model="status">
                                <option value="">Choose status</option>
                                <option value="uncontacted">Uncontacted</option>
                                <option value="pending">Pending</option>
                                <option value="qualified">Qualified</option>
                                <option value="lost">Lost</option>
                            </select>
                            @error('status') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="formRemarks" class="block text-gray-700 text-sm font-bold mb-2">Remarks:</label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="formRemarks" wire:model="remarks"></textarea>
                            @error('remarks') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <table class="table-fixed w-full">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Old Status</th>
                            <th class="px-4 py-2">New Status</th>
                            <th class="px-4 py-2">Remarks</th>
                            <th class="px-4 py-2">Modified By</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($followups as $row)
                            <tr>
                                <td class="border px-4 py-2">{{ $row->old_status }}</td>
                                <td class="border px-4 py-2">{{ $row->new_status }}</td>
                                <td class="border px-4 py-2">{{ $row->remarks }}</td>
                                <td class="border px-4 py-2">{{ $row->modifiedby->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="border px-4 py-2 text-center" colspan="3">There's no data available</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Save
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                        <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Cancel
                        </button>
                    </span>
            </form>
        </div>
    </div>
</div>
</div>
