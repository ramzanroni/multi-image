<?php
include_once('db.php');
$writeDB = DB::connectWriteDB();
$readDB = DB::connectReadDB();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <style>
    .suggested-posts-article {
      background: white;
      -moz-box-shadow: rgba(0, 0, 0, 0.0666) 0 3px 10px;
      -webkit-box-shadow: rgba(0, 0, 0, 0.0666) 0 3px 10px;
      box-shadow: rgba(0, 0, 0, 0.0666) 0 3px 10px;
      display: inline-block;
      margin: 5px;
      width: 23%;
    }

    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    main,
    nav,
    section {
      display: block;
    }

    article,
    aside,
    footer,
    header,
    hgroup,
    main,
    nav,
    section {
      display: block;
    }

    .suggested-posts-articlees {
      display: inline-block;
      width: 49.5%;
    }

    @media screen and (max-width:450px) {
      .suggested-posts-article {

        width: 40% !important;
      }
    }

    .more-photos:after {
      right: 3px !important;
      bottom: 0px !important;
    }

    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    main,
    nav,
    section {
      display: block;
    }

    .posts_article {
      background-color: #333;
      background-position: 50%;
      background-size: cover;
      margin-bottom: 2px;
      padding-bottom: 63.5%;
    }


    @media screen and (max-width:450px) {
      .suggested-posts-article {

        width: 40% !important;
      }
    }

    .more-photos:after {
      right: 3px !important;
      bottom: 0px !important;
    }

    .more-photos {
      cursor: pointer !important;
    }

    .bluess {
      width: 100%;
      margin: 10px;
    }


    .btn-group-sm>.btn,
    .btn-sm {
      padding: .25rem .5rem;
      font-size: .875rem;
      line-height: 1.5;
      border-radius: .2rem;
    }

    .btn-outline-secondary {
      color: #868e96;
      background-color: transparent;
      background-image: none;
      border-color: #868e96;
    }


    .btnxc {
      display: inline-block;
      padding: 0.5rem 0.75rem;
      border: 1px solid #868e96;
      margin: 3px;
      padding: 0.25rem 0.5rem;
      font-size: 1.875rem;
      line-height: 1.5;
      border-radius: 0.2rem;
      /* color: #868e96; */
      position: absolute;
      top: 17px;
      right: 17px;
      color: white !important;
    }

    .rrrr {
      color: red;
      fill: red;
    }

    .rrrr2 {

      background-color: red;

    }

    .datepost {
      margin-top: -15px;
    }

    .anther_ma {
      margin: 1px;
    }



    .set_process {
      margin: 0px 7px 0px 0px;
    }

    .messaf {
      display: none;
    }

    .progress {
      width: 80%;
    }

    .success_msg {
      color: green;
      display: none;
    }

    #post_send {
      margin: 8px 0 8px 0;
    }

    .fa_p {
      margin-right: 20px;
      margin-top: 10px;
      border: 0px;
      z-index: 9999
    }

    .p_run_div {
      margin-top: -7px;
      border-radius: 0px;
      padding: 0px;
      margin-bottom: 8px;
      display: none;
    }

    .btnxc {
      margin-left: 15px;
      cursor: pointer;
    }

    .btnxc_r {
      margin-left: 15px;
      display: none;
    }
  </style>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center">Upload Multiple Images</h2>
        <button class="imgbuts btn btn-success">Browse...</button>
        <form action="method" name="upload-file" class="main_form" id="form-upload-file" enctype="multipart/form-data">
          <div class="ui-block">
            <aside class="suggested-posts">
              <div class="suggested-posts-container">
                <div class="row" id="message_box"></div>
              </div>
            </aside>
          </div>
        </form>
        <button class="btn btn-primary btn-md-2 " id='post_send' onclick="save_muliple_image()">Upload</button>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width:0%">
            <span class="sr-only">0</span>
          </div>
        </div>
        <h2 class="success_msg">File has uploaded successfully!</h2>
      </div>
      <div class="col-md-12" id="imageDiv">
        <p>Uploaded Image</p>
        <?php
        $imageData = $readDB->prepare('SELECT * FROM `item_ref_file`');
        $imageData->execute();
        while ($row = $imageData->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <article style="position: relative;" id="art_<?php echo $row['id']; ?>" class="suggested-posts-article remove_artical1">
            <div class="posts_article" style="background-image: url(<?php echo $row['doc_name']; ?>); background-size: cover;margin: 20px;border: 1px solid rgba(0, 0, 0, 0.3);background-position: center;">

            </div>
            <span onclick="deleteImage(<?php echo $row['id']; ?>, '<?php echo $row['doc_name']; ?>')" class="btn btn-danger btnxc" deltsid="0"><i class="fas fa-trash text-white"></i></span>
          </article>
        <?php
        }

        ?>

      </div>
    </div>
  </div>
  <script>
    var xp = 0;
    var input_btn = 0;
    var dts = [];
    $(document).on("click", ".imgbuts", function(e) {
      input_btn++;
      $("#form-upload-file").append(
        "<input type='file' style='display:none;' name='upload_files[]' id='filenumber" +
        input_btn +
        "' class='img_file upload_files' accept='.gif,.jpg,.jpeg,.png,' multiple/>"
      );
      $("#filenumber" + input_btn).click();
    });

    $(document).on("change", ".upload_files", function(e) {
      files = e.target.files;
      filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        xp++;
        var f = files[i];
        var res_ext = files[i].name.split(".");
        var img_or_video = res_ext[res_ext.length - 1];
        var fileReader = new FileReader();
        fileReader.name = f.name;
        fileReader.onload = function(e) {
          var file = e.target;
          $("#message_box").append(
            "<article style='position: relative;' class='suggested-posts-article remove_artical" +
            xp +
            "' data-file='" +
            file.name +
            "'><div class='posts_article background_v" +
            xp +
            "' style='background-image: url(" +
            e.target.result +
            "); background-size: cover;margin: 20px;border: 1px solid rgba(0, 0, 0, 0.3);background-position: center;'></div><div class='p_run_div'><span class='pp_run progress_run" +
            xp +
            "' style='opacity: 1;'></span></div><p class='fa_p p_for_fa" +
            xp +
            "'><span class='btn btn-danger cancel_mutile_image btnxc cancel_fa" +
            xp +
            "' deltsid='" + 0 + "'><i class='fas fa-trash text-white'></i></span><span class='btnxc btnxc_r btn btn-success'><i class='fas fa-check-circle text-white'></i></span></p></article>"
          );
        };
        fileReader.readAsDataURL(f);
      }

    });


    function save_muliple_image() {
      suggested = $(".suggested-posts-article").length;
      if (suggested > 0) {
        $(".cancel_mutile_image").prop("disabled", true);
        $("#post_send").prop("disabled", true);
        var formData = new FormData(document.getElementById("form-upload-file"));
        formData.append("dts", dts);
        var xhr = new window.XMLHttpRequest();
        $.ajax({
          url: 'upload_ajax.php',
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(data) {
            console.log(data);
            $(".main-content").find(".message-loading-overlay2").remove();
            const myTimeout = setTimeout(myGreeting, 3000);

            function myGreeting() {
              location.reload();
            }
          },
          error: function(e) {
            $("#preview_file_div ul").html(
              "<li class='text-danger'>Something wrong! Please try again.</li>"
            );
          },
          xhr: function(e) {
            xhr.upload.addEventListener(
              "progress",
              function(e) {
                // console.log(e);
                if (e.lengthComputable) {
                  var percentComplete = ((e.loaded || e.position) * 100) / e.total;
                  if (percentComplete == 100) {
                    $(".progress-bar").width(percentComplete + "%").html('99' + "%");
                  } else {
                    $(".progress-bar").width(percentComplete + "%").html(percentComplete + "%");
                  }
                }
              },
              false
            );
            xhr.addEventListener("load", function(e) {
              $('.progress-bar').css("background", "#5cb85c").html('100' + "%");
              $(".btnxc_r").show();
              $(".success_msg").show();
              $(".cancel_mutile_image").remove();
            });
            return xhr;

          },
        });
      } else {
        $(".messaf").show();
      }
    }
    var rty = 0;
    $(document).on("click", ".cancel_mutile_image", function(e) {
      $('.cancel_mutile_image').each(function() {
        chk_id = $(this).attr('deltsid');
        if (chk_id == 0) {
          rty++;
          $(this).attr('deltsid', rty);
        }
      });
      deltsid = $(this).attr('deltsid');
      dts.push(deltsid);
      $(this).parents(".suggested-posts-article").remove();
    });

    function deleteImage(imageID, imageName) {
      const check = "deleteImage";
      let arID = 'art_' + imageID;
      $.ajax({
        url: "image-action.php",
        type: "POST",
        data: {
          imageID: imageID,
          imageName: imageName,
          check: check
        },
        success: function(response) {
          console.log(response);

          if (response == 'success') {
            console.log(response);
            let element = document.getElementById(arID);
            console.log(element);
            $("#imageDiv").load(" #imageDiv");
            $("#imageDiv").load(" #imageDiv > *");
          }
        }
      });
    }
  </script>
</body>

</html>