<!doctype html>
<html lang="en">
   <head>
      <title>Title</title>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
      <?php  //$this->load->view('comman/carousalcss'); ?>
   
      <style>
      .scrolling-wrapper {
      overflow-x: scroll;
      overflow-y: hidden;
      white-space: nowrap;
      }
      scrolling-wrapper {
      -webkit-overflow-scrolling: touch;
      }
      .text-menu{
      padding: 35px 10px 20px 10px;
      text-align: center;
      text-overflow: ellipsis;
      overflow:hidden
      }
      .box{
      position: relative;
      display: inline-block; /* Make the width of box same as image */
      }
      .box .text{
      position: absolute;
      z-index: 999;
      margin: 0 auto;
      left: 0;
      right: 0;
      text-align: center;
      top: 60%; /* Adjust this value to move the positioned div up and down */
      background: rgba(0, 0, 0, 0.3);
      font-family: Arial,sans-serif;
      color: #fff;
      width: 60%; /* Set the width of the positioned div */
      }
      .adj-img{
      max-height: 160px;
      max-width: 560px;
      }
      .adj-img1{
        max-width: 100%;
        max-height: 150px;
        border-radius: .2rem;
      }
      @media screen and (max-width: 402px){
      .adj-img1{
        max-width: 100%;
        max-height: 150px;
        border-radius: .2rem;
      }
      }
      .image-container{text-align:center}
      .add-btn{
      background-color: #DC2265;
      border: none;
      color: white;
      padding: 8px 30px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      }
      .dish-title{
      float:right;
      padding:10px;
      font-size: 15px;
      }
    .qty .count {
        color: #000;
        display: inline-block;
        vertical-align: top;
        font-size: 18px;
        font-weight: 700;
        line-height: 20px;
        padding: 0 2px;
        min-width: 35px;
        text-align: center;
    }
    .qty .plus {
        cursor: pointer;
        display: inline-block;
        vertical-align: top;
        color: white;
        width: 20px;
        height: 20px;
        font: 20px/1 Arial,sans-serif;
        text-align: center;
        border-radius: 50%;
        }
    .qty .minus {
        cursor: pointer;
        display: inline-block;
        vertical-align: top;
        color: white;
        width: 20px;
        height: 20px;
        font: 20px/1 Arial,sans-serif;
        text-align: center;
        border-radius: 50%;
        background-clip: padding-box;
    }
    div {
        text-align: center;
    }
    .minus:hover{
        background-color: #717fe0 !important;
    }
    .plus:hover{
        background-color: #717fe0 !important;
    }
    /*Prevent text selection*/
    span{
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    input{  
        border: 0;
        width: 2%;
    }
    nput::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input:disabled{
        background-color:white;
    }
             
   </style>
   </head>
   <body>
      <div style="padding:20px">
         <a href="index.html" class="add-btn"><i class="fa fa-3x fa-reply" style="color:white"></i></a>
      </div>
      <!--<div class="container">
        <div class="row">
            <div class="col">
                <div class="owl-carousel-menu owl-theme">
                    <div class="item">
                        <a href="#1">
                            <div class="box">
                               <img class="adj-img" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
                               <div class="text">
                                  <h5>MENU 1</h5>
                               </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#2">
                            <div class="box">
                               <img class="adj-img" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
                               <div class="text">
                                  <h5>MENU 2</h5>
                               </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                      <h4>3</h4>
                    </div>
                    <div class="item">
                      <h4>4</h4>
                    </div>
                    <div class="item">
                      <h4>5</h4>
                    </div>
                    <div class="item">
                      <h4>6</h4>
                    </div>
                    <div class="item">
                      <h4>7</h4>
                    </div>
                    <div class="item">
                      <h4>8</h4>
                    </div>
                    <div class="item">
                      <h4>9</h4>
                    </div>
                    <div class="item">
                      <h4>10</h4>
                    </div>
                    <div class="item">
                      <h4>11</h4>
                    </div>
                    <div class="item">
                      <h4>12</h4>
                    </div>
                  </div>
            </div>
        </div>
      </div>-->
      <div class="scrolling-wrapper">
      <?php $ci=&get_instance(); $menuLists=$ci->get_user_menus(19); 
      if(!empty($menuLists)) { $i=0;
        foreach($menuLists as $menuList) :
      ?>
             &nbsp;
             <!-- for loop -->
             <a href="#<?= ++$i ?>">
                <div class="box">
                   <img class="adj-img img-responsive" src="<?= $menuList->image?>" alt="Flying Kites">
                   <div class="text">
                      <h5><?= $menuList->title?></h5>
                   </div>
                </div>
             </a>
      <?php endforeach; } ?>
         
         <!--<a href="#2">
            <div class="box">
               <img class="adj-img img-responsive" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
               <div class="text">
                  <h5>MENU 2</h5>
               </div>
            </div>
         </a>
         <a href="#3">
            <div class="box">
               <img class="adj-img" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
               <div class="text">
                  <h5>MENU 3</h5>
               </div>
            </div>
            &nbsp;
         </a>
         <a href="#4">
            <div class="box">
               <img class="adj-img" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
               <div class="text">
                  <h5>MENU 4</h5>
               </div>
            </div>
            &nbsp;
         </a>
         <a href="#5">
            <div class="box">
               <img class="adj-img" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
               <div class="text">
                  <h5>MENU 5</h5>
               </div>
            </div>
            &nbsp;
         </a>
         <a href="#6">
            <div class="box">
               <img class="adj-img" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
               <div class="text">
                  <h5>MENU 6</h5>
               </div>
            </div>
            &nbsp;
         </a>
         <a href="#7">
            <div class="box">
               <img class="adj-img" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
               <div class="text">
                  <h5>MENU 7</h5>
               </div>
            </div>
            &nbsp;
         </a>
         <a href="#8">
            <div class="box">
               <img class="adj-img" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
               <div class="text">
                  <h5>MENU 8</h5>
               </div>
            </div>
            &nbsp;
         </a>
         <a href="#9">
            <div class="box">
               <img class="adj-img" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
               <div class="text">
                  <h5>MENU 9</h5>
               </div>
            </div>
         </a>-->
        
      </div>
      <div class="container">
         <br/>
         <div id="1">
            <h2 class = "text-center"> Menu 1</h2>
         </div>
         <br/>
         <div class="card">
            <div class="row">
               <div class="col">
                  <div class="box">
                     <img class="adj-img1" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
                  </div>
               </div>
               <div class="col">
                  <div class="row">
                     <div class="col">
                        <h4 style="padding-top: 8px; padding-bottom: 0;">Chicken Dish</h4>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <div style="">
                            <div class="qty" style="margin: 4px 0 10px;">
                                <span class="minus bg-dark">-</span>
                                <input type="number" class="count" name="qty" value="1">
                                <span class="plus bg-dark">+</span>
                            </div>
                            <b>$200</b>&nbsp;&nbsp;&nbsp;
                           <button class="resp-btn add-btn" >ADD</b>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <br/>
         <div id="2">
            <h2 class = "text-center"> Menu 2</h2>
         </div>
         <br/>
         <div class="card">
            <div class="row">
               <div class="col">
                  <div class="box">
                     <img class="adj-img1" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
                  </div>
               </div>
               <div class="col">
                  <div class="row">
                     <div class="col">
                        <h3 style="float:right;padding:15px">Chicken Dish</h3>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <div style="float:right; padding:10px">
                           <b>$200</b>&nbsp;&nbsp;&nbsp;
                           <button class="resp-btn add-btn" >ADD</b>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <br/>
         <div class="card">
            <div class="row">
               <div class="col">
                  <div class="box">
                     <img class="adj-img1" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
                  </div>
               </div>
               <div class="col">
                  <div class="row">
                     <div class="col">
                        <h3 style="float:right;padding:15px">Chicken Dish</h3>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <div style="float:right; padding:10px">
                           <b>$200</b>&nbsp;&nbsp;&nbsp;
                           <button class="resp-btn add-btn" >ADD</b>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <br/>
         <br/>
         <div id="3">
            <h2 class = "text-center"> Menu 3</h2>
         </div>
         <br/>
         <div class="card">
            <div class="row">
               <div class="col">
                  <div class="box">
                     <img class="adj-img1" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
                  </div>
               </div>
               <div class="col">
                  <div class="row">
                     <div class="col">
                        <h3 style="float:right;padding:15px">Chicken Dish</h3>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <div style="float:right; padding:10px">
                           <b>$200</b>&nbsp;&nbsp;&nbsp;
                           <button class="resp-btn add-btn" >ADD</b>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <br/>
         <div class="card">
            <div class="row">
               <div class="col">
                  <div class="box">
                     <img class="adj-img1" src="assets/img/dish_img/chicken.jpeg" alt="Flying Kites">
                  </div>
               </div>
               <div class="col">
                  <div class="row">
                     <div class="col">
                        <h3 style="float:right;padding:15px">Chicken Dish</h3>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <div style="float:right; padding:10px">
                           <b>$200</b>&nbsp;&nbsp;&nbsp;
                           <button class="resp-btn add-btn" >ADD</b>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <br/>
      </div>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <?php //$this->load->view('comman/carousaljs'); ?>
      <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>-->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
      <script>
        $(document).ready(function(){
		    $('.count').prop('disabled', true);
   			$(document).on('click','.plus',function(){
				$('.count').val(parseInt($('.count').val()) + 1 );
    		});
        	$(document).on('click','.minus',function(){
    			$('.count').val(parseInt($('.count').val()) - 1 );
				if ($('.count').val() == 0) {
					$('.count').val(1);
				}
	    	});
	    	
	   // 	$('.owl-carousel-menu').owlCarousel({
    //             loop: true,
    //             margin: 10,
    //             responsiveClass: true,
    //             responsive: {
    //               320: {
    //                 items: 2,
    //                 nav: true
    //               },
    //               480 : {
    //                 items: 2,
    //                 nav: false
    //               },
    //               768 : {
    //                 items: 3,
    //                 nav: false
    //               },
    //               1000: {
    //                 items: 4,
    //                 nav: true
    //               }
    //             }
    //         });
 	    });
      </script>
   </body>
</html>