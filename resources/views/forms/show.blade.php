@extends('layouts.dashboard')


@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6">Form Details</h1>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">First Name:</label>
        <p class="text-gray-900">{{ $form->first_name }}</p>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Last Name:</label>
        <p class="text-gray-900">{{ $form->last_name }}</p>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Email:</label>
        <p class="text-gray-900">{{ $form->email }}</p>
    </div>
    <a href="{{ route('forms.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Back to List</a>
</div>
@endsection

