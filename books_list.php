


<?php include 'includes/config.php'?>
<?php include 'includes/header.php'?>
<h3> Books from the World </h3>
 
<?php
    
    $sql = "select * from read_books";

$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));
$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));
if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
	while ($row = mysqli_fetch_assoc($result))
    {
	   echo "<p>";
	   echo "Name of Book: <b>" . $row['bookName'] . "</b><br /> ";
        echo "Author: <b>" . $row['author'] . "</b><br /> ";
        echo "Words: <b>" . $row['wordSummary'] . "</b><br /> ";
        
        echo '<a href="books_view.php?id=' . $row['bookID'] . '">' . $row['bookName'] . '</a>';
        
        echo "</p>";
    }
}else{//no records
	echo '<div align="center">What! No books?  There must be a mistake!!</div>';
}

@mysqli_free_result($result); #releases web server memory
@mysqli_close($iConn); #close connection to database

    
    ?>

<?php include 'includes/footer.php'?>

