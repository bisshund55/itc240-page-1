<?php
//customer_view.php - shows details of a single customer
?>
<?php include 'includes/config.php';?>
<?php

//process querystring here
if(isset($_GET['id']))
{//process data
    //cast the data to an integer, for security purposes
    $id = (int)$_GET['id'];
}else{//redirect to safe page
    header('Location:books_list.php');
}


$sql = "select * from read_books where bookID = $id";
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    while($row = mysqli_fetch_assoc($result))
    {
        $bookName = stripslashes($row['bookName']);
        $author = stripslashes($row['author']);
        $wordSummary = stripslashes($row['wordSummary']);
        $title = "Title Page for " . $bookName;
        $pageID = $bookName;
        $Feedback = '';//no feedback necessary
    }    

}else{//inform there are no records
    $Feedback = '<p>No record for this book has been found</p>';
}

?>
<?php include 'includes/header.php';?>
<h1><?=$pageID?></h1>
<?php
    
    
if($Feedback == '')
{//data exists, show it

    echo '<p>';
	   echo 'Name of Book: <b>' . $bookName . '</b> ';
        echo 'Author: <b>' . $author . '</b> ';
        echo 'Words: <b>' . $wordSummary . '</b> ';
        
        echo'<img src="uploads/book' . $id . '.jpg" />';
        
        
        echo '</p>';
}else{//warn user no data
    echo $Feedback;
}    

echo '<p><a href="books_list.php">Go Back</a></p>';

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

?>
<?php include 'includes/footer.php';?>