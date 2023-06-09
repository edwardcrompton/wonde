@extends('app')

@section('title', 'Wonde API Integration')

@section('content')

<div class="mt-8">
  @if (session('error'))
    <div class="text-white bg-red-500 p-4 w-full max-w-sm m-auto mb-4">{{ session('error') }}</div>
  @endif

  <form method="POST" action="{{url('employee')}}" class="w-full max-w-sm m-auto">
    @csrf
    <div class="md:flex md:items-center mb-6">
      <div class="md:w-1/3">
        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="employeeid">
          Employee ID
        </label>
      </div>
      <div class="md:w-2/3">
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="employeeid" name="employeeid" type="text" value="A500460806">
      </div>
    </div>
    <div class="md:flex md:items-center">
      <div class="md:w-1/3"></div>
      <div class="md:w-2/3">
        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
          View my classes
        </button>
      </div>
    </div>
  </form>
</div>

@endsection
