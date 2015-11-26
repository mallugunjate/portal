Does this person work at your store?
<br>
{{$firstname}} {{$lastname}} 
<br>
Click here to approve this person: {{ url('/approve/'.$approval_code) }}
<br>

<a href={{url('disapprove/'.$approval_code)}}>I don't know this person</a>