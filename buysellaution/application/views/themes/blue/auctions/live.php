<?php defined("SYSPATH") or die("No direct script access."); 
?>
<script type="text/javascript">
	  $(document).ready(function(){	
  Auction.getauctionstatus(4);  
  
});
</script>
<div class="content_left_out fl">
    
<div class="content_left fl">
    <div class="title-left title_temp1">
    <div class="title-right">
    <div class="title-mid">
      <h2 class="fl" title="<?php echo __('menu_live_online_auctions');?>"><?php echo __('menu_live_online_auctions');?></h2>
        </div>
        </div>
        <div class="deal-left clearfix">
	<div class="action_deal_list clearfix seat_bid_content_outer" id="blue_auction_livepage">
            <div class="bidding_type">
        <div class="bidding_type_lft"></div>
        <div class="bidding_type_mid">
          <div class="bidding_inner"><span><?php echo __('bidding_type_label');?>:</span>
            <ul>
              <li><a title="<?php echo __('beginner_label');?>" class="beginner_icon"><?php echo __('beginner_label');?></a></li>
              <li><a title="<?php echo __('penny_label');?>" class="penny_auction_icon"><?php echo __('penny_label');?></a></li>
              <li><a title="<?php echo __('peak_label');?>" class="peak_auction"><?php echo __('peak_label');?></a></li>                
              <li><a title="<?php echo __('bonus_label');?>" class="bonus_auction_icon"><?php echo __('bonus_label');?></a></li>
              <li><a title="<?php echo __('hot_label');?>" class="hot_icon1"><?php echo __('hot_label');?></a></li>
              <?php /*<li><a title="Scratch Auction" class="scratch_icon1">Scratch Auction</a></li>*/ ?>
            </ul>
          </div>
        </div>
        <div class="bidding_type_rft"></div>
    </div>
    <?php
     
	 //echo Kohana_Beginner::product_block(6,4);exit;
		$count=true;	  
		$content=$block="";
		if(count($auction_types) > 0){
		foreach($auction_types as $typeid => $typename){
		if(isset($liveproducts[$typeid])){
		$block = $typename::product_block($liveproducts[$typeid],4);	
		$content.=$block;
		echo $block;							
		}
		}
		}
		if(trim($content)=="") { $count = false;}

		?>    	

		<div class="clear"></div>
		<?php if(!$count){?>
		<h4 class="no_data fl clr"><?php echo __("no_live_auction_at_the_moment");?></h4>
		<?php }?>
    <?php echo $include_facebook;?>
     <?php 
	
	       
	        $url=URL_BASE."auctions/fblike";
	        $message=__('flike_alert_msg');
	
        ?>
        <script type="text/javascript">
        function insert_fbuser()
        {
	        $.ajax({
		        type:'GET',
		        url:'<?php echo $url;?>',
		        data:'',
		        complete:function(data){
			        var msg=data.responseText;
			        if(msg==1)
			        {
				        alert("<?php echo __('flike_alert_msg');?>");
			        }
			        else if(msg==11)
			        {
				        alert("<?php echo __('flike_alert_msg2');?>");
			        }		
		        }
	        });
        }
		
		$(document).ready(function(){
		FB.Event.subscribe('edge.create',
			function(response) {
			insert_fbuser();
			//alert('You liked the URL: ' + response);
			});
		});

        </script>
    	
        
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
<!-- Recently closed-Auction-->
<?php  echo new View(THEME_FOLDER."recently_closed"); ?>
</div>
<script type="text/javascript">
$(document).ready(function () {$("#live_menu").addClass("fl active");});
</script>
