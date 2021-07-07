<?php

/**
 *  ELI FRAMEWORK
 *  FRAMEWORK CREATED BY AJAY KUMAR (TECHSOUL.IN) // EAGLE LITE - ELI FRAMEWORK
 *  +91 9862542983
 *  techsoul4@gmail.com
 * V2
 */
CLASS DATABASE{

function formatError($err){
    // Error Message
    
    echo "<div style='display: block;background: linear-gradient(180deg, rgb(177, 19, 19) 0%, rgb(251, 0, 0) 100%);color: white;padding: 1em 2em;border-radius: .5em;font-family: sans-serif;box-sizing: border-box;box-shadow: 0px 0px 5px rgba(0,0,0,.2); margin:1em .5em'>".$err->getMessage() . "</div>";
    echo "<pre>";
    print_r($err);

        $errorfile = "PDOErrors.txt";
        $tempfile = tempnam("","TMP0"); 

        # Since we get the actual file name we can check to see if it is writable or not
        if (!is_writable($tempfile)) {
            # your logic to log the errors
            die("<div style='display: block;background: linear-gradient(180deg, rgba(11,4,168,1) 0%, rgba(213,30,227,1) 100%);color: white;padding: 1em 2em;border-radius: .5em;font-family: sans-serif;box-sizing: border-box;box-shadow: 0px 0px 5px rgba(0,0,0,.2); margin:1em .5em'><strong>Permission Denied</strong> (".$errorfile.")</div>");
            return;
        }    

        file_put_contents($errorfile,$err, FILE_APPEND);  // log errors at project path    
    
    die();  //  terminate connection
}    

function getDBInfo($config="USER"){
    if(isset($config) && !is_array($config)){
      return @$GLOBALS[$config];
    }
    else {
      return $config;
    }
}

function connect_db($config='',$dbtype='mysql',$log='N')
{
  $config = self::getDBInfo($config);
  if(isset($config) && is_array($config)){
    $dbtype = $config['config']['dbtype'];
    $dbhost = $config['config']['dbhost'];
    $dbuser = $config['config']['dbuser'];
    $dbpass = $config['config']['dbpass'];
    $dbname = $config['config']['dbname'];
  }
  else {
    //USER DATABASE
    $dbtype = $GLOBALS['USER']['config']['dbtype'];
    $dbhost = $GLOBALS['USER']['config']['dbhost'];
    $dbuser = $GLOBALS['USER']['config']['dbuser'];
    $dbpass = $GLOBALS['USER']['config']['dbpass'];
    $dbname = $GLOBALS['USER']['config']['dbname'];

    //CMS DATABASE
    /*
    $dbtype = $GLOBALS['CMS']['config']['dbtype'];
    $dbhost = $GLOBALS['CMS']['config']['dbhost'];
    $dbuser = $GLOBALS['CMS']['config']['dbuser'];
    $dbpass = $GLOBALS['CMS']['config']['dbpass'];
    $dbname = $GLOBALS['CMS']['config']['dbname'];
    */
  }

switch ($dbtype)
{
    case "mysql":
    try {
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo ($log=='Y' OR $log=='y')?"Connected successfully":"";
        return $conn;
        }
    catch(PDOException $e)
        {
        echo "Connection failed: ";
        echo $e->getMessage() . "<br/>";
        file_put_contents('PDOErrors.txt',$e, FILE_APPEND);  // write some details to an error-log outside public_html
        die();  //  terminate connection
        }
    break;

    case "sqlite":
        try {
          $conn = new PDO('sqlite:'.$dbname,$dbuser,$dbpass);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //$con->exec("SET CHARACTER SET utf8");  //  return all sql requests as UTF-8
			return $conn;
        }
        catch (PDOException $err) {
            echo "Database Connection failed.";
            echo $err->getMessage() . "<br/>";
            file_put_contents('PDOErrors.txt',$err, FILE_APPEND);  // write some details to an error-log outside public_html
            die();  //  terminate connection
        }
    break;
}

}


function disconnect_db($config='')
{
   $conn = self::connect_db($config);
   $conn = null;
}

// TABLE EXIST
function tableExists($table,$config="") {

    // Try a select statement against the table
    // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
    try {
        $conn = self::connect_db($config);
        $result = $conn->query("SELECT 1 FROM $table LIMIT 1");
        self::disconnect_db($config); // DISCONNECT DB
    } catch (Exception $e) {
        // We got an exception == table not found
        return FALSE;
    }

    // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
    return $result !== FALSE;
}


// INSERT ROW
function insert_row($table_name, $form_data,$config="")
{
    try {
    // retrieve the keys of the array (column titles)
    $fields = array_keys($form_data);

    // build the query
    $sql = "INSERT INTO $table_name";
    $sql .= " (`" . implode("`, `", array_keys($form_data)) . "`)";
    $sql .= " VALUES ('" . implode("', '", $form_data) . "') ";

    $conn = self::connect_db($config);
    $dasq = $conn->exec($sql);
    $last_id = $conn->lastInsertId();
    if ($dasq > 0)
    {
        $returnmsg['id'] = $last_id;
        $returnmsg['success'] = true;
        $returnmsg['message'] = 'Successfully Data Added';

    }
    elseif ($dasq != 1)
    {
        $returnmsg['success'] = false;
        $returnmsg['message'] = $dasq->errorInfo();
    } else
    {
        $returnmsg = '';
    }

    self::disconnect_db($config); // DISCONNECT DB

    // run and return the query result resource
    return $returnmsg;
    }
catch (PDOException $err) {
    self::formatError($err);
}

}

// UPDATE ROW
function update_row($table_name, $form_data, $where_clause = '',$config='')
{
try{
    // check for optional where clause
    $whereSQL = '';
    if (!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if (substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add key word
            $whereSQL = " WHERE " . $where_clause;
        } else
        {
            $whereSQL = " " . trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE " . $table_name . " SET ";

    // loop and build the column /
    $sets = array();
    foreach ($form_data as $column => $value)
    {
        $sets[] = "`" . $column . "` = '" . $value . "'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;

    // run and return the query result

    $conn = self::connect_db($config);
    // Prepare statement
    $dasq = $conn->prepare($sql);
    // execute the query
    $dasq->execute();
    $dasqc = $dasq->rowCount();
    // echo a message to say the UPDATE succeeded
    if ($dasqc > 0)
    {
        $returnmsg['success'] = true;
        $returnmsg['message'] = "Successfully Updated";
    } elseif ($dasqc < 1)
    {
        $returnmsg['success'] = false;
        $returnmsg['message'] =$dasq->errorInfo();
    } else
    {
        $returnmsg = '';
    }

    self::disconnect_db(); // DISCONNECT DB
    return $returnmsg;
}
catch (PDOException $err) {
    // echo "Database Connection failed.";
    echo $err->getMessage() . "<br/>";
    file_put_contents('PDOErrors.txt',$err, FILE_APPEND);  // write some details to an error-log outside public_html
    die();  //  terminate connection
}    
}


// DELETE ROW
function delete_row($table_name, $where_clause = '',$config="")
{
try {
    // check for optional where clause
    $whereSQL = '';
    if (!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if (substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add keyword
            $whereSQL = " WHERE " . $where_clause;
        } else
        {
            $whereSQL = " " . trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM " . $table_name . $whereSQL;

    // run and return the query result resource
  $conn = self::connect_db($config);
	$dasq = $conn->exec($sql);
    if($dasq>0)
    {
        $returnmsg['success'] = true;
        $returnmsg['message'] = "Deleted Successfully";
    }
    else
    {
        $returnmsg['success'] = false;
        $returnmsg['message'] = "Invalid Delete";
    }
  self::disconnect_db($config);
  return  $returnmsg;
  }
catch (PDOException $err) {
    // echo "Database Connection failed.";
    echo $err->getMessage() . "<br/>";
    file_put_contents('PDOErrors.txt',$err, FILE_APPEND);  // write some details to an error-log outside public_html
    die();  //  terminate connection
}
}

function query($sql,$config='')
{
 try {
 $conn = self::connect_db($config);
 $stmt = $conn->prepare($sql);
 $stmt->execute();
 // set the resulting array to associative
 $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
 $rows = $stmt->fetchAll();
 settype($result, 'Array');
 $totalrows = COUNT($result);
    if ($totalrows > 0) {
        // output data of each row
       return $rows;

    } else {
        echo "0 results";
    }
  self::disconnect_db($config);
}
catch (PDOException $err) {
    self::formatError($err);
}
catch (Exception $e) {
    self::formatError($e);
}
}

function upload($file,$tofolder,$returnpath='Y')
{
    try {
    if($file['error']==0)
    {
        if(!file_exists($tofolder))
        {
            mkdir($tofolder,777,true);
        }
        $ext_a = explode('.',$file['name']);
        $ext = end($ext_a);
        $filename = time().'.'.$ext;
        $uploadedfile = $file['tmp_name'];
        $uploadto= $tofolder.'/'.$filename;

        $tempfile = tempnam($tofolder,"TMP0"); 
        # Since we get the actual file name we can check to see if it is writable or not
        if (!is_writable($tempfile)) {
            # your logic to log the errors
            die("<div style='display: block;background: linear-gradient(180deg, rgba(11,4,168,1) 0%, rgba(213,30,227,1) 100%);color: white;padding: 1em 2em;border-radius: .5em;font-family: sans-serif;box-sizing: border-box;box-shadow: 0px 0px 5px rgba(0,0,0,.2); margin:1em .5em'><strong>Permission Denied</strong> (".$tofolder.")</div>");
            return;
        }

        move_uploaded_file($uploadedfile,$uploadto);
        if(file_exists($uploadto))
        {
            return $uploadto;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return " ERROR ON FILE: ".$file['error'];
    }
}
catch (Exception $err) {
    self::formatError($err);
}
}


}
?>
