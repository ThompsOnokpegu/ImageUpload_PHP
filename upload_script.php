<?php
/*THOMPSON ONOKPEGU - iCode
Custom Designed Functions*/

function UploadFile($file){
    // Check if file was uploaded without errors
    if(isset($_FILES[$file]) && $_FILES[$file]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES[$file]["name"];
        $filetype = $_FILES[$file]["type"];
        $filesize = $_FILES[$file]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        // Verify file size - 15KB maximum
        $maxsize = (105/1000) * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("../upload/". $_FILES[$file]["name"])){
                echo $_FILES[$file]["name"] . " already exists.";
            } else{
                //move file to upload folder
                move_uploaded_file($_FILES[$file]["tmp_name"], "../upload/". $_FILES[$file]["name"]);
                return "../upload/". $_FILES[$file]["name"];//return file path
                echo "Uploaded successfully.";
            }//END ifFileExist
        } else{
            echo "Error: There was a problem uploading your file. Please try again.";
        }//END ifFileAllowed
    } else{
        echo "Error: " . $_FILES[$file]["error"];
    }//END ifUploadWithNoError
}//END UploadFile()
function DisplayFile($dir){// your folder path/file
  //$imgs = glob($dir ."/*.jpg"); // get your image files with .jpg
  //foreach ($imgs As $i) {
  echo "<img src='$dir' width='150' height = '150'>"; //
  //}
}
?>