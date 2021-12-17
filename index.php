<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Upload and unzip file in webserver</title>
        <link rel='stylesheet' href='assets/css/style.css' type='text/css' media='all' />
    </head> 
    <body>
        <div class="box">
            <div class="heading">Upload File and Unzip</div>
            <div class="msg"><?php if($myMsg) echo "<p>$myMsg</p>"; ?></div>
            <div class="form_field">
                <form enctype="multipart/form-data" method="post" action="process.php">
                <label>Upload Zip File: </label> <input type="file" name="files">
                <br><br>
                
                    <label for="wpstandard">Choose Report standard:</label>
                    <select name="wpstandard" id="wpstandard">
                    <option value="wpminimum">WordPressVIPMinimum</option>
                    <option value="wpvipgo">WordPress-VIP-Go</option>
                    <option value="wordpress">WordPress</option>
                    </select><br><br>
                    <label for="wpseverity">Choose Report Severity:</label>
                    <select name="wpseverity" id="wpseverity">
                    <option value="severity6andplus">Severity level 6 and above</option>
                    <option value="severity5">Severity level 5</option>
                    <option value="severity4andunder">Severity level 4 and under</option>
                    <option value="severityall">All</option>
                    </select><br><br>
                    <label for="wpreporterr">Choose Report Errors and Warnings:</label>
                    <select name="wpreporterr" id="wpreporterr">
                    <option value="wperr">Errors</option>
                    <option value="wpwar">Warnings</option>
                    <option value="wperrandwar">Both</option>
                    </select><br><br>
                    <input type="submit" id="submit" name="submit" value="Upload" class="upload"> <br><br>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript" src="main.js" defer></script>
    </body>
</html>