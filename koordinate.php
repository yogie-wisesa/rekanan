<?php

function parseToXML($htmlStr)
{
    $xmlStr = str_replace('<', '&lt;', $htmlStr);
    $xmlStr = str_replace('>', '&gt;', $xmlStr);
    $xmlStr = str_replace('"', '&quot;', $xmlStr);
    $xmlStr = str_replace("'", '&#39;', $xmlStr);
    $xmlStr = str_replace("&", '&amp;', $xmlStr);
    return $xmlStr;
}

// Opens a connection to a MySQL server
$connection = mysqli_connect('localhost', 'root', '');
if (!$connection) {
    die('Not connected : ');
}

// Set the active MySQL database
$db_selected = mysqli_select_db($connection, 'appraisal');
if (!$db_selected) {
    die('Can\'t use db : ');
}

// Select all the rows in the markers table
$query = "SELECT * FROM tb_laporan";
$result = mysqli_query($connection, $query);
if (!$result) {
    die('Invalid query: ');
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind = 0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)) {
    // Add to XML document node
    echo '<marker ';
    echo 'id="' . $row['id'] . '" ';
    echo 'name="' . parseToXML($row['namaDebitur']) . '" ';
    echo 'lat="' . $row['latitude'] . '" ';
    echo 'lng="' . $row['longitude'] . '" ';
    echo '/>';
    $ind = $ind + 1;
}

// End XML file
echo '</markers>';
