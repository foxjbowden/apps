<?php

/**
 * Template Name: Community Listing
 * Description: Community Homepage
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

the_post();
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


include 'common-templates.php'; ?>

<!-- *********************************************************** -->
<!-- ***************** UNDERSCORE TEMPLATE ********************* -->
<!-- *********************************************************** -->
<script type="text/template" id="post-template">
<%
var stateKey = new Object;
stateKey.AR = "arizona";
stateKey.AL = "alabama";
stateKey.AK = "alaska";
stateKey.AZ = "arizona";
stateKey.AR = "arkansas";
stateKey.CA = "california";
stateKey.CO = "colorado";
stateKey.CT = "connecticut";
stateKey.DE = "delaware";
stateKey.DC = "district-of-columbia";
stateKey.FL = "florida";
stateKey.GA = "georgia";
stateKey.HI = "hawaii";
stateKey.ID = "idaho";
stateKey.IL = "illinois";
stateKey.IN = "indiana";
stateKey.IA = "iowa";
stateKey.KS = "kansas";
stateKey.KY = "kentucky";
stateKey.LA = "louisiana";
stateKey.ME = "maine";
stateKey.MD = "maryland";
stateKey.MA = "massachusetts";
stateKey.MI = "michigan";
stateKey.MN = "minnesota";
stateKey.MS = "mississippi";
stateKey.MO = "missouri";
stateKey.MT = "montana";
stateKey.NE = "nebraska";
stateKey.NV = "nevada";
stateKey.NH = "new-hampshire";
stateKey.NJ = "new-jersey";
stateKey.NM = "new-mexico";
stateKey.NY = "new-york";
stateKey.NC = "north-carolina";
stateKey.ND = "north-dakota";
stateKey.OH = "ohio";
stateKey.OK = "oklahoma";
stateKey.OR = "oregon";
stateKey.PA = "pennsylvania";
stateKey.RI = "rhode-island";
stateKey.SC = "south-carolina";
stateKey.SD = "south-dakota";
stateKey.TN = "tennessee";
stateKey.TX = "texas";
stateKey.UT = "utah";
stateKey.VT = "vermont";
stateKey.VA = "virginia";
stateKey.WA = "washington";
stateKey.WV = "west-Virginia";
stateKey.WI = "wisconsin";
stateKey.WY = "wyoming";

var stateSlug = stateKey[post.state];

if(post.score == 1){
	niceScore = post.score + ' Point';
}else{
	niceScore = post.score + ' Points';
}
var desktop = new RegExp('filepicker');
desktop = desktop.test(post.img_url);
if( desktop ){ 
	crop = "/convert?w=650&h=650&fit=crop&rotate=exif";
}else{
	crop = "";	
}
%>

	<div class="dif-post">
        <% if(post.img_url){ %>      
        
	        <div class="feat-img">
	            <a href="/community/post/<%= post.id %>"><img class="feat-img" src="<%= post.img_url %><%= crop %>" alt="<%= post.title %>" title="<%= post.img_url %>" /></a>
	        </div>
        <% }else{ %>
        	 <div class="feat-img">
	            <a href="/community/post/<%= post.id %>"><img class="feat-img" src="<?php echo plugins_url('images/crosshair.jpg' , __FILE__ ); ?>" alt="<%= post.title %>" title="<%= post.img_url %>" /></a>
	        </div>
        <% } %>
        <div class="dif-post-text">
            <h3><a href="/community/post/<%= post.id %>"><%= post.title %></a></h3>
            <div class="profile-panel">
                <div class="profile-photo">
                    <a href="/profile/<%= post.user_nicename %>"><img src="/avatar?uid=<%= post.user_id %>" alt="<%= post.user_nicename %>" title="<%= post.user_nicename %>" /></a>
                </div>
                <div class="profile-data">
                    <h4><a href="/profile/<%= post.user_nicename %>"><%= post.display_name %></a></h4>
                    <ul class="prof-tags">
                        <% if(post.state){ %><li><a href="/community/report/<%= stateSlug %>"><%= post.state %></a></li><% } %>
                        <li><a href="/community/<%= post.post_type %>" style="text-transform:capitalize;"><%= post.post_type %></a></li>
                    </ul>
                    <ul class="replies">
                        <li><a href="/community/post/<%= post.id %>#reply_field"><%= post.comment_count %> Reply</a></li>
						<li><%= niceScore %></li>
                    </ul>
                    <ul class="prof-like">
						<li><div class="fb-like" data-href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/community/post/<%= post.id %>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
                    </ul>
                    </div>
                    </ul>
                </div>
            </div>
            <% if (post.master == 1) {  %><span class="badge"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="Master Angler" /></span><% } %>
        </div>
    </div>

</script>
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<!-- *********************************************************** -->

<div class="page-community">
    <div class="general general-com">
    	<div class="custom-title clearfix">
            <img src="<?php echo plugins_url('images/naw-plus.png' , __FILE__ ); ?>" alt="NAW+ Community" class="custom-tite-logo">
            <div class="title-crumbs">
                <h1>NAW+ Community</h1>
                <div class="sponsor"><?php imo_ad_placement("sponsor_logo_240x60"); ?></div>
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

        <div class="btn-group btn-bar">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="menu-title browse-community">Browse Community</span> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu filter" role="menu">
            <li><a href="" class="filter-menu" order_by="created" id="filter-menu-default">Latest</a></li>
            <li><a href="" class="filter-menu" order_by="view_count" >Popular</a></li>
            <li><a href="" class="filter-menu" order_by="score_today" >Trending Today</a></li>
<!--             <li><a href="" class="filter-menu" order_by="score_week" >Trending This Week</a></li> -->
            <li class="divider"></li>
            <li><a href="" class="filter-menu" order_by="created" post_type="report" >Rut Reports</a></li>
            <li><a href="" class="filter-menu" order_by="created" post_type="general" >General Discusion</a></li>
            <li><a href="" class="filter-menu" order_by="created" post_type="question" >Questions</a></li>
            
          </ul>
        </div>
		


<!--         <div class="general-title clearfix alter-title">
            <h2>Latest <span>Submissions</span></h2>
        </div> -->
        <div class="loading-gif"></div>
        <div class="dif-posts">
     		<div id="posts-container"></div>
         </div>
         <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
            <a href="#" class="btn-base load-more" style="display:block;">Load More</a>

            <a href="#" class="go-top jq-go-top">go top</a>

            <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
        </div>
		<?php social_footer(); ?>
		<div class="hr mobile-hr"></div>
		<a href="#" class="back-top jq-go-top">back to top</a>

    </div>
</div>

<?php get_footer(); ?>