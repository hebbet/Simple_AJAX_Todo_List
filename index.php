<!DOCTYPE HTML>
<html>
<head>
	<title>Simple To-Do List</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="wrap">
		<form class="add-new-task" autocomplete="off">
			<input type="text" name="new-task" placeholder="Add a new item..." />
		</form>
		<div class="task-list">
			<ul>

			<?php 
				require("includes/connect.php");

				$query = mysql_query("SELECT * FROM tasks WHERE done=0 ORDER BY date ASC, time ASC");
				$numrows = mysql_num_rows($query);

				if($numrows>0){
					while( $row = mysql_fetch_assoc( $query ) ){

						$task_id = $row['id'];
						$task_name = $row['task'];
						$task_date = $row['date'];

						echo '<li>
								<span>'.$task_name.', '.$task_date.'</span>
								<img id="'.$task_id.'" class="delete-button" width="10px" src="images/close.svg" />
							  </li>';
					}
				}

			?>
				
			</ul>
		</div>
	</div><!-- #wrap -->
</body>
	<!-- JavaScript Files Go Here -->
	<script src="js/jquery-2.1.3.min.js"></script>
	<script>
		
		add_task(); // Call the add_task function
		delete_task(); // Call the delete_task function

		function add_task() {

			$('.add-new-task').submit(function(){

				var new_task = $('.add-new-task input[name=new-task]').val();

				if(new_task != ''){

					$.post('includes/add-task.php', { task: new_task }, function( data ) {

						$('.add-new-task input[name=new-task]').val('');

						$(data).appendTo('.task-list ul').hide().fadeIn();

						delete_task();
					});
				}

				return false; // Ensure that the form does not submit twice
			});
		}

		function delete_task() {

			$('.delete-button').click(function(){

				var current_element = $(this);

				var id = $(this).attr('id');

				$.post('includes/delete-task.php', { task_id: id }, function() {

					current_element.parent().fadeOut("fast", function() { $(this).remove(); });
				});
			});
		}

	</script>

</html>