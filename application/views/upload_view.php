<html>
<head>
<title>Upload Form</title>
</head>
<body>

<div>
    <?php 
    echo "NIP: ".$nip.br();
    echo "Encrypt Name: ".$upload_data.br();
    echo "Raw Name: ".$file_name.br();
    echo "Full Path/URL: ".$url_file_encrypted.br();
    echo "File Name: ".$orig_name.br();
    echo "File Type: ".$file_type.br();
    echo "File Path: ".$file_path.br();
    echo "Password: ".$password.br();
    echo "File Size: ".$file_size.br();
    echo "Keterangan: ".$keterangan.br();
    echo "Date: ".$date.br();
    echo "Action: ".$action.br();
        if(isset($upload_data))
        {				
            echo anchor(base_url().'uploads/'.$upload_data,$upload_data);          
        }
    ?>
</div>
</body>
</html>