<?php

/**************************************************
                FUNCTION deleteTask
***************************************************/

/**
*
* A function which deletes tasks, if $_GET contains value delete(shows in url) then it connect to database and deletes the task *   * with corresponding id. Echoes a message telling task deleted.
*
*
*
*
**/

function deleteTask() {
    
    global $conn;
    
    $stmt = $conn->stmt_init();
    
    if( isset($_GET["delete"]) ) {
	// checks if "delete" exists in the url
	$taskToDelete = $_GET["delete"];
	$query = "DELETE FROM tasks WHERE id = '{$taskToDelete}'";

	if( $stmt->prepare($query) ) {
		$stmt->execute();
		echo "<p>Uppgiften raderades.</p>";
	}
}
    
}

/**************************************************
                FUNCTION completeTask
***************************************************/

/**
*
* A function wich completes tasks. if $_GET contains value complete(shows in url) then it  * connect to database and sets complete * value to 1(task completed) on the task with corresponding id. Echoes a message telling task completed.
*
*
*
*
**/

function completeTask() {
    
    global $conn;
    
    $stmt = $conn->stmt_init();
    
    if( isset( $_GET["complete"] ) ) {
    // checks if "complete" exists in the url
	$idToComplete = $_GET["complete"];

	$query = "UPDATE tasks SET complete = 1
				WHERE id = '{$idToComplete}'";

	if($stmt->prepare($query)) {
		$stmt->execute();
		echo "Uppgiften markerades som klar.";
	}
}
    
}

/**************************************************
                FUNCTION addTask
***************************************************/

/**
*
* A function which add tasks. if $_POST contains value addtask and prio, then it connect to * database and adds the task and prio   * level. Echoes a message telling task added.
*
*
*
*
**/

function addTask() {
    
    global $conn;
    
    $stmt = $conn->stmt_init();
    // checks if $_POST array contains addtask value stores it in variable $taskname, stores prio level in variable $prio.
    if( isset($_POST["addtask"]) ) {
	$taskName = $_POST["taskname"];
	$prio = $_POST["prio"];

	$query = "INSERT INTO tasks 
				VALUES ('', '{$taskName}', 0, '{$prio}')";

	if($stmt->prepare($query)) {
		$stmt->execute();
		header("Location: index.php?taskadded"); // sends user to index.php, empties the $_POST array and prevents duplicate values if page refreshed.
	}
}

if(isset($_GET["taskadded"])) {
	echo "Uppgiften lades till.";
}
    
}

/**************************************************
                FUNCTION displayTask
***************************************************/

/**
*
*
* A function which connects to database and retrives task information and displays it thrue 
* a table echoed with php. Sorts tasks by either name, prio, completed in asc or desc order.
*
*
**/

function displayTasks() {
    
    global $conn;
    
    $stmt = $conn->stmt_init();
    
    $sort = "";
    if(isset($_GET["sort"])) { // avoids error message.
	$sort = $_GET["sort"]; // sorts tasks depending on what user clicked.
    }

    if($sort == "name") {
        $query = "SELECT * FROM tasks ORDER BY taskName";
    } else if($sort == "asc") {
        $query = "SELECT * FROM tasks ORDER BY priority ASC";
    } else if($sort == "desc") {
        $query = "SELECT * FROM tasks ORDER BY priority DESC";
    } else if($sort == "done") {
        $query = "SELECT * FROM tasks ORDER BY complete";
    } else {
        $query = "SELECT * FROM tasks";
    }
    
    if($stmt->prepare($query)) { // checks so SQL is correct writed.
	$stmt->execute(); // runs the question against database.

	$stmt->bind_result($id, $taskName, $complete, $prio);
    // echoes start of table
	echo '<table class="table table-bordered">';
    echo    '<thead>
                <tr>
                    <th class="textcol">To do</th>
                    <th class="textcol">Prio</th>
                    <th class="textcol">Radera</th>
                    <th class="textcol">Klar</th>
                </tr>
            </thead
            <tbody';

	while( mysqli_stmt_fetch($stmt) ) {
		echo '<tr>';
			$class  = "";// sets different $class variables to be used to show stylöing of tasks.
            $class0 = "";
            $class1 = "";
            $class2 = "";
            $class3 = "";
			if($complete == 1) {
				$class = "bg-success";// makes completed tasks row green
			}
            if($prio == 0) {
				$class0 = "prio0";// makes prio text white on tasks with prio 0. 
			}
            if($prio == 1) {
				$class1 = "prio1";// makes prio text yellow on tasks with prio 1. 
			}
            if($prio == 2) {
				$class2 = "prio2";// makes prio text orange on tasks with prio 2. 
			}
            if($prio == 3) {
				$class3 = "prio3";// makes prio text red on tasks with prio 3. 
			}
            // echoes table data cells with taskname, prio and links to delete, complete tasks.
			echo "<td class='$class textcol'>$taskName</td>";
			echo "<td class='$class $class0 $class1 $class2 $class3'>$prio</td>";

			echo "<td class='$class'>
				    <a href='index.php?delete=$id&sort=$sort'>Radera</a>
			     </td>";

			echo "<td class='$class'>
				    <a href='index.php?complete=$id'>Klar</a>
			     </td>";


		echo '</tr>';
	}
	echo '</tbody
        </table>';
    } else {
	echo mysqli_error($conn); // echoes mysqli errors if any.
    }
}

/**************************************************
                FUNCTION displayFinished
***************************************************/

/**
*
*
* A function which connects to database and retrives task wich are finished and displays them.
*
*
**/

function displayFinished() {
    
    global $conn;
    
    $stmt = $conn->stmt_init();

    $query = "SELECT * FROM tasks";
    
    if($stmt->prepare($query)) { // checks so SQL is correct writed.
	$stmt->execute(); // runs the question against database.

	$stmt->bind_result($id, $taskName, $complete, $prio);
    
    echo '<h1>Avklarade uppgifter.</h1>';

	while( mysqli_stmt_fetch($stmt) ) {
        
			if($complete == 1) {
				echo "<p>$taskName</p<br>";
			}

	}

    } else {
	echo mysqli_error($conn); // echoes mysqli errors if any.
    }
}

/**************************************************
                FUNCTION displayToDo
***************************************************/

/**
*
*
*  A function which connects to database and retrives tasks which still needs to be done and
*  displays them.
*
*
**/

function displayToDo() {
    
    global $conn;
    
    $stmt = $conn->stmt_init();

    $query = "SELECT * FROM tasks";
    
    if($stmt->prepare($query)) { // checks so SQL is correct writed.
	$stmt->execute(); // runs the question against database.

	$stmt->bind_result($id, $taskName, $complete, $prio);
    
    echo '<h1>Uppgifter kvar att göra.</h1>';

	while( mysqli_stmt_fetch($stmt) ) {
			
        if($complete == 0) {
				echo "<p>$taskName</p<br>";
			}

	}

    } else {
	echo mysqli_error($conn); // echoes mysqli errors if any.
    }
}


/**************************************************
               TODO
***************************************************/

/**
*
* *Finetune functions more.
* *Nicer display of messages.
* *More styling.
*
*
**/