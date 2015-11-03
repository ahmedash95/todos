@extends('template')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Create Task</div>
	<div class="panel-body">
		<form method="post" action="{{ url('/tasks/create') }}">
		<!-- Laravel Token -->
		{{ csrf_field() }}
			<div class="form-group">
				<input type="text" name="task_name" class="form-control" placeholder="Task Name.">				
			</div>
			<button class="btn btn-primary btn-sm">Create Task</button>
		</form>
	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading">Tasks List ( <span id="tasks_count">{{ $tasks->count() }}</span>  )</div>
	<div class="panel-body">
		<table class="table table-striped">
			@foreach($tasks as $task)
				<tr>
					<td>{{ $task->task_name }}</td>
					<td>
						@if($task->is_done == 0)
						<a href="{{ url('/tasks/'.$task->id.'/done') }}" class="ma btn btn-success btn-xs">Mark As Done</a>
						@else
						<a href="{{ url('/tasks/'.$task->id.'/undone') }}" class="ma btn btn-warning btn-xs">Unmark as Done</a>
						@endif
					</td>
					<td>
						<a href="{{ url('/tasks/'.$task->id.'/edit') }}" class="btn btn-primary btn-xs">Edit</a>
						<form action="{{ url('/tasks/'.$task->id.'/delete') }}" class="remove_task" method="post">
							{{ csrf_field() }}
							<button class="btn btn-danger btn-xs">Remove</button>
						</form>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>	
<script>
	
	$('.remove_task').submit(function(){
		var el = $(this);
		var URL = el.attr('action');
		var FormData = el.serialize();
		$.ajax({
			url : URL,
			type : 'post',
			data : FormData,
			dataType : 'json',
			success : function(response){
				if(response.success == 1){
					el.parent().parent().remove();
					$('#tasks_count').text(response.tasks_count);
					alert(response.message);
				} else {
					alert('Can\'t Delete Task');
				}
			}
		});
		return false;
	});

	//  Mark as done
	$('.ma').click(function(){
		var el = $(this);
		var URL = el.attr('href');
		$.ajax({
			url : URL,
			type : 'get',
			success : function(response){
				el.text(response.text);
				el.attr('href',response.link);
				el.attr('class',response.class);
			}
		});
		return false;
	});
</script>
@endsection