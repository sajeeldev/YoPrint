<div class="bg-white rounded-xl shadow-md p-8 mb-8">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Uploaded Files</h2>
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Time
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">File
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                           
                            @foreach ($files as $file)
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                <div>
                                                    {{ Carbon\Carbon::parse($file->created_at)->format('h:i :- d-m-Y') }}
                                                    {{-- {{ $file->file_name }} --}}
                                                </div>
                                                <span>{{ $timeAgo }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                <div>{{ $file->file_name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <div>
                                                    @if ($file->status === 'uploaded')
                                                        <span
                                                            class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Uploaded</span>
                                                    @else
                                                        <span
                                                            class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">{{ $file->status}}</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
