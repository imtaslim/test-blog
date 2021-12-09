<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category List') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-green-600">Create Category</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="container mx-auto p-6 font-mono">
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                        <th class="px-4 py-3">ID</th>
                                        <th class="px-4 py-3">Category Name</th>
                                        <th class="px-4 py-3">Action</th>
                                    </tr>
                                    </thead>
                                    @forelse($categories as $category)
                                    <tbody class="bg-white">
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 border">{{ $category->id }}</td>
                                        <td class="px-4 py-3 font-semibold border text-ms">{{ $category->name }}</td>
                                        <td class="px-4 py-3 text-xs border">
                                            <a class="px-2 py-1 bg-yellow-500" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                            <a class="px-2 py-1 bg-red-500 delete-row" data-confirm="Are you sure to delete this?" href="{{ route('categories.destroy', $category->id) }}">Delete</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-3 text-center">{{ __('No Catgories Found') }}</td>
                                    </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
