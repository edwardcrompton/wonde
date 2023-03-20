<h1>{{$name}}</h1>

<table>
  <thead>
    <tr>
      <th>Time</th>
      <th>Students</th>
    </tr>
  </thead>
  <tbody>
    @foreach($lessons as $lesson)
    <tr>
      <td>{{ $lesson['start_at']->date }}</td>
      <td>@include('students', ['students' => $lesson['students']])</td>
    </tr>
    @endforeach
  </tbody>
</table>
