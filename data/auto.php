<?php
 
// if the 'term' variable is not sent with the request, exit
if ( !isset($_REQUEST['term']) )
	exit;
 
// connect to the database server and select the appropriate database for use
$dblink = mysql_connect('127.0.0.1', 'root', '') or die( mysql_error() );
mysql_select_db('recipebox');
 
// query the database table for zip codes that match 'term'
$rs = mysql_query('select nama_bahan from bahan where nama_bahan like "'. mysql_real_escape_string($_REQUEST['term']) .'%" order by nama_bahan asc limit 0,10', $dblink);
 
// loop through each zipcode returned and format the response for jQuery
$data = array();
if ( $rs && mysql_num_rows($rs) )
{
	while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
	{
		$data[] = array(
			'label' => $row['nama_bahan']
		);
	}
}
 
// jQuery wants JSON data
echo json_encode($data);
flush();