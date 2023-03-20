<h1>Students in my class</h1>

<form method="POST" action="{{url('employee')}}">
  @csrf

  <p>Please enter your employee ID to search for your classes.</p>

  <label for="id">Employee ID</label>
  <input name="id" type="text">

  <input type="submit">
</form>
