<?php
/*standard php insert for checking sign in
<?php include "utils.php";$user=signedin();?>
*/
function signedin(){
    session_start();
    if (isset($_SESSION['user'])){return $_SESSION['user'];}else{
        echo "<meta http-equiv='Refresh' content='0; url=\"login.php\"' />";
    }
}
function issignedin(){
    session_start();
    if (isset($_SESSION['user'])){return $_SESSION['user'];}else{return 'sign in';}
}
function mysqlcredentials(){
    $servername = "localhost";
    $username = "root";
    $password = "2f250b0a20f4777afc4e6cfc180c8aff0aee56bfbccdea4a";
    $credentials = array("server"=>$servername, "username"=>$username, "password"=>$password);
    return $credentials;
}
function mysqlconnect($database){
    $cred=mysqlcredentials();
    $conn = new mysqli($cred['server'], $cred['username'],$cred['password'], $database);
    return $conn;

}
function login($identifier,$enteredpassword){
    $passwordhash=userdata($identifier)['password'];
    $verification=password_verify($enteredpassword, $passwordhash);
    return$verification;


    
}
function userdata($identifier){
    $database = "user_data";
    $conn = mysqlconnect($database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        echo "<p style='color:red;'>failed to connect to our servers. Please try again later.<p>";
    }
    $sql="SELECT * FROM users WHERE email = '$identifier' OR username = '$identifier' OR id = '$identifier'";
    #echo $sql;
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $userdata= $row;
    }
    mysqli_close($conn);
    return $userdata;

    
}
function gettable($database,$table){
    $tabledata = [];
    $conn = mysqlconnect($database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        echo "<p style='color:red;'>failed to connect to our servers. Please try again later.<p>";
    }
    $sql="SELECT * FROM $table";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        if(array_key_exists('id',$row)){
            $tabledata += [$row['id'] => $row];
        }else{
            array_push($tabledata,$row);
        }
        
    }
    mysqli_close($conn);
    return $tabledata;

    
}
function getusertable($id,$table){
    $database = "user_database_".$id;
    $tabledata = gettable($database,$table);
    return $tabledata;

    
}

function getusercontacts($id){
    $database = "user_data";
    $table='contacts';
    $sql="SELECT * FROM `$table` WHERE `account` = ".$id;
    $conn = mysqlconnect('user_data');
    $result = $conn->query($sql);
    $tabledata = [];

    while($row = $result->fetch_assoc()) {
        if(array_key_exists('id',$row)){
            $tabledata += [$row['id'] => $row];
        }else{
            array_push($tabledata,$row);
        }
        
    }
    mysqli_close($conn);
    return $tabledata;
}
function makeassoc($keys,$values){
    $data=[];
    for($x = 0; $x <= count($keys)-1; $x++){
        $data += [$keys[$x] => $values[$x]];
    }
    return $data;

}

function newcontact($values,$id){
    $names=explode(",","account,viewers,editors,name,lastname,jewname,jewstatus,gender,age,mood,number,email,country,state-province,city,zip-postal,street,address,unit-apt,datecreated,timecreated,lastseen,notes");
    #create associative array with the default values
    $default_values=explode(",","'$id', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '','','','',''");
    
    $data=makeassoc($names,$default_values);
    #change the defaults to provided values as provided
    $provided_values=array_keys($values);
    foreach($provided_values as $key){
        if ( isset($data[$key])){
        $data[$key]="'".$values[$key]."'";
        }
    }
    $nametext="(`".implode("`,`",$names)."`)";
    $valuetext="(".implode(",",$data).")";
    $sql="INSERT INTO `contacts` ".$nametext." VALUES ".$valuetext."";
    $conn=mysqlconnect('user_data');
    $conn->query($sql);
    
    
}
function newuserdatabase($identifier){
    $id=userdata($identifier)['id'];
    $cred=mysqlcredentials();
    $conn = new mysqli($cred['server'], $cred['username'],$cred['password']);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        echo "<p style='color:red;'>failed to connect to our servers. Please try again later.<p>";
    }
    
    $sql = "CREATE DATABASE user_database_$id;";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    $conn->close();

    
}
function newusertables($identifier){
    $id=userdata($identifier)['id'];
    $database="user_database_".$id;
    $conn=mysqlconnect($database);
    $sql="CREATE TABLE inbox (
        id INT(6) NOT NULL AUTO_INCREMENT,
        senddate VARCHAR(30),
        sendtime VARCHAR(20),
        sender VARCHAR(50),
        subject VARCHAR(100),
        message VARCHAR(1000),
        wasread INT(1),
        PRIMARY KEY (id) );
    ";
    #echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "inbox created successfully";
    } else {
        echo "Error creating inbox: " . $conn->error;
    }
}
function unique($item,$column){
    $database = "user_data";
    $conn = mysqlconnect($database);
    $sql = "SELECT * FROM users WHERE $column IN('$item')";
    $result = $conn->query($sql);
    $count=mysqli_num_rows($result);
    if ($count==0){return True;}else{return False;}
}
function sendmessage($userto,$usernamefrom,$subject,$message,$localtime,$localdate){
    #$message=addslashes($message);
    $database='user_database_'.userdata($userto)['id'];
    #echo $database;
    $conn = mysqlconnect($database);
    $message=addslashes($message);
    $sql="INSERT INTO inbox (senddate,sendtime,sender,subject,message)
    VALUES ('$localdate', '$localtime', '$usernamefrom', '$subject', '$message');";
    #echo $sql;
    $conn->query($sql);
}
function systemmessage($id,$subject,$message){
    $localtime=date("h:i a");
    $localdate=date("l M d, Y");
    sendmessage($id,'Mivtzoim App',$subject,$message,$localtime,$localdate);

}
function getversion(){
    return 6;
}
function lastseen($id){
    $stamp=date("l   F jS\, Y h:i:s A");
    $sql="UPDATE users SET lastseen = '$stamp' WHERE id = $id;";
    $database = "user_data";
    $conn=mysqlconnect($database);
    $conn->query($sql);
}
    
function parsecsv($csv){
    $table=[];
    $rows=explode("\n",$csv);
            foreach($rows as $row){
                $items=explode(",",$row);
                array_push($table, $items);
            }
    return $table;
}

function newrow($database,$table,$id=''){
    $sql="SHOW columns FROM `".$table."`;";
    $conn=mysqlconnect($database);
    $result = $conn->query($sql);
    $columns = [];
    while($row = $result->fetch_assoc()) {
        array_push($columns,$row);
    }
    mysqli_close($conn);
    print_r($columns);
}
function zmanim(){
    $path = "http://he.chabad.org/tools/rss/zmanim.xml?locationId=531&locationType=1&bDef=0&before=22";
    
    // Read entire file into string
    $xmlfile = file_get_contents($path);
    
    // Convert xml string into an object
    $new = simplexml_load_string($xmlfile);
    
    // Convert into json
    $con = json_encode($new);
    
    // Convert into associative array
    $newArr = json_decode($con, true);
    $rawarray=$newArr['channel']['item'];
    //select useful data and add to new array
    //print_r($rawarray);
    $zmanim=array();
    foreach($rawarray as $item){
        $name=explode("-",$item['title'])[0];
        $data=array('name'=>$name,'time'=>$item['category']);

        array_push($zmanim,$data);

    }

    $keyedarray=array();
    foreach($zmanim as $zman){
        $name=$zman['name'];
        $time=$zman['time'];
        $category=$zman['category'];
        $keyedarray[$name]=array('name'=>$name,'time'=>$time,'category'=>$category);

    }



    return $keyedarray;
    

}
function zmanimhebcal($date){
    $url = "https://www.hebcal.com/zmanim?cfg=json&geonameid=293397&date=".$date."&tzid=Asia/Jerusalem&sec=1";
    $result = file_get_contents($url);
    $rawzmanim=json_decode($result, true);
    print_r($rawzmanim);
    return $rawzmanim['times'];
    

}

function dailystudy(){
    $path = "https://he.chabad.org/tools/rss/dailystudy_rss.xml";
    
    // Read entire file into string
    $xmlfile = file_get_contents($path);
    
    // Convert xml string into an object
    $new = simplexml_load_string($xmlfile);
    
    // Convert into json
    $con = json_encode($new);
    
    // Convert into associative array
    $newArr = json_decode($con, true);
    $rawarray=$newArr['channel']['item'];
    //select useful data and add to new array
    //print_r($rawarray);
    $shiurim=array();
    foreach($rawarray as $item){
        $name=$item['title'];
        $shiurim[$name]=explode(":",$item['description'])[1];;

    }


    return $shiurim;
    

}

function readdirectory($path){
    $dh = opendir($path);
    $i=1;
    $items=[];
    while (($file = readdir($dh)) !== false) {
    if($file != "." && $file != ".." && $file != "index.php" && $file != ".htaccess" && $file != "error_log" && $file != "cgi-bin") {
            array_push($items,$file);
            $i++;
        }
    }
closedir($dh);
return $items;
}
