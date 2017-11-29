	<div class="gal_content">

    	<h2>Image Gallery</h2>

    	<div class="search_gal">
    	  <input type="text" name="textfield" id="textfield" placeholder="Search for image" />
        </div>

  <div class="srch_pic">
  <ul>
            <?php $line=1; for($x=0; $x<sizeof($img_list); $x++){ ?>
        	<li>
            <a href="#w" onclick="setImg('<?php echo $img_list[$x]['thumb']?>');">
                <img src="/upload/media/posts/<?php echo $img_list[$x]['thumb']?>-s.jpg" />
              </a>
          </li>
            <!--li>
              <img src="/upload/media/posts/<?php echo $img_list[$x]['thumb']?>-s.jpg" />
            </li-->
            <?php $line++; }?>
            <!--li><a href="#"><img src="images/test_img.jpg" /></a></li>
            <li><a href="#"><img src="images/test_img.jpg" /></a></li>
            <li><a href="#"><img src="images/test_img.jpg" /></a></li>
            <li><a href="#"><img src="images/test_img.jpg" /></a></li>
            <li><a href="#"><img src="images/test_img.jpg" /></a></li>
            <li><a href="#"><img src="images/test_img.jpg" /></a></li>
            <li><a href="#"><img src="images/test_img.jpg" /></a></li>
            <li><a href="#"><img src="images/test_img.jpg" /></a></li>
            <li><a href="#"><img src="images/test_img.jpg" /></a></li-->
        </ul>
        </div>
    </div>

 <script>


	function setImg(m){
	var img = m;
    $('#upwthumb').val('/upload/media/posts/'+img+'-b.jpg');
	$('.cd-input-image').val('/upload/media/posts/'+img+'-b.jpg');


	var pimg = '/upload/media/posts/'+img+'-s.jpg';
	$('.thumbwrapper div').show();
	$('.preview-placeholder').hide();

	$(".imagepr_wrap").html('<img src="'+pimg+'" >');
	$('.close-modal').click();
	}

 </script>
 
