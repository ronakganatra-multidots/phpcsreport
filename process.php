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

                $wpstandard     = filter_input( INPUT_POST, 'wpstandard', FILTER_SANITIZE_STRING );
                $wpseverity     = filter_input( INPUT_POST, 'wpseverity', FILTER_SANITIZE_STRING );
                $wpreporterr    = filter_input( INPUT_POST, 'wpreporterr', FILTER_SANITIZE_STRING );

                $wpstandard     = ! empty( $wpstandard ) ? $wpstandard : 'wpvipgo';
                $wpseverity     = ! empty( $wpseverity ) ? $wpseverity : 'severity6andplus';
                $wpreporterr    = ! empty( $wpreporterr ) ? $wpreporterr : 'wperr';

                // Set standard
                switch( $wpstandard ) {
                    case 'wpvipgo':
                        $standard = 'WordPress-VIP-Go';
                        break;
                    case 'wpminimum':
                        $standard = 'WordPressVIPMinimum';
                        break;
                    case 'wordpress':
                        $standard = 'WordPress';
                        break;
                    default:
                        $standard = 'WordPress-VIP-Go';
                }

                // Set severity level
                switch( $wpseverity ) {
                    case 'severity6andplus':
                        $level = 6;
                        break;
                    case 'severity5':
                        $level = 5;
                        break;
                    case 'severity4andunder':
                        $level = 4;
                        break;
                    case 'severityall':
                        $level = '';
                        break;
                    default:
                        $level = 6;
                }

                // Set errors and warnings
                $warning_error = '';
                if( ! empty( $level ) ) {
                    if( 'wperr' == $wpreporterr ) {
                        $warning_error .= ' --error-severity=' . $level;
                    } else if( 'wperr' == $wpreporterr ) {
                        $warning_error .= ' --warning-severity=' . $level;
                    } else if( 'wperrandwar' == $wpreporterr ) {
                        $warning_error .= ' --error-severity=' . $level;
                        $warning_error .= ' --warning-severity=' . $level;
                    } else {
                        $warning_error .= ' --error-severity=' . $level;
                    }
                }

                // Create command string
                $command_string = "vendor/bin/phpcs --standard=" . $standard . " " . $destination . $warning_error . " --report=csv --report-file=" . $destination . "/" . $filenoext . ".csv";
                
                $output = shell_exec( $command_string );
                var_dump( $output );
                exit( $command_string );
                // echo '</pre>';
 
                // $result = array(
                //     'status'    => 'success',
                //     'message'   => 'Process has successed..!!'
                // );
                // echo json_encode( $result );
            }
        }
    }
}
exit();