
<!DOCTYPE HTML>
<html>
<b>Fast  Heatmap Creator</b>
<br>
<a href="300k_by_8.csv" target="_blank">Sample Gene File Download</a>
<br>
<img src="morpheus.png" alt="matrix" style="width:304px;height:228px;">
<br>
<br>
<style>
.error {color: #FF0000;}
</style>
<b>version 0.26 removed color.php <b>
<head>

        <link rel="stylesheet" href="css/colorpicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/layout.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/colorpicker.js"></script>
    <script type="text/javascript" src="js/eye.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/layout.js?ver=1.0.2"></script>
        <!-- Numeric.js -->
 <script src="    https://cdnjs.cloudflare.com/ajax/libs/numeric/1.2.6/numeric.min.js"></script> 
<!-- Plotly.js -->
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <!--<script src="plotly/loader/loadersrc/plotly-latest.min.js"></script>-->
        <!--<script src='libs/numeric.min.js'></script>=--> 
        </head>
        <body>
        <!-- Plotly chart will be drawn inside this DIV -->
<script>
    
function setColor(){
    var x = document.createElement("INPUT");
    x.setAttribute("type", "color");
    document.body.appendChild(x);
}
 peace= new setColor() ;
 color = new setColor();
</script>
<?php
// define variables and set to empty values
$colorErr = $lowColorErr   = "";
$color = $lowColor    = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["highcolor"])) {
    $colorErr = "Name is required";
  } else {
    $color = test_input($_POST["highcolor"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$color)) {
      $colorErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["lowcolor"])) {
    $lowColorErr = "Email is required";
  } else {
    $lowColor = test_input($_POST["lowcolor"]);
    // check if e-mail address is well-formed
   
  }
 
 
  
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<?php
return $color;
?>
<h2>Enter Colors Here</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="">  
  HighColor: <input type="text" name="highcolor" value=<?php echo $name;?>>
  <span class="error">*<?php echo $nameErr;?> </span>
  <br><br>
  LowColor: <input type="text" name="lowcolor" value=<?php echo $email;?>>
  <span class="error">*<?php echo $emailErr;?> </span>
  <br><br>
   <input type="submit"  value="Submit">  
</form>
        <div id="myDiv"></div>
        <script>
        function makeplot() {
  //Plotly.d3.csv("localhost", function(data){ processData(data) } );
};
var wait = true; 
var zValues = [];
function popData(fl) { 
Plotly.d3.csv(fl, function(data) {
  dataset = data.map(function(d) { return [ +d["Control 1"], +d["Control 2"], +d["Exp3"], +d["Exp4"], +d["Exp5"], +d["Exp6"] ]; });
  zValues = dataset; 
  console.log(zValues); 
  wait = false; 
}); 
}; 
  function handleFileSelect() {
    var file   = document.getElementById("files").files[0];
    var reader  = new FileReader();
  reader.addEventListener("load", function () {
    var fileURI = reader.result;
    popData(fileURI);
    console.log("fired");
  }, false);
  if (file) {
    reader.readAsDataURL(file);
  }
     
  }
//popData(); 
function processData(allRows) {
  console.log(allRows);
  zValues = allRows; 
  var x = [], y = [], standard_deviation = [];
  for (var i=0; i<allRows.length; i++) {
    row = allRows[i]; 
  }
  console.log( 'X',x, 'Y',y, 'SD',standard_deviation );
  makePlotly( x, y, standard_deviation );
}
makeplot(); 
//popData(); 
function setColor(){
				
    var x = document.createElement("INPUT");
    x.setAttribute("type", "color");
    document.body.appendChild(x);
    
}
function getResult(){
      if (!wait) {
                   var xValues = ['A', 'B','C','D','E'];
var yValues = ['W', 'X', 'Y', 'Z'];
//console.log(zValues);
var peacer= new setColor() 
var colorScaled= new setColor()
var colorscaleValue = [
 
			
  [0, <?php  $_REQUEST["highcolor"] ?> ],
  [1, <?php $_REQUEST["lowcolor"]?>]
];
var data = [{
  x: xValues,
  y: yValues,
  z: zValues,
  type: 'heatmap',
  colorscale: colorscaleValue,
  showscale: false
}];
var layout = {
  title: 'High Performance Interactive Heatmap',
  annotations: [],
  xaxis: {
    ticks: '',
    side: 'top'
  },
  yaxis: {
    ticks: '',
    ticksuffix: ' ',
    width: 700,
    height: 700,
    autosize: false
  }
};
for ( var i = 0; i < yValues.length; i++ ) {
  for ( var j = 0; j < xValues.length; j++ ) {
    var currentValue = zValues[i][j];
    if (currentValue != 0.0) {
      var textColor = 'white';
    }else{
      var textColor = 'black';
    }
    var result = {
      xref: 'x1',
      yref: 'y1',
      x: xValues[j],
      y: yValues[i],
      text: zValues[i][j],
      font: {
        family: 'Arial',
        size: 12,
        color: 'rgb(50, 171, 96)'
      },
      showarrow: false,
      font: {
        color: textColor
      }
    };
    layout.annotations.push(result);
  }
}
Plotly.newPlot('myDiv', data, layout);
      } else {
           setTimeout(getResult, 250);
      }
 }
getResult(); 
        </script>
<input type="file" id="files" name="files[]" onchange="handleFileSelect()" />
<output id="list"></output>
        </body>
</html>
