<?php 
    
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "todo");

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
}

if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
	header('location: index.php');
}


?>
<html>
<head>
	<title>ToDo List Application PHP and MySQL</title>
      <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List Application PHP and MySQL database</h2>
	</div>
	<form method="post" action="index.php" class="input_form">
		<input type="text" name="task" placeholder="enter your list here!!!"" class="task_input" >
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>


<table>
	<thead>
		<tr>
			<th>             </th>
			<th>Tasks</th>
			
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM tasks");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id'] ?>">delete</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>
<?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
<?php } ?>
</body>
</html>
<style>
* {
	margin: 0;
	box-sizing: border-box;
	font-family: "Fira sans", sans-serif;
}
:root {
--darks:#6b9da2;
	--dark: #34898f;
	--darker: #0e464f;
	--darkest: #083747;
	--grey: #121313;
	--pink: #ed1681;
	--purple: #685495;
	--light: #EEE;
}
body {
	display: flex;
	flex-direction: column;
	min-height: 100vh;
	color: #FFF;
	background-color: var(--darks
    
    );
}
.heading{
	width: 50%;
	margin: 30px auto;
	text-align: center;
	color:-EEE	;
	background: #0e464f;
background-image: linear-gradient(to right, var(--pink), var(--purple));
	
}
form {
	width: 50%; 
	margin: 20px auto; 
	
	
}
form p {
	color: red;
	margin: 0px;
}
.task_input {
	width: 75%;
	height: 35px; 
	
}
.add_btn {
	height: 39px;
	
   background-image: linear-gradient(to right, var(--pink), var(--purple));
	color:  #EEE	;
	
	border-radius: 5px; 
	padding: 5px 20px;
}

table {
    width: 50%;
    margin: 30px auto;
    border-collapse: collapse;
}

tr {
	border-bottom: 1px solid #cbcbcb;
}

th {
	font-size: 25px;
	color: #6B8E23;
}

th, td{
	border: none;
    height: 30px;
    padding: 2px;
}

tr:hover {
	background: #E9E9E9;
}

.task {
	text-align: left;
}

.delete{
	text-align: center;
}
.delete a{
	color: white;
	background: #a52a2a;
	padding: 1px 6px;
	border-radius: 3px;
	text-decoration: none;
}
</style>
