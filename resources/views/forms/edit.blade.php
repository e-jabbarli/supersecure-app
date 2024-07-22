@extends('layouts.dashboard')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6">Edit Form</h1>
    <form action="{{ route('forms.update', $form->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="first_name" class="block text-gray-700">First Name</label>
            <input type="text" name="first_name" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $form->first_name }}" required>
        </div>
        <div class="mb-4">
            <label for="last_name" class="block text-gray-700">Last Name</label>
            <input type="text" name="last_name" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $form->last_name }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $form->email }}" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update</button>
    </form>
</div>
@endsection
