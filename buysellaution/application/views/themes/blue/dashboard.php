<?php defined("SYSPATH") or die("No direct script access."); ?>
		<link type="text/css" href="<?php echo CSSPATH;?>ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo SCRIPTPATH;?>jquery-ui-1.8.16.custom.min.js"></script>
<div class="action_content_left fl">
        <div class="title-left title_temp1">
        <div class="title-right">
        <div class="title-mid">
        <h2 class="fl clr pl10"><?php echo __('my_dashboard');?></h2>
        </div>
        </div>
        </div>
        <div class="deal-left clearfix">
	<div class="action_deal_list action_deal_list2 clearfix">
	<div class="dashboard_cnt fl clr mt20 pb20 pl10">
        <div class="dashboard_cnt_top fl clr">
        	<h3 class="fl clr pb20"><?php echo __('Things_to_do');?>:</h3>
            <div class="dashboardicons">
            <!--Add a Billing Address Link START-->
            <div class="add_bill_address fl">
                <span class="add_address_left fl">&nbsp;</span>
                <span class="add_address_middle fl">
                    <a href="<?php echo URL_BASE.'packages';?>" title="<?php echo __('buy_some_packages');?>" class="fl"> <?php echo __('buy_some_packages');?></a>
                </span>
                <span class="add_address_left add_address_right fl">&nbsp;</span>
            </div>
            <!--Add a Billing Address Link END-->
            <!--Add a Shipping Address START-->
            <div class="add_bill_address fl ml20">
                <span class="add_address_left fl">&nbsp;</span>
                <span class="add_address_middle fl">
                    <a href="<?php echo URL_BASE.'users/won_auctions';?>" title="<?php echo __('view_your_won_auctions');?>" class="fl"><?php echo __('view_your_won_auctions');?></a>
                </span>
                <span class="add_address_left add_address_right fl">&nbsp;</span>
            </div>
            <!--Add a Shipping Address END-->
            <!--Purchase some bids START-->
            <div class="add_bill_address fl ml20">
                <span class="add_address_left fl">&nbsp;</span>
                <span class="add_address_middle fl">
                    <a href="<?php echo URL_BASE.'users/watchlist';?>" title="<?php echo __('view_my_watchlist');?>" class="fl"><?php echo __('view_my_watchlist');?></a>
                </span>
                <span class="add_address_left add_address_right fl">&nbsp;</span>
            </div>
            <!--Purchase some bids END-->
            <!--Earn some bonus START-->
            <div class="dashbord_icon fl mt35">
                <span class="add_address_left fl">&nbsp;</span>
                <span class="add_address_middle fl">
                    <a href="javascript:;" title="<?php echo __('earn_bonus');?>" class="fl" id="dialog_link_bl"><?php echo __('earn_bonus');?></a>
                </span>
                <span class="add_address_left add_address_right fl">&nbsp;</span>
            </div>
            <!--Earn some bonus END-->
            </div>
        </div>  
        <div class="dashboard_cnt_top fl clr">
        	<h4 class="fl clr mt20"><?php echo __('my_dashboard');?></h4>
            <p class="fl clr mt20"><?php echo __('you_currently_have');?> &nbsp;<strong> <?php echo $site_currency." ".Commonfunction::numberformat($balance);?></strong> <?php echo __('in_your_account');?>. &nbsp;<img src="<?php echo IMGPATH;?>buy_bid_bg.png" />  &nbsp;<a href="<?php echo URL_BASE.'packages';?>" title="<?php echo __('buy_packages');?>"><?php echo __('click_here_to_purchase_some_packages');?></a></p>
		<p class="clr pt10"><?php echo __('your_bonus_is')." <b>".$site_currency." ".$user_current_bonus."</b>";?></p>
       </div>  
    </div>
	</div>
    </div>
    <div class="auction-bl">
    <div class="auction-br">
    <div class="auction-bm">
    </div>
    </div>
    </div>
</div>
<!-- Dash Board End-->
<!--Modal Window-->
<div id="dialog" title="<?php echo __('earn_bonus');?>" style="display:none;">
	<div class="fl fb_share"><a href="<?php echo URL_BASE;?>socialnetwork/facebookshare" title="<?php echo __('facebook_share');?>"><img src="<?php echo IMGPATH;?>facebook_shareicon.png" alt="<?php echo __('facebook_share');?>" title="<?php echo __('facebook_share');?>"/></a></div>
<div class="fl tw_share" ><a href="<?php echo URL_BASE;?>socialnetwork/twittershare" title="<?php echo __('twitter_share');?>"><img src="<?php echo IMGPATH;?>twitter_shareicon.png" alt="<?php echo __('twitter_share');?>"/></a></div>
	<p class="clr"></p>	
</div>
<script type="text/javascript">
$(document).ready(function () {$("#users_menu").addClass("fl active");$("#dashboard_active").addClass("user_link_active");
// Dialog			
				$('#dialog').dialog({
					autoOpen: false,
					width: 300,
					modal: true
				});
				$('#dialog_link_bl').click(function(){
					$('#dialog').dialog('open');
					return false;
				});
				
				if(window.location.hash=="#_=_")
				{
					window.location.hash="dashboard";
				}
});
</script>
