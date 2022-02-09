<?php
    require_once("header.php");
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Uploads</h1>
                </div>
                <div class="container-fluid">
                    <div class="alert alert-primary" role="alert">You can upload your favorite png and jpg here! You know, for safe keeping!</div>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="custom-file">
                                <input name="file" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
                    <script>
                        $('#customFile').on('change',function(){
                            //get the file name
                            var fileName = $(this).val();
                            //replace the "Choose a file" label
                            var cleanFileName = fileName.replace('C:\\fakepath\\', "");
                            $(this).next('.custom-file-label').html(cleanFileName);
                        })
                    </script>

                <?php
                    
                    if (isset($_FILES['file'])) {
                        $uploaddir = '/var/www/uploads/' . session_id() . '/';
                        $path_parts = pathinfo($_FILES['file']['name']);
                        $filename = $path_parts['basename'];
                        $valid_ext = ["jpg", "png"];
                        if(in_array($path_parts['extension'], $valid_ext, true)) {
                            if (!file_exists($uploaddir)) {
                                mkdir($uploaddir, 0755, true);
                            }
                            $uploadfile = $uploaddir . $filename;
                            
                            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                                echo '<div class="alert alert-success" role="alert"> File is valid, and was successfully and securely uploaded.</div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">What did you do... I\'m not mad, I\'m just disappointed...</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert">What did you do... I\'m not mad, I\'m just disappointed...</div>';
                        }
                    }
                ?>
                </div>
                <!-- /.container-fluid -->

<?php
    include_once("footer.php");
?>