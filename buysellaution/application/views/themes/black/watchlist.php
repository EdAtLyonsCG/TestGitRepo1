<?php defined("SYSPATH") or die("No direct script access."); ?>
<div class="content_left_out fl">
<div class="action_content_left fl">
	<div class="title_temp1 fl clr">
    	<h2 class="fl clr" title="<?php echo __('my_watchlist');?>"><?php echo __('my_watchlist');?></h2>
    </div>
    	
	<div class="watch_list_items fl clr">
	
		<div id="managetable" class="fl clr">
		<?php if($count_user_watchlist>0){ ?>
		<!--List products-->
		
		<table width="660" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
		<th  align="center"><b><?php echo __('image');?> </b></th>
		<th width="15%" align="center"><b><?php echo __('title');?></b></th>
		<th align="center"><b><?php echo __('end_time');?></b></th>
		<?php /*<th align="center"><b><?php echo __('price');?></b></th>*/?>
		<th align="center"><b><?php echo __('actions');?></b></th>
		
		</tr>
		<?php 
	
		foreach($watch_results as $watch_result):?>
		<tr>
		<td align="center" width="50">
            <a href="<?php echo url::base();?>auctions/view/<?php echo $watch_result['product_url'];?>" class="fl">
		<?php if(($watch_result['product_image'])!="" && file_exists(DOCROOT.PRODUCTS_IMGPATH_THUMB1.$watch_result['product_image']))
	       			{ 
					$product_img_path=URL_BASE.PRODUCTS_IMGPATH_THUMB1.$watch_result['product_image'];
				}
				else
				{
					$product_img_path=IMGPATH.NO_IMAGE;
				}
			?>
                <img src="<?php echo $product_img_path;?>" width="50" height="50" align="middle" title="<?php echo ucfirst($watch_result['product_name']);?>"/>
            </a>
        </td>
		<td align="center"><p class="watch_list_title fl" style="padding:0 0 0 18px;"><?php echo Text::limit_chars(ucfirst($watch_result['product_name']),12);?></p></td>
		<td align="center"><p style="text-align:center;width:100%;float:left;"><?php echo $watch_result['enddate'];?></p></td>
		<?php /*<td align="center" width="100" style="padding:0 0 0 15px;"><b><?php echo  $site_currency." ".Commonfunction::numberformat($watch_result['current_price']);?></b></td> */?>
		<td align="center">
        	<a style="float:left;text-align:center;width:100%;" href="<?php echo url::base();?>users/watchlist/<?php echo $watch_result['watch_id'];?>" onclick=" return confirmDelete('<?php echo __('are_you_sure_delete');?>');" title="<?php echo __('button_delete');?>" class="delet_link fr" style="padding:0 0 0 0px;"><?php echo __('button_delete');?></a>
        </td>
		
		</tr>
		<?php endforeach; 
		}
		else
		{
		?>
		<h4 class="no_data fl clr"><?php echo __("no_watchlist_auction_at_the_moment");?></h4> 
		<?php 
		}?>
		</table>
		</div>
		<div class="clear"></div>
		<div class="user" style="display:none;" ><?php echo $auction_userid;?></div>
	</div>
	</div>

<!--Pagination-->
<div class="pagination">
<?php if($count_user_watchlist > 0): ?>
 <p><?php echo $pagination->render(); ?></p>  
<?php endif; ?>
</div>
<!--End of Pagination-->
</div>
<script type="text/javascript">
$(document).ready(function () {$("#users_menu").addClass("fl active");$("#my_watchlist_active").addClass("user_link_active");});
</script>
