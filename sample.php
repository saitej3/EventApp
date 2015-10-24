<?php

error_reporting( E_ALL ^ ( E_NOTICE | E_WARNING | E_DEPRECATED ) );

$con = mysql_connect("localhost", "root", "") or die(mysql_error());
        mysql_select_db("event") or die(mysql_error());


  function registerEvent($name,$description,$date,$time,$contact_name_1,$contact_no_1,$contact_name_2,$contact_no_2,$Image,$requirements,$notes)
    {
        echo $notes;
        $uuid=uniqid('',true);
        //mysql_query("insert into events(id,name,description,date,time,contact_name_1,contact_name_1) values('sai','good','12','')")
        $result=mysql_query("INSERT INTO events(name,description,date,time,contact_name_1,contact_name_2,contact_no_1,contact_no_2,Image,requirements,notes) VALUES('sai','$description','$date','$time','$contact_name_1','$contact_name_2',$contact_no_1,$contact_no_2,'$Image','$requirements','$notes')");
        echo $result;
        echo $result ;
        if($result)
        {
        	return true;
        }
        else
            return false;
    }


if (isset($_POST['ev_name']) && $_POST['ev_name'] != '' &&isset($_POST['ev_desc']) && $_POST['ev_desc'] != ''&&isset($_POST['ev_datetime']) && $_POST['ev_datetime'] != ''&&isset($_POST['ev_cname1']) && $_POST['ev_cname1'] != ''&&isset($_POST['ev_cno1']) && $_POST['ev_cno1'] != '') 
{
    
        $name=$_POST['ev_name'];
        $description=$_POST['ev_desc'];
        $datetime=$_POST['ev_datetime'];
        $a=explode(" ", $datetime);
        $date=$a[0];
        $time=$a[1];
        $contact_name_1=$_POST['ev_cname1'];
        $contact_no_1=$_POST['ev_cno1'];
        $contact_name_2=$_POST['ev_cname2'];
        $contact_no_2=$_POST['ev_cno2'];
        $requirements=$_POST['ev_req'];
    
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            strtolower($imageFileType);

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an sds image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
            //  {
            //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            //     $uploadOk = 0;
            // }
            // Check if $uploadOk is set to 0 by an error

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {;
                    //echo "Sorry, there was an error uploading your files.";
                }
            }

            //$target_file="uploads/image1.jpg";
            $notes="hello";

            $event =registerEvent($name,$description,$date,$time,$contact_name_1,$contact_no_1,$contact_name_2,$contact_no_2,$target_file,$requirements,$notes);
            echo $event;
            if ($event) {
                
                echo "success in adding event";
            }

            else;
                //echo "Error in adding the event"; 
} 
else {
   echo "Error";
}






            mysql_close();
       


?>