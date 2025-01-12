<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex justify-between">
                        <form method="GET" class="flex">
                            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded">Search</button>
                        </form>
                        <a href="{{ route('companies.create') }}" class="px-4 py-2 bg-green-500 text-white rounded">Add Company</a>
                    </div>

                    @if($companies->count())
                    <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Logo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Website</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($companies as $company)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    <img src={{ $company->logo }}/>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $company->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $company->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $company->website }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    <a href="{{ route('companies.edit', $company) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-300">Edit</a>
                                    <form action="{{ route('companies.destroy', $company) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-300" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $companies->links() }}
                    </div>
                    @else
                    <p class="text-gray-500 dark:text-gray-300">No companies found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>