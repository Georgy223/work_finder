<?php
function fileUpload($img_name)
{

    if (isset($_FILES[$img_name])) {
        $errors = array();
        $file_name = $_FILES[$img_name]['name'];
        $file_size = $_FILES[$img_name]['size'];
        $file_tmp = $_FILES[$img_name]['tmp_name'];
        $file_type = $_FILES[$img_name]['type'];
        $array = explode('.', $_FILES[$img_name]['name']);
        $file_ext = strtolower(end($array));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 4194304 ) {
            $errors[] = 'File size must be excately 4 MB';
        }

        if (empty($errors) == true) {
            $name = uniqid().'.'.$file_ext;
            move_uploaded_file($file_tmp, "profiles/" . $name);
            echo "Success";

            return $name;

        } else {
            print_r($errors);
        }
    }
    return null;
}