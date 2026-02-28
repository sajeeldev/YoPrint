<div class="bg-white rounded-xl shadow-md p-8 mb-8" id="file-status-section">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Uploaded Files</h2>
        <div id="polling-indicator" class="hidden flex items-center gap-2 text-sm text-blue-600">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
            </span>
            <span>Live updating...</span>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200" id="file-status-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Time
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    File Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Progress
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200" id="file-status-tbody">
                            {{-- Initial server-rendered rows --}}
                            @foreach ($files as $file)
                                <tr class="hover:bg-gray-50 transition-colors duration-150" data-file-id="{{ $file->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                        <div>{{ Carbon\Carbon::parse($file->created_at)->format('h:i :- d-m-Y') }}</div>
                                        <span class="text-xs text-gray-500">{{ $timeAgo }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-file-csv text-green-500"></i>
                                            <span>{{ $file->file_name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        @if ($file->status === 'processing')
                                            <div class="w-full">
                                                <div class="flex items-center justify-between mb-1">
                                                    <span class="text-xs font-medium text-blue-700">
                                                        {{ $file->processed_count ?? 0 }} / {{ $file->row_count ?? '?' }}
                                                    </span>
                                                    <span class="text-xs font-medium text-blue-700">
                                                        @if ($file->row_count > 0)
                                                            {{ round((($file->processed_count + $file->failed_count) / $file->row_count) * 100, 1) }}%
                                                        @else
                                                            Counting...
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2.5 rounded-full transition-all duration-500 ease-out"
                                                        style="width: {{ $file->row_count > 0 ? round((($file->processed_count + $file->failed_count) / $file->row_count) * 100, 1) : 0 }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($file->status === 'completed')
                                            <span class="text-xs text-green-600 font-medium">
                                                {{ $file->processed_count }} rows processed
                                                @if ($file->failed_count > 0)
                                                    <span class="text-red-500">({{ $file->failed_count }} failed)</span>
                                                @endif
                                            </span>
                                        @else
                                            <span class="text-xs text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        @if ($file->status === 'uploaded')
                                            <span class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">
                                                <i class="fas fa-clock mr-1.5"></i>Queued
                                            </span>
                                        @elseif ($file->status === 'processing')
                                            <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium animate-pulse">
                                                <i class="fas fa-spinner fa-spin mr-1.5"></i>Processing
                                            </span>
                                        @elseif ($file->status === 'completed')
                                            <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                                                <i class="fas fa-check-circle mr-1.5"></i>Completed
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                                {{ $file->status }}
                                            </span>
                                        @endif
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

<script>
    (function () {
        const POLL_INTERVAL = 2000; // Poll every 2 seconds
        const API_URL = "{{ route('api.file-statuses') }}";
        let pollingTimer = null;
        let isPolling = false;

        function getStatusBadge(status) {
            const badges = {
                'uploaded': `<span class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">
                                <i class="fas fa-clock mr-1.5"></i>Queued
                             </span>`,
                'processing': `<span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium animate-pulse">
                                  <i class="fas fa-spinner fa-spin mr-1.5"></i>Processing
                               </span>`,
                'completed': `<span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                                 <i class="fas fa-check-circle mr-1.5"></i>Completed
                              </span>`,
            };
            return badges[status] || `<span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">${status}</span>`;
        }

        function getProgressCell(file) {
            if (file.status === 'processing') {
                const countLabel = file.row_count > 0
                    ? `${file.processed_count} / ${file.row_count}`
                    : `${file.processed_count} processed`;
                const percentLabel = file.row_count > 0
                    ? `${file.progress}%`
                    : 'Counting...';
                const barWidth = file.progress || 0;

                return `
                    <div class="w-full">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs font-medium text-blue-700">${countLabel}</span>
                            <span class="text-xs font-medium text-blue-700">${percentLabel}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2.5 rounded-full transition-all duration-500 ease-out"
                                 style="width: ${barWidth}%"></div>
                        </div>
                    </div>`;
            } else if (file.status === 'completed') {
                let text = `${file.processed_count} rows processed`;
                if (file.failed_count > 0) {
                    text += ` <span class="text-red-500">(${file.failed_count} failed)</span>`;
                }
                return `<span class="text-xs text-green-600 font-medium">${text}</span>`;
            }
            return `<span class="text-xs text-gray-400">—</span>`;
        }

        function buildRow(file) {
            return `
                <tr class="hover:bg-gray-50 transition-colors duration-150" data-file-id="${file.id}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                        <div>${file.created_at}</div>
                        <span class="text-xs text-gray-500">${file.time_ago}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-file-csv text-green-500"></i>
                            <span>${file.file_name}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        ${getProgressCell(file)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                        ${getStatusBadge(file.status)}
                    </td>
                </tr>`;
        }

        function updateTable(files) {
            const tbody = document.getElementById('file-status-tbody');
            if (!tbody) return;

            tbody.innerHTML = files.map(file => buildRow(file)).join('');

            // Check if any file is still processing or queued
            const hasActiveFiles = files.some(f => f.status === 'processing' || f.status === 'uploaded');
            const indicator = document.getElementById('polling-indicator');

            if (hasActiveFiles) {
                indicator?.classList.remove('hidden');
                indicator?.classList.add('flex');
                startPolling();
            } else {
                indicator?.classList.add('hidden');
                indicator?.classList.remove('flex');
                stopPolling();
            }
        }

        async function fetchStatuses() {
            try {
                const response = await fetch(API_URL, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                });

                if (!response.ok) return;

                const data = await response.json();
                updateTable(data.files);
            } catch (error) {
                console.error('Polling error:', error);
            }
        }

        function startPolling() {
            if (isPolling) return;
            isPolling = true;
            pollingTimer = setInterval(fetchStatuses, POLL_INTERVAL);
        }

        function stopPolling() {
            if (!isPolling) return;
            isPolling = false;
            clearInterval(pollingTimer);
            pollingTimer = null;
        }

        // Auto-start polling if there are processing/uploaded files on page load
        document.addEventListener('DOMContentLoaded', function () {
            const rows = document.querySelectorAll('#file-status-tbody tr');
            let hasActive = false;
            rows.forEach(row => {
                const statusCell = row.querySelector('td:last-child');
                if (statusCell && (statusCell.textContent.includes('Processing') || statusCell.textContent.includes('Queued'))) {
                    hasActive = true;
                }
            });

            if (hasActive) {
                const indicator = document.getElementById('polling-indicator');
                indicator?.classList.remove('hidden');
                indicator?.classList.add('flex');
                startPolling();
            }
        });
    })();
</script>
