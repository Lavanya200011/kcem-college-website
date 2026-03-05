<?php
include 'includes/db.php';

$res=$conn->query("SELECT * FROM attendance");

echo "<table border=1>";

while($row=$res->fetch_assoc()){
echo "<tr>
<td>".$row['student_id']."</td>
<td>".$row['subject']."</td>
<td>".$row['date']."</td>
<td>".$row['status']."</td>
</tr>";
}

echo "</table>";
?>