<?php defined("SYSPATH") or die("No direct script access.");?>
<script type="text/javascript">
        $(document).ready(function(){		
       Auction.getauctionstatus(8,"","",{'search':'<?php echo $value;?>'});
});
</script>
<div id="test" ></div>
<div class="content_left_out fl">
<div class="content_left fl">
    <div class="title-left title_temp1">
        <div class="title-right">
        <div class="title-mid">
             	<h2 class="fl" title="<?php echo __('search_auctions');?>"><?php echo __('search_auctions');?></h2>
        </div>
        </div>
        </div>
         <div class="deal-left clearfix" style="width:957px;border-right:1px solid #ddd;">
	<div class="action_deal_list clearfix">

	 <?php 
		
		$count=true;	  
		$content=$block="";
		if(count($auction_types) > 0){
		foreach($auction_types as $typeid => $typename){
		if(isset($products[$typeid])){
			
		$block = $typename::product_block($products[$typeid],8,array('search'=>$value));	
		$content.=$block;
		echo $block;							
		}
		}
		}
		if(trim($content)=="") { $count = false;}

		?>    	

		<div class="clear"></div>
		<?php if(!$count){?>
		<h4 class="no_data fl clr"><?php echo __("no_search_auction_found",array(":param" =>"<span style='font-size:18px;'>".$value."</span>" ));?></h4>
		<?php }?>
		
      
    <div class="bidding_type seat_bid_content_outer" id="search_bidtype">
        <div class="bidding_type_lft"></div>
        <div class="bidding_type_mid">
          <div class="bidding_inner"><span><?php echo __('bidding_type_label');?>:</span>
            <ul>
              <li><a title="<?php echo __('beginner_label');?>" class="beginner_icon"><?php echo __('beginner_label');?></a></li>
              <li><a title="<?php echo __('penny_label');?>" class="penny_auction_icon"><?php echo __('penny_label');?></a></li>
              <li><a title="<?php echo __('peak_label');?>" class="peak_auction"><?php echo __('peak_label');?></a></li>
              <li><a title="<?php echo __('bonus_label');?>" class="bonus_auction_icon"><?php echo __('bonus_label');?></a></li>
              <li><a title="<?php echo __('hot_label');?>" class="hot_icon1"><?php echo __('hot_label');?></a></li>
            </ul>
          </div>
        </div>
        <div class="bidding_type_rft"></div>
    </div>
</div>      
   
   <!--end--> </div>
        <div class="auction-bl" style="width:959px;">
        <div class="auction-br">
        <div class="auction-bm">
        </div>
        </div>
        </div>

</div> </div>
<script type="text/javascript">
$(document).ready(function () {$("#live_menu").addClass("fl active");});
</script>
