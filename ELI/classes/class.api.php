<?php
class API{

    function getDefaultAPIKey($salt=""){
        $defapikey= md5($_SERVER['SERVER_NAME'].date("Y").@$salt);
        return $defapikey;
    }
    
    function formatResult($result,$type="query"){
        $type1 = explode(",","insert,update,delete");
        if(in_array($type,$type1)){
            // type1
            if($result['success']){
                return json_encode($result);
            }
            else
            {
                $rsp['success'] = false;
                return json_encode($rsp);
            }
        }
        else
        {
            // default type
            if(count($result) > 0){
                $rsp['success'] = true;
                $rsp['data'] = $result;
                $rsp['length'] = count($result);
                return json_encode($rsp);
            }
            else
            {
                $rsp['success'] = false;
                $rsp['data'] = @$result;
                $rsp['message'] = "No Records Found";
                $rsp['length'] = count($result);
                return json_encode($rsp);
            }
        }
    }   

    function runquery($query,$columns2Show='id,text')
    {
        // DB PROCESS
        $getQuery = new DATABASE;
        $Data = $getQuery->query($query);
        $colshow = explode(',',$columns2Show);
        $colend = end($colshow);
        $total = count($Data);
        $i=0;  
        foreach($Data as $d)
        {
            $row="";
            $row.= "{";
            foreach($colshow as $c)
            {
               if($colend==$c)
               { 
                $row.= "\"$c\": \"".htmlentities($d[$c])."\"";
               }
               else
               {
                $row.= "\"$c\": \"".htmlentities($d[$c])."\",";
               }
            }
            if($total<$i)
            {
            $row.= "},\n";
            }
            else
            {
                $row.= "}";
            }
            $i++;
        }        
        
        // output to the browser
        // header('Content-Type: text/javascript; charset=UTF-8');
        echo "[\n" .$row."\n]";

    }
    
}


?>