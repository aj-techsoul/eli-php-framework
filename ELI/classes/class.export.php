<?php

class EXPORT
{

    function excel($queryordata,$filename2="reports")
    {
        $db = new DATABASE;
        $setCounter = 0;

        $setExcelName = $filename2."-". strtotime("now");

        if(is_array($queryordata))
        {
            $setRec = $queryordata;
        }
        else
        {
            $setSql = $queryordata;
            $setRec = $db->query($setSql);
        }

        $setCounter = count($setRec);

        for ($i = 0; $i < $setCounter; $i++) {
            $setMainHeader .= array_keys($setRec)[$i] . "\t";
        }

        while ($rec = $setRec) {
            $rowLine = '';
            foreach ($rec as $value) {
                if (!isset($value) || $value == "") {
                    $value = "t";
                } else {
                    //It escape all the special charactor, quotes from the data.
                    $value = strip_tags(str_replace('"', '""', $value));
                    $value = '"' . $value . '"' . "\t";
                }
                $rowLine .= $value;
            }
            $setData .= trim($rowLine) . "\n";
        }
        $setData = str_replace("r", "", $setData);

        if ($setData == "") {
            $setData = "no matching records foundn";
        }

        $setCounter = count($setRec);


        //This Header is used to make data download instead of display the data
        header("Content-type: application/octet-stream");

        header("Content-Disposition: attachment; filename=" . $setExcelName ."_Report.xls");

        header("Pragma: no-cache");
        header("Expires: 0");

        //It will print all the Table row as Excel file row with selected column name as header.
        echo ucwords($setMainHeader) . "\n" . $setData . "\n";


    }
    
    function largeexport($queryordata,$filename2="reports")
    {
        $db = new DATABASE;

    //    echo "Processing...";
        
        $setCounter = 0;

        $setExcelName = $filename2."-".date('d-m-Y');

        if(is_array($queryordata))
        {
            $setRec = $queryordata;
        }
        else
        {
            $setSql = $queryordata;
            $setRec = $db->query($setSql);
        }

        if(count($setRec) > 0){

        /////////////////////////////////////////////////////////////////
        // CSV EXPORT USING PHP OUTPUT
        $filename = $setExcelName.'-export.csv';

        //output the headers for the CSV file
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$filename}");
        header("Expires: 0");
        header("Pragma: public");
        
        //open the file stream
        $fh = @fopen('php://output', 'w');
        
        $headerDisplayed = false;
        
        // ASSIGN MAX SMALL LIMIT
        $smax = 1000;
        // GET NUMBER OF ROWS
        $total_records = count($setRec);
        // echo "<br />Total Records: $total_records <br />";
        
        if($total_records>$smax)
        {
            // echo "Its more than $smax < $total_records";
            
            
        } 
        else
        {
            // echo "Its small Data $total_records";
        }
        
        $arraydata = $setRec;
        $i=0;
        $ccsve_generate_value_arr = array_keys($arraydata[0]);
        // echo "<pre>";
        // print_r($ccsve_generate_value_arr);
        // die();
        foreach ($arraydata as $data) {
          $i++;  
            // Add a header row if it hasn't been added yet -- using custom field keys from first array
            if ( !$headerDisplayed ) {
                fputcsv($fh, $ccsve_generate_value_arr);
                $headerDisplayed = true;
            }
        
            // Put the data from the new multi-dimensional array into the stream
            fputcsv($fh, $data);
        }
        echo $fh;
        // Close the file stream
        fclose($fh);
        /////////////////////////////////////////////////////////////////
        }
        else
        {
            // return false;
            echo "Sorry, No Data based on Filtered Query";
        }
    }
    
}

?>