@extends('layouts.dashboard')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Forms</h1>
        <a href="{{ route('forms.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Form</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-4 border-b border-gray-200 text-left">ID</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-left">Full Name</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($forms as $form)
                    <tr class="hover:bg-gray-100">
                        <td class="py-3 px-4 border-b border-gray-200">{{ $form->id }}</td>
                        <td class="py-3 px-4 border-b border-gray-200">{{ $form->first_name }} {{ $form->last_name }}</td>
                        <td class="py-3 px-4 border-b border-gray-200">
                            <div class="flex space-x-2">
                                <a href="{{ route('forms.show', $form->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">View</a>
                                <a href="{{ route('forms.edit', $form->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Edit</a>
                                <form action="{{ route('forms.destroy', $form->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
