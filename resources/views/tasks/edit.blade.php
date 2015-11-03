@extends('template')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Edit Task</div>
	<div class="panel-body">
		<form method="post" action="{{ url('/tasks/'.$task->id.'/edit') }}">
		<!-- Laravel Token -->
		{{ csrf_field() }}
			<div class="form-group">
				<input type="text" value="{{ $task->task_name }}" name="task_name" class="form-control" placeholder="Task Name.">				
			</div>
			<div class="form-group">
				<label class="radio-inline">
				  <input type="radio" name="is_done" @if( $task->is_done ) checked @endif id="inlineRadio1" value="1"> Done
				</label>
				<label class="radio-inline">
				  <input type="radio" name="is_done" @if( ! $task->is_done) checked @endif value="0"> Not Yet
				</label>			
			</div>
			<button class="btn btn-primary btn-sm">Edit Task</button>
		</form>
	</div>
</div>	
@endsection