<?php

if( $_FILES['files']['name'] ) {

    $filename   = $_FILES['files']['name'];
    $source     = $_FILES['files']['tmp_name'];
    $type       = $_FILES['files']['type'];
    
    $name       = explode( '.', $filename );
    $flag       = false;

    $accepted_types = array( 'application/zip', 'application/x-zip-compressed', 
    'multipart/x-zip', 'application/x-compressed' );
    foreach( $accepted_types as $mime_type ) {
        if( $mime_type == $type ) {
            $flag = true;
            break;
        }
    }
    
    $continue = strtolower($name[1]) == 'zip' ? true : false;
    if( ! $continue ) {
        $msg = 'Please upload a valid .zip file.';
    }
    
    /* PHP current path */
    $path       = dirname( __FILE__ ) . '/'; 
    $filenoext  = basename( $filename, '.zip' ); 
    $filenoext  = basename( $filenoext, '.ZIP' );
    
    $destination= $path . $filenoext; // target directory
    $myFile     = $path . $filename; // target zip file

    if ( ! is_dir( $destination ) ) {
        mkdir( $destination, 0777 );
    }

    if( move_uploaded_file( $source, $myFile ) ) {
        if( file_exists( $myFile ) ) {
            $zip = new ZipArchive();
            $x = $zip->open( $myFile ); // open the zip file to extract

            if ( $x === true ) {

                $zip->extractTo( $destination ); // place in the directory with same name
                $zip->close();
                unlink( $myFile );

                $command_string = "phpcs --standard=WordPressVIPMinimum " . $destination; // . " --report=csv --report-file=" . $filename . ".csv";
                echo $command_string = "which composer";
                $output = shell_exec( $command_string );
                
                // $output = null;
                // $retval = null;
                // exec( $command_string, $output, $retval );
                // echo '<pre>-----RETVAL-----';
                // print_r( $retval );
                // echo '</pre>';
                echo '<pre>-----OUTPUT-----';
                print_r( $output );
                echo '</pre>';
            }
        }
    }
}
?>
<form method="POST" action="/" enctype="multipart/form-data">
    <label for="files">Select files</label>
    <input type="file" id="files" name="files"><br><br>
    <input type="submit">
</form>