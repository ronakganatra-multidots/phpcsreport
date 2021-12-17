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

    $continue = strtolower( $name[1] ) == 'zip' ? true : false;
    if( ! $continue ) {
        $result = array(
            'status'    => 'error',
            'message'   => 'Please upload a valid .zip file.'
        );
        echo json_encode( $result );
        die();
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

                // $command_string = "phpcs --standard=WordPressVIPMinimum " . $destination; // . " --report=csv --report-file=" . $filename . ".csv";
                
                $output = shell_exec( 'vendor/bin/phpcs -i' );
                echo '<pre>-----PHPCS OUTPUT-----';
                print_r( $output );
                echo '</pre>';
 
                // $result = array(
                //     'status'    => 'success',
                //     'message'   => 'Process has successed..!!'
                // );
                // echo json_encode( $result );
            }
        }
    }
}
die();