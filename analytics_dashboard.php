<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<h2>Attendance Analytics</h2>

<canvas id="chart"></canvas>

<script>

new Chart(document.getElementById('chart'),{
type:'bar',
data:{
labels:['CSE','AI','EE','CE'],
datasets:[{
label:'Attendance %',
data:[85,78,82,74]
}]
}
});

</script>

</body>
</html>