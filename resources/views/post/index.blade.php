<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post List') }}
            </h2>
            <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-green-600">Create Post</a>
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
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">category Name</th>
                                    <th class="px-4 py-3">Image</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Action</th>
                                </tr>
                                </thead>
                                @forelse($posts as $post)
                                <tbody class="bg-white">
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3 border">{{ $post->id }}</td>
                                    <td class="px-4 py-3 font-semibold border text-ms">{{ $post->name }}</td>
                                    <td class="px-4 py-3 font-semibold border text-ms">{{ $post->categories->pluck("name")->join(", ") }}</td>
                                    <td class="px-4 py-3 text-xs border">
                                        <img src="{{ asset($post->image) }}" alt="image" width="100px">
                                    </td>
                                    <td class="px-4 py-3 text-xs border">{{ $post->is_complete ? 'complete' : 'incomplete' }}</td>
                                    <td class="px-4 py-3 text-xs border">
                                        <a class="px-2 py-1 bg-yellow-500" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                        @if (!$post->is_complete)
                                            <a class="px-2 py-1 bg-green-500 complete-todo" data-confirm="Are you sure to complete this?" href="{{ route('post.complete', $post->id) }}">Complete</a>
                                        @endif
                                        <a class="px-2 py-1 bg-red-500 delete-row" data-confirm="Are you sure to delete this?" href="{{ route('posts.destroy', $post->id) }}">Delete</a>
                                    </td>
                                </tr>
                                </tbody>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center">{{ __('No Posts Found') }}</td>
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
