<?php

/**
 * Template Name: Single
 * Description: The NAW+ Community - Gear Category
 *
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * **********************************************************************
 */



if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

get_header();
imo_sidebar("community");

$displayStyle = "display:none;";
$loginStyle = "";

include 'common-templates.php';

if ( is_user_logged_in() ) {

	$displayStyle = "";
	$loginStyle = "display:none;";

	wp_get_current_user();

	$current_user = wp_get_current_user();
    if ( !($current_user instanceof WP_User) )
         return;
 }

$hostname = $_SERVER['SERVER_NAME'];

$spid =  get_query_var("spid");

$apiURL = "http://$hostname/community-api/posts/$spid?get_comments=1";



$file = file_get_contents($apiURL);

//SET TEMPLATE VARIABLES
$data = json_decode($file);
$attachmentData = $data->attachments;
$commentData = $data->comments;




if (empty($commentData)) {


    $visible = " style='display:none;'";
}



$grav_url = "http://www.gravatar.com/avatar/" . $data->gravatar_hash . ".jpg?s=50&d=identicon";

$headerTitle = $data->post_type . ": " . $data->title;

$displayStyle = "display:none;";
$loginStyle = "";

if ( is_user_logged_in() ) {

	$displayStyle = "";
	$loginStyle = "display:none;";

	wp_get_current_user();

	$current_user = wp_get_current_user();
    if ( !($current_user instanceof WP_User) )
         return;
    }


// get the score of the post's author
$requestURL4 = "http://$hostname/slim/api/superpost/user/score/".$data->user_id;
$file4 = file_get_contents($requestURL4);
$post_user_score = json_decode($file4);
$post_user_score = $post_user_score[0];


if (empty($data->display_name)) {
	$data->display_name = $data->username;
}

//get post user email

$postUserData = get_userdata( $data->user_id );
$postUserEmail = $postUserData->user_email;

$state_slug = $data->state;

// convert some slugs
$stateSlugToAbbv = array("AL"=>"Alabama",
"AK"=>"Alaska",
"AZ"=>"Arizona",
"AR"=>"Arkansas",
"CA"=>"California",
"CO"=>"Colorado",
"CT"=>"Connecticut",
"DE"=>"Delaware",
"DC"=>"District Of Columbia",
"FL"=>"Florida",
"GA"=>"Georgia",
"HI"=>"Hawaii",
"ID"=>"Idaho",
"IL"=>"Illinois",
"IN"=>"Indiana",
"IA"=>"Iowa",
"KS"=>"Kansas",
"KY"=>"Kentucky",
"LA"=>"Louisiana",
"ME"=>"Maine",
"MD"=>"Maryland",
"MA"=>"Massachusetts",
"MI"=>"Michigan",
"MN"=>"Minnesota",
"MS"=>"Mississippi",
"MO"=>"Missouri",
"MT"=>"Montana",
"NE"=>"Nebraska",
"NV"=>"Nevada",
"NH"=>"New Hampshire",
"NJ"=>"New Jersey",
"NM"=>"New Mexico",
"NY"=>"New York",
"NC"=>"North Carolina",
"ND"=>"North Dakota",
"OH"=>"Ohio",
"OK"=>"Oklahoma",
"OR"=>"Oregon",
"PA"=>"Pennsylvania",
"RI"=>"Rhode Island",
"SC"=>"South Carolina",
"SD"=>"South Dakota",
"TN"=>"Tennessee",
"TX"=>"Texas",
"UT"=>"Utah",
"VT"=>"Vermont",
"VA"=>"Virginia",
"WA"=>"Washington",
"WV"=>"West Virginia",
"WI"=>"Wisconsin",
"WY"=>"Wyoming",
"AB"=>"Alberta",
"BC"=>"British Columbia",
"MB"=>"Manitoba",
"NB"=>"New Brunswick",
"NL"=>"Newfoundland and Labrador",
"NT"=>"Northwest Territories",
"NS"=>"Nova Scotia",
"NU"=>"Nunavut",
"ON"=>"Ontario",
"PE"=>"Prince Edward Island",
"QC"=>"Quebec",
"SK"=>"Saskatchewan",
"YT"=>"Yukon");

$state = $stateSlugToAbbv[$state_slug];

if ($state == 'New York'){
	$state_slug = 'new-york';
}else if ($state == 'Rhode Island'){
	$state_slug = 'rhode-island';
}else if ($state == 'South Carolina'){
	$state_slug = 'south-carolina';
}else if ($state == 'South Dakota'){
	$state_slug = 'south-dakota';
}else if ($state == 'New Hampshire'){
	$state_slug = 'new-hampshire';
}else if ($state == 'New Jersey'){
	$state_slug = 'new-jersey';
}else if ($state == 'New Mexico'){
	$state_slug = 'new-mexico';
}else if ($state == 'North Carolina'){
	$state_slug = 'north-carolina';
}else if ($state == 'North Dakota'){
	$state_slug = 'north-dakota';
}else if ($state == 'New Brunswick'){
	$state_slug = 'new-brunswick';
}else if ($state == 'Newfoundland and Labrador'){
	$state_slug = 'newfoundland-and-labrador';
}else if ($state == 'Northwest Territories'){
	$state_slug = 'northwest-territories';
}else if ($state == 'Nova Scotia'){
	$state_slug = 'nova-scotia';
}else if ($state == 'Prince Edward Island'){
	$state_slug = 'prince-edward-island';
}else{
	$state_slug = $state;
}


if($data->score == 1){
	$niceScore = $data->score.' Point';
}else{
	$niceScore = $data->score.' Points';
}

if($data->view_count == 1){
	$niceView = $data->view_count.' View';
}else{
	$niceView = $data->view_count.' Views';
}

if($data->comment_count == 1){
	$niceComment = $data->comment_count.' Reply';
}else{
	$niceComment = $data->comment_count.' Replies';
}

// Get the timestamp
$timestamp = $data->created;

// Convert the timestamp
$date = date("F j, Y", strtotime($timestamp));
$time = date("g:i A", strtotime($timestamp));


if($data->post_type == "report"){
	$postType = "Rut Report";
}else if($data->post_type == "general"){
	$postType = "General Discussion";
}else if($data->post_type == "question"){
	$postType = "question";
}
?>

<!-- Don't delete this. It's part of imo-add-this -->
<div id="imo-add-this-spid" style="display:none;"><?php echo $spid; ?></div>

<div class="general general-com">
	<ul class="breadcrumbs">
    	<li><a href="/community">NAW+ Community</a></li>
    	<li style="margin-top:1px;text-transform:capitalize;">&raquo; <?php echo $postType; ?></li>
    </ul>
    <div class="dif-full-post">
        <h1><?php echo $data->title; ?></h1>
        <div class="profile-panel">
            <div class="profile-photo">
                <a href="/profile/<?php echo $data->username; ?>"><img src="/avatar?uid=<?php echo $data->user_id; ?>" alt="<?php echo $data->username; ?>" /></a>
            </div>
            <div class="profile-data">
                <h4><a href="/profile/<?php echo $data->username; ?>"><?php echo $data->display_name; ?></a></h4>
                <ul class="prof-tags">
                    <?php if($state){ ?><li><a href="/community/<?php echo $data->post_type . '/' . strtolower($state_slug); ?>"><?php echo $state ?></a></li><?php } ?>
                    <li><a href="/community/<?php echo $data->post_type; ?>" style="text-transform:capitalize;"><?php echo $postType; ?></a></li>
                </ul>
                <div class="clearfix"></div>
                    <ul class="replies">
                        <li><?php echo $date; ?> at <?php echo $time; ?><div class="bullet"></li>
                        <li><a href="#reply_field"><?php echo $niceComment; ?></a></li>
                        <li><?php echo $niceScore; ?><div class="bullet"></div></li>
                        <li><?php echo $niceView; ?></li>
                    </ul>

                </div>
            </div>

		<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup(); } ?>

        <?php
        if( strpos($data->img_url,'filepicker') ){
			$width = "/convert?w=730&fit=scale&rotate=exif";

            $width = "";

        	if(mobile()){
        		$width = "/convert?w=478";
        	}

             $media = "";
            $media = "<div class='full-post-img'><img src='$data->img_url$width'></div>";

            echo $media;

		}else{

            foreach ($attachmentData as $attachment) {
                $media = "";
                $caption = "";

                if ($attachment->post_type == "youtube") {

                    $videoID = $attachment->meta;
                    $media = "<div class='full-post-img'>";
                    $media .= '<iframe width="640" height="480" src="http://www.youtube.com/embed/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
                    $media .= "</div>$caption";

                } else {

                    $photoURL = str_replace("thumb", "medium", $attachment->img_url);
                    $media = "<div class='full-post-img'><img src='$photoURL'></div>$caption";

                }


                echo $media;

            }
		}



        if ($data->master) { ?>
	        <div class="manametitle">
	            <div class="maname"><span class="firstname"><?php echo $data->first_name; ?></span> <span class="lastname"><?php echo $data->last_name; ?></span></div>
	            <div class="macity"><?php echo $data->nearest_town; ?>, <?php echo $data->state; ?></div>
	        </div>

       <?php }//end if ?>



			<div class='full-text'>

				<?php if($data->body){ ?>
	            	<p><?php echo $data->body; ?></p>


	            <?php } ?>
				<div class="clearfix">
                <a href="#reply_field" class="post-it">Post a Reply</a>

                <?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup(); } ?>
            </div>
        </div>
        <div class="photo-link-area">
            <div class="fileupload-buttonbar ">
                <label class="upload-button share-photo">
                    <a href="/community/new/"><span class="add-photo-link">Share Your Photo</span></a>
                    <input id="image-upload" class="common-image-upload" type="file" name="photo-upload">
                </label>
            </div>
        </div>

    </div>
    <!--<div class="custom-slider-section mobile-hidden-section">
        <div class="general-title clearfix">
            <h2><span>Explore  more</span></h2>
        </div>
        <img src="<?php bloginfo( 'template_url' ); ?>/images/pic/slider-screen.jpg" alt="" />
    </div>
    <div class="explore-more-mobile">
        <div class="general-title clearfix">
            <h2><span>Explore</span></h2>
            <div class="select-it jq-custom-form">
                <select id="sort-posts" class="sel">
                    <option value="0">Sort posts by</option>
                    <option value="1">post 1</option>
                    <option value="2">post 2</option>
                    <option value="3">post 3</option>
                    <option value="4">post 4</option>
                    <option value="5">post 5</option>
                    <option value="6">post 6</option>
                    <option value="7">post 7</option>
                </select>
            </div>
        </div>
        <div class="explore-posts loading-block">
            <div class="jq-explore-slider onload-hidden">
                <ul class="slides">
                    <li><a href="#"><img width="119" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic1.jpg" alt="" /></a></li>
                    <li><a href="#"><img width="119" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic2.jpg" alt="" /></a></li>
                    <li><a href="#"><img width="119" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic3.jpg" alt="" /></a></li>
                    <li><a href="#"><img width="119" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic4.jpg" alt="" /></a></li>
                </ul>
            </div>
        </div>

    </div>-->
    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="js-responsive-section">
    	<div class="custom-slider-section">
    		<?php //echo do_shortcode('[imo-slideshow community=true]'); ?>
    	</div>
    </div>

    <div class="replies-box">
        <h2>What's Your Take?</h2>

        <ul class="replies-list">

        	<?php foreach ($commentData as $comment) {
				// get the score of the users in the replies
				$userscoreURL = "http://$hostname/slim/api/superpost/user/score/".$comment->user_id;
				$file5 = file_get_contents($userscoreURL);
				$comment_user_score = json_decode($file5);
				$comment_user_score = $comment_user_score[0];
				if($comment_user_score->score == 1){
					$niceScore = $comment_user_score->score.' Point';
				}else{
					$niceScore = $comment_user_score->score.' Points';
				} ?>


		        <li<?php echo $visible; ?>>
		            <div class="profile-photo">
		                 <a href="/profile/<?php echo $comment->username; ?>"><img src="/avatar?uid=<?php echo $comment->user_id; ?>" alt="<?php echo $comment->display_name; ?>"></a>
		            </div>
		            <div class="reply-text">
		                <h3><a href="/profile/<?php echo $comment->username; ?>"><?php echo $comment->display_name; ?></a></h3>
		                <div class="comment-points"><?php echo $niceScore; ?></div>
		                <p><?php echo $comment->body; ?></p>
		                <?php
			            foreach ($comment->attachments as $attachment) {

				            $media = "";

				            if ($attachment->attachment_post_type == "youtube") {

				                $videoID = $attachment->attachment_meta;
				                $media = "<div class='attachment-container'>";
				                $media .= '<iframe width="515" height="290" src="http://www.youtube.com/embed/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
				                $media .= "</div><div class='attachment-caption'>$attachment->attachment_body</div>";

				            } else {

				                $photoURL = str_replace("thumb", "medium", $attachment->attachment_img_url);
				                $media = "<div class='attachment-container'><img src='$photoURL' width=515></div><div class='attachment-caption'>$attachment->attachment_body</div>";

				            }
				            echo $media;
			            } ?>

		            </div>
		            <a href="#" class="flag-badge single-flag-button" spid="<?php echo $comment->id; ?>"></a>
		        </li>

		        <?php if (current_user_can('edit_superposts')) {

                    $commentUser = get_userdata( $comment->user_id );

                ?>
			    <select class="editor-functions" spid="<?php echo $comment->id; ?>" email="<?php echo $commentUser->user_email; ?>">
			    	<option>EDITOR OPTIONS</option>
			    	<option value="edit">Edit</option>
			    	<option value="unapprove">Unapprove</option>
			    	<option value="delete">Delete</option>
			    	<option value="contact" >Contact User</option>
			    	<option value="teflon">Teflon</option>
			    </select>

				<?php } //ENDIF current_user_can('delete_others_posts')?>

	        <?php } ?>
        </ul>
    </div>
    <div class="reply-field" id="reply_field">
        <div class="title-bar clearfix">
            <h3>Post a <span>Reply</span></h3>
<!--             <a href="#" class="add-youtube">Add youtube video</a>
            <a href="#" class="attach-photo">Attach Photo</a> -->

        </div>
        <form action="#" id="comment-form">
            <fieldset>
                <textarea id="" cols="30" placeholder="What's Your Take?" rows="10" name="body"></textarea>
                <input type="hidden" name="post_type" value="comment">
                <input type="hidden" name="parent" value="<?php echo $data->id ?>">

                <div class="login-area">
                    <p class="login-message" style="<?php echo $loginStyle; ?>">Please Login to Comment:</p>
                    <a href="#" id="imo-fb-login-button" style="<?php echo $loginStyle; ?>" class="imo-community-new-post fb-login join-widget-fb-login btn-fb-login">Fast Login & Submit</a>
                    <span class="or-delim" style="<?php echo $loginStyle; ?>">OR</span>
                    <a href="#" class="email-signup email-signup-button jq-open-reg-popup" style="<?php echo $loginStyle; ?>" >login with email address</a>
                    <p class="login-message" style="<?php echo $loginStyle; ?>">Your Comment will be submitted immediately after Login</p>
                    <span class="btn-red btn-post btn-submit"  style="<?php echo $displayStyle; ?>"><input id="post-photo" type="submit" value="Submit"></span>
                    <div class="loading-gif"></div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="hr"></div>
    <?php sub_footer(); ?>
    <div class="hr mobile-hr"></div>
    <!-- category popup start -->
    <div class="basic-popup cat-popup">
        <h3>Choose Category</h3>
        <ul class="browse-list">
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
        </ul>
        <a class="btn-close-popup jq-close-popup" href="#">close</a>
        <a class="btn-cancel jq-close-popup" href="#">Cancel</a>
    </div>
    <!-- category popup end -->

    <!-- state popup start -->
    <div class="basic-popup state-popup">
        <h3>Choose State</h3>
        <ul class="browse-list">
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
            <li><a href="#" class="ui-link">lorem ipsum</a></li>
        </ul>
        <a class="btn-close-popup jq-close-popup" href="#">close</a>
        <a class="btn-cancel jq-close-popup" href="#">Cancel</a>
    </div>
    <!-- state popup end -->

    <!-- login popup start -->
    <div class="basic-popup login-popup">
        <div class="popup-title">
            You need to log in to post your photo
        </div>
        <div class="join-box">
            <h3><span>LOGIN</span></h3>
            <a href="#" class="btn-fb-login">Fast Login with Facebook</a>
            <div class="sub-photo-note">* we do not post anything to your wall unless <br /> you say so!</div>
            <span class="or-delim">OR</span>
            <a href="#" class="btn-red">Use Your Email Address</a>
        </div>
        <a class="btn-cancel jq-close-popup" href="#">Cancel</a>
    </div>
    <!-- login popup end -->

    <!-- log/reg popup start -->
    <div class="basic-popup basic-form reg-popup">
        <div class="popup-inner clearfix">
            <form action="#">
                <fieldset>
                    <h3>Login</h3>
                    <div class="f-row">
                        <input type="text" placeholder="Email Address" />
                    </div>
                    <div class="f-row">
                        <input type="password" placeholder="Password" />
                    </div>
                    <div class="form-link">
                        <a href="#">Lost your password?</a>
                    </div>
                    <div class="f-row">
                        <div class="btn-red">
                            <input type="submit" value="Log In" />
                        </div>
                    </div>
                    <span class="or-delim">OR</span>
                    <h3>Register</h3>
                    <div class="f-row">
                        <input type="text" placeholder="Display Name" />
                    </div>
                    <div class="f-row">
                        <input type="text" placeholder="Email Address" />
                    </div>
                    <div class="f-row">
                        <input type="password" placeholder="Password" />
                    </div>
                    <div class="f-row">
                        <span class="btn-red">
                            <input type="submit" value="Submit" />
                        </span>
                    </div>
                </fieldset>
            </form>
        </div>
        <a class="btn-close-popup jq-close-popup" href="#">close</a>
        <a class="btn-cancel jq-close-popup" href="#">Cancel</a>
    </div>
    <!-- log/reg popup end -->
    <div class="filter-fade-out"></div>
</div>

<?php get_footer(); ?>
