<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>PHPCS Report</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="assets/img/favicon.png"
    />
    <!-- Place favicon.ico in the root directory -->

    <!-- ======== CSS here ======== -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type='text/css' media='all' />
    <link rel="stylesheet" href="assets/css/animate.css" type='text/css' media='all' />
    <link rel="stylesheet" href="assets/css/main.css" type='text/css' media='all' />
  </head>
  <body>

    <!-- ======== preloader start ======== -->
    <div class="preloader">
      <div class="loader">
        <div class="spinner">
          <div class="spinner-container">
            <div class="spinner-rotator">
              <div class="spinner-left">
                <div class="spinner-circle"></div>
              </div>
              <div class="spinner-right">
                <div class="spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
      <div class="container">
        <div class="row align-items-center position-relative">
          <div class="col-lg-6">
            <div class="hero-content">
              <h1 class="wow fadeInUp" data-wow-delay=".4s">
                PHPCS Report
              </h1>
              <p class="wow fadeInUp" data-wow-delay=".6s">
                PHPCS is a PHP5 script that tokenises PHP, JavaScript and CSS files to detect violations of a defined coding standard. It is an essential development tool that ensures your code remains clean and consistent. It can also help prevent some common semantic errors made by developers.
              </p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
              <img src="assets/img/hero/hero-img.png" alt="" />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== hero-section end ======== -->

    <!-- ======== phpcs-section start ======== -->
    <section id="critical" class="phpcs-section pt-120">
      <div class="container">
        <div class="phpcs-wrapper img-bg">
          <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
            <form enctype="multipart/form-data" class="phpcs-report-form" method="post" action="process.php">
                <label class="title">Upload File (.zip) :</label>

                <div class="file-upload-section">
                    <input type="file" id="actual-btn" name="files" hidden/>

                    <!-- our custom upload button -->
                    <label class="choose-file" for="actual-btn">Choose File</label>

                    <!-- name of file chosen -->
                    <span id="file-chosen" class="file-chosen">No file chosen</span>
                </div>

                <div class="phpcs_dropdown">
                    <label for="wpstandard">Choose Report Standard:</label>
                    <select name="wpstandard" id="wpstandard">
                        <option value="wpvipgo">WordPress-VIP-Go</option>
                        <option value="wpminimum">WordPressVIPMinimum</option>
                        <option value="wordpress">WordPress</option>
                    </select>
                </div>    
                <div class="phpcs_dropdown">
                    <label for="wpseverity">Choose Report Severity:</label>
                    <select name="wpseverity" id="wpseverity">
                    <option value="severityall">All</option>
                    <option value="severity6andplus">Severity level 6 and above</option>
                    <option value="severity5">Severity level 5</option>
                    <option value="severity4andunder">Severity level 4 and under</option>
                    </select>
                </div>
                <div class="phpcs_dropdown">
                    <label for="wpreporterr">Choose Report Errors and Warnings:</label>
                    <select name="wpreporterr" id="wpreporterr">
                    <option value="wperrandwar">All</option>
                    <option value="wperr">Errors</option>
                    <option value="wpwar">Warnings</option>
                    </select>
                </div>    

                <button type="submit" class="main-btn btn-hover main-btn-submit">
                  Generate Report
                </button>
                
                <div class="msg"></div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== critical-section end ======== -->

    <!-- ======== footer start ======== -->
    <footer class="footer">
      <div class="container">
        <div class="widget-wrapper">
        </div>
      </div>
    </footer>
    <!-- ======== footer end ======== -->


    <!-- ======== JS here ======== -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/wow.min.js" defer></script>
    <script src="assets/js/main.js" defer></script>

    <script type="text/javascript">
        const actualBtn = document.getElementById('actual-btn');
        const fileChosen = document.getElementById('file-chosen');
        actualBtn.addEventListener('change', function(){
            fileChosen.textContent = this.files[0].name
        })
    </script>

  </body>
</html>