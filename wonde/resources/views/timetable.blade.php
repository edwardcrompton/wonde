@extends('app')

@section('title', 'Wonde API Integration')

@section('content')

<div class="flex flex-col m-auto max-w-sm">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <h1 class="text-gray-500 font-bold mt-6 mb-6">{{$name}}: Your students</h1>
        <table class=" text-left text-sm font-light table-auto">
          <thead class="border-b font-medium dark:border-neutral-500 bg-purple-500 text-white">
            <tr>
              <th scope="col" class="px-6 py-4 font-bold">Time of class</th>
              <th scope="col" class="px-6 py-4 font-bold">Students</th>
            </tr>
          </thead>
          <tbody>
            @foreach($lessons as $lesson)
            <tr class="border-b dark:border-neutral-500">
              <td class="whitespace-nowrap px-6 py-4 text-gray-500 font-medium align-text-top">{{ $lesson['start_at'] }}</td>
              <td class="whitespace-nowrap px-6 py-4  align-text-top">@include('students', ['students' => $lesson['students']])</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
