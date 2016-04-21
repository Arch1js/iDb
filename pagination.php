<html>
<head>
</head>
<body>
  <div>
    <table BORDER=1 class="center">
        <th>make</th>
        <th>model</th>
        <th>price</th>
        <?php
        require 'dbconnect.php';
        // Number of items per page
        $perpage = 25;
        // Set the page to use
        if (isset($_GET["page"])) {
            $page = intval($_GET["page"]);
        } else {
            $page = 1;
        }
        // Work out the limit parameters
        $calc = $perpage * $page;
        $start = $calc - $perpage;
        // Run the MySQL LIMIT
        $result = $mysqli->query("select * from cars Limit $start, $perpage");
        // Get the recordset
        $rows = mysqli_num_rows($result);
        if ($rows) {
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['make'] . "</td>" .
                    "<td>" . $row['model'] . "</td>" .
                    "<td>" . $row['price'] . "</td></tr>";
                }
            }
        }
        ?>
    </table>
</div>
<ul class='pagination'>
    // Display go to page 1 link
    <li><a href='pagination.php?page=1'>«</a></li>
    <?php
    if (isset($page)) {
        // Get the number of records
        $result = mysqli_query($mysqli, "select Count(*) As Total from cars");
        $rows = mysqli_num_rows($result);
        if ($rows) {
            $rs = mysqli_fetch_assoc($result);
            $total = $rs["Total"];
        }
        // Calculate the number of pages
        $totalPages = ceil($total / $perpage);
        // If we are not on the first page display “Prev”
        if ($page > 1) {
            $j = $page - 1;
            echo "<li><a href='pagination.php?page=$j'>Prev</a></li>";
        }
        // Display the page links
        for ($i = 1; $i <= $totalPages; $i++) {
            // Highlight the current page
            if ($i <> $page) {
                echo "<li><a href='pagination.php?page=$i'>$i</a></li>";
            } else {
                echo "<li><a class='active href='pagination.php?page=$i'>$i</a></li>";
            }
        }
        // If we are not on the last page display “Next”
        if ($page != $totalPages) {
            $j = $page + 1;
            echo "<li><a href='pagination.php?page=$j'>Next</a></li>";
        }
        // Display go to last page link
        echo "<li><a href='pagination.php?page=$totalPages'>»</a></li>";
    }
    ?>
</ul>

</body>
</html>
<style>
ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}

ul.pagination li {display: inline;}

ul.pagination li a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 5px;
}

ul.pagination li a.active {
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
}

ul.pagination li a:hover:not(.active)
{
    background-color: #ddd;
}

</style>
