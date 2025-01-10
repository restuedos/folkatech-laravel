<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employees') }}
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
                        <a href="{{ route('employees.create') }}" class="px-4 py-2 bg-green-500 text-white rounded">Add Employee</a>
                    </div>

                    @if($employees->count())
                    <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">First Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Last Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Company</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Phone</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($employees as $employee)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $employee->firstname }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $employee->lastname }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $employee->company->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $employee->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $employee->phone }}</td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <a href="{{ route('employees.edit', $employee) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-300">Edit</a>
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline-block ml-2">
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
                        {{ $employees->links() }}
                    </div>
                    @else
                    <p class="text-gray-500 dark:text-gray-300">No employees found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>