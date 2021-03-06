<?php $id="";
$c_date =Commonfunction::getCurrentTimeStamp();
foreach($productsresult as $product_result):
$id.= $product_result['product_id']; 
?>
<?php if($product_result['product_process']!=CLOSED){?>
<script type="text/javascript">
$(document).ready(function(){
Auction.getauctionstatus(6,"",'<?php echo $id;?>');					   
});
</script>
<?php } 
else {
?><script type="text/javascript">
$(document).ready(function(){
Auction.bidhistory();				   
});
</script>
<?php }?>
<script>
function initialize() {
      var myLatlng = new google.maps.LatLng(<?php if($product_result['latitude']==0){ echo '11.0168445';}else { echo $product_result['latitude'];}?>,<?php if($product_result['longitude']==0){echo '76.95583209999995';}else{echo $product_result['longitude'];}?>);
      var myOptions = {
        zoom: 8,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }		
      var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
    }
	
    function loadScript() {
      var script = document.createElement("script");
      script.type = "text/javascript";
      script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initialize";
      document.body.appendChild(script);
    }
    window.onload = loadScript;
 a['scratchcount']=parseInt('<?php echo $product_result["timetobuy"]; ?>');
</script>
<style type="text/css"> 
      #map-canvas {
        width: 950px;
        height: 190px
		
      }
.price_table{ border:1px solid #E2E1E1; border-bottom:0px;background:#E8E8E8; }
.price_table td{ border-bottom:1px solid #E2E1E1; }
.price_table  td { color:#BB006F;}
</style>

	<?php 
    			if(($product_result['product_image'])!="" && file_exists(DOCROOT.PRODUCTS_IMGPATH_THUMB3.$product_result['product_image']))
	       			{ 
					$product_img_path=URL_BASE.PRODUCTS_IMGPATH_THUMB3.$product_result['product_image'];
					$product_full_size=URL_BASE.PRODUCTS_IMGPATH.$product_result['product_image'];
				}
				else
				{
					$product_full_size=IMGPATH.NO_IMAGE;
					$product_img_path=IMGPATH.NO_IMAGE;
					
				}
			?>
 
<!-- container_inner   CLASS START-->
<div class="container_inner fl clr element<?php echo $product_result['product_id'];?>">
	<div class="title_temp2 fl clr">
    	<h2 class="fl clr"><?php echo __('menu_product_detail');?></h2>
    </div>
	<div class="fun" style="display:none">
        <!--Google Map-->
                <div class="fun" >
                <div id="map-canvas"></div> 
                </div>
        <!--Map End-->
        </div>
	<!-- product_container START-->
 
	<div class="product_container fl clr ml10 mt20 auction_item" id="auction_<?php echo $id;?>" name="<?php echo URL_BASE;?>auctions/process">
	<div class="auction_type" data-auctiontype="<?php echo $product_result['auction_type'];?>"></div>
    	<div class="product_left fl">
        	<div class="product_content_top fl clr"></div>
            <div class="product_content_middle fl clr">
            	<div class="product_title fl clr">
                	<h2 class="fl clr"><?php echo ucfirst($product_result['product_name']);?></h2>
                </div>    
                    <div class="product_detail_top fl clr">
                    	<div class="product_detail_top_left fl">
			<div class="productDetail" style="display:none;"><?php echo $product_result['product_id'];?></div>
			 <div class="product_feature_outer">
				<?php if($product_result['product_featured']==FEATURED){?><span class="feature_icon_product"></span><?php } ?>
			        <?php if($product_result['dedicated_auction']==ENABLE){?><span class="bonus_icons_product_top" title=""></span><?php } ?>
				 <?php if($product_result['autobid']==ENABLE){?><span class="autobid_icon"></span><?php } ?>
				<?php if($product_result['product_featured']==HOT){?><span class="hot_icon_product_ic"></span><?php } ?>
                <span class="scratch_product"></span>
                         </div>
				<div class="fl">
                        	<a class="fl lightbox" title="<?php echo ucfirst($product_result['product_name']);?>"> <img src="<?php echo $product_img_path;?>" width="200" height="200" border="0" class="fl" /><?php if($product_result['product_process']==CLOSED){?><img src="<?php echo IMGPATH.SOLD_IMAGE;?>"class="sold_image"/><?php } ?></a></div>
                        </div>
                        
                        <div class="product_detail_top_right fl">



					<?php if($product_result['product_process']!=CLOSED){?>
                         
					 
                        <div class="roming" style="display:none;border:1px solid red;"><p class="fl"><?php echo __('price_label');?> :</p><p class="fl"><span class="currentprice"><?php echo ($product_result['product_process']==CLOSED)? $site_currency." ".$product_result['current_price']:$product_result['current_price'];?></span><span class="price" style="display:none;"></span></p></div>

							 	
					
    <div class="scratch_module">
        <div class="scratch_top"></div>
        <div class="scratch_mid">

            <?php  if($product_result['current_price']<=$product_result['bidamount']){ ?>
             <div class="scratchbuycountdown" id="#roming_toptxt" style="display:none;">
            <p class="scratch_info"><?php echo __('your_price_label');?>: <span  class="currentprice"><?php echo ($product_result['product_process']==CLOSED)? $site_currency." ".$product_result['current_price']:$product_result['current_price'];?></span></p>
            <p class="scratch_time"><?php echo __('time_to_label');?><span class="showcountdown"><?php echo $product_result['timetobuy']; ?><?php echo __('seconds_label')?></span></p>
            <div class="scratch_buy clearfix mt10">
                <span class="scratch_ok_left">&nbsp;</span>
                 <span class="scratch_ok_mid"><a href="#" title="<?php echo __('buy_now_label');?>"><?php echo __('buy_now_label');?></a></span>
                 <span class="scratch_ok_right">&nbsp;</span>
            </div>
            <div class="scratch_cancel1 clearfix">
                <span class="scratch_cancel_left">&nbsp;</span>
                 <span class="scratch_cancel_mid"><a href="<?php echo URL_BASE.'auctions/view/'.$product_result['product_url'];?>" title="<?php echo strtoupper (__('cancel_label'));?>"><?php echo __('cancel_label');?></a></span>
                 <span class="scratch_cancel_right">&nbsp;</span>
            </div>
            </div>
           
            <?php  }else{ ?>
            <div class="scratchbuycountdown" id="#roming_toptxt" style="display:none;">
            <p class="scratch_info"><?php echo __('your_price_label');?>: <span  class="currentprice"><?php echo ($product_result['product_process']==CLOSED)? $site_currency." ".$product_result['current_price']:$product_result['current_price'];?></span></p>
            <p class="scratch_time"><?php echo __('time_to_label');?> <span class="showcountdown"><?php echo $product_result['timetobuy']; ?><?php echo __('seconds_label')?></span></p>
            <div class="scratch_buy clearfix">
                <span class="scratch_ok_left">&nbsp;</span>
                 <span class="scratch_ok_mid"><a href="<?php echo URL_BASE;?>site/scratch/addtocart_list/<?php echo $product_result['product_id'];?>" title="<?php echo __('buy_now_label');?>"><?php echo __('buy_now_label');?></a></span>
                 <span class="scratch_ok_right">&nbsp;</span>
            </div>
            <div class="scratch_cancel1 clearfix">
                <span class="scratch_cancel_left">&nbsp;</span>
                 <span class="scratch_cancel_mid"><a href="<?php echo URL_BASE.'auctions/view/'.$product_result['product_url'];?>" title="<?php echo strtoupper (__('cancel_label'));?>"><?php echo __('cancel_label');?></a></span>
                 <span class="scratch_cancel_right">&nbsp;</span>
            </div>
            </div>  
                     <?php }?>


                     <!--Buy now seconds div end-->                 
        
         <!--scratch detail 2 ends -->

		 <!--scratch detail 1 starts -->
    

            <div class="scratch_buy_details clearfix">
                <p class="credit clearfix"><span><?php echo __('see_myprice_label');?> : </span><b><?php echo  $site_currency."".$product_result['bids']." ".__('bidamount_label'); ?></b></p>
                <p class="credit clearfix"><span><?php echo __('time_to_label');?></span><b><?php echo $product_result['timetobuy']." ".__('second_label');?></b></p>
            </div>
           
            <div class="scratch_timer_display clearfix">
             <?php if($product_result['product_process']!=CLOSED){?>
                 <p><?php echo __('active_since_label');?></p>
                  <?php }?>  
                <div class="timer-block">
             
                <div class="countdown clearfix">
                    <div class="timer clearfix">
                    <ul>
                        <strong class="countdown"><?php echo ($product_result['product_process']!=CLOSED)?"<img src=".IMGPATH."ajax-loader.gif>":__('closed_text');?></strong>
                    </ul>    
                    </div>
                </div>
            </div>
            </div>
            <?php if($product_result['startdate']<=$c_date && $product_result['auction_process']!=HOLD):?>
            <?php if($product_result['product_process']!=CLOSED){?>
             <!--Toggle start-->
            <div class="buynowok">
				<div class="example1">
				<?php if($product_result['product_process']==LIVE){?>

				<p class="scratch_cost">
					<?php echo __('scratch_will_label');?> <?php echo $site_currency.$product_result['bids'];?> <?php echo __('price_low_label');?> <?php echo $site_currency." ".Commonfunction::numberformat($product_result['bidamount']);?>
					<?php echo __('then_you_label');?> <?php echo $product_result['timetobuy']; ?> <?php echo __('seconds_tobuy_label');?>
				</p>
				<div class="clearfix">
					<div class="scratch_ok clearfix">
					<span class="scratch_ok_left">&nbsp;</span>
					<span class="scratch_ok_mid"><a href="javascript:;" id="<?php echo $product_result['product_id'];?>" name="<?php echo URL_BASE;?>auctions/bid" class="scratchbid" title="<?php echo __('ok_label'); ?>" rel="<?php echo URL_BASE;?>users/login/"  data-auctiontype="<?php echo $product_result['auction_type'];?>"><?php echo __('ok_label'); ?></a>
					</span>
					<span class="scratch_ok_right">&nbsp;</span>
					</div>
					
					<div class="scratch_cancel clearfix">
                <span class="scratch_cancel_left">&nbsp;</span>
                 <span class="scratch_cancel_mid"><a href="#close-example1" id="close-example1" title="<?php echo strtoupper (__('cancel_label'));?>"><?php echo __('cancel_label');?></a></span>
                 <span class="scratch_cancel_right">&nbsp;</span>
            </div>
            
				</div>
				<?php }else if($product_result['product_process']==CLOSED){ ?>
				<span id="link_<?php echo $product_result['product_id'];?>"  class="future auction_link"><?php echo __('closed_text');?></span><?php } else if($product_result['product_process']==FUTURE) { ?><span style="display:none;" class="comingsoon future"><?php echo __('comingsoon_text');?></span><?php } ?>

				</div>
		    </div>
           <?php }?>
          
        <!--Toggle end-->
         <?php endif;?>
        <?php if($product_result['buynow_status']==ACTIVE && $product_result['product_process']!='C'):?>
			<div class="scratch_buy clearfix" id="ecommersebuynow">
                <span class="scratch_ok_left">&nbsp;</span>
                 <span class="scratch_ok_mid"><a href="<?php echo URL_BASE;?>site/buynow/buynow_addcart/<?php echo $product_result['product_id'];?>" title="<?php echo __('buy_now_label');?>"><?php echo __('buy_now_label');?></a></span>
                 <span class="scratch_ok_right">&nbsp;</span>
            </div>
        <?php endif;?>
        
        <?php if($product_result['product_process']!=CLOSED){?>
            <div class="share clearfix">
            
                        <p><?php echo __('share_label');?>:</p>
                        <ul>
                            <li class="twit">
								<?php $url=URL_BASE."auctions/view/".$product_result['product_url'];?>
								<a title="Twitter" href="http://twitter.com/share?url=<?php echo $url;?>&amp;text=<?php echo $product_result['product_name'];?>" target="_blank">
									<img src="<?php echo IMGPATH;?>twitter_link_icon.png" alt="Twitter" border="0" class="fl"s/>
								</a>
                            </li>
                            
                            <li class="face"><a title="Facebook" href="https://www.facebook.com/sharer.php?u=<?php echo $url;?>&t=<?php echo $product_result['product_name'];?>" target="_blank">
								
                            </a>
                            </li>
                            
                             <li class="google_icon"><a title="Google+" href="#">
									 <!-- Place this tag where you want the +1 button to render -->
								<g:plusone size="medium" annotation="none"></g:plusone>
								<!-- Place this render call where appropriate --> 
								<script type="text/javascript">
								(function()
								{
								var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
								po.src = 'https://apis.google.com/js/plusone.js';
								var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
								})();
								</script>
									 </a>
                             </li>
                             
                            <li class="flike">
								<fb:like href="<?php echo $url = URL_BASE.'auctions/view/'.$product_result['product_url'];?>" layout="button_count" width="84" send="false" ref="" style="border:none;"></fb:like>
                            </li>
                        </ul>
                    </div><?php } ?>

						</div>
					<div class="scratch_bot"></div>
				</div>
                        	 
                        </div><?php } ?>
                        	 
			
                        
                    <!-- Message flash-->
           <div class="notice_nsg2 fl clr" id="notice_msg<?php echo $product_result['product_id'];?>" style="display:none;"></div> <!-- end of Message flash-->
                    <div class="product_detail_top fl clr mt20">
                    	<div class="product_detail_middle_left fl">
				
           <!--watchlist message--> 
			<div id="successaddwatchlist_<?php echo $product_result['product_id'];?>" class="info_msg mt5"></div>
	<!--end of watchlist message-->
				<?php if($product_result['product_process']!=CLOSED){?>
                        	<div class="add_watch_list fl pl5">
                                <span class="soon_left fl">&nbsp;</span>
                                <span class="soon_middle fl pl5 pr5">
                                    <a href="javascript:;" class="future fl addwatchlist" title="<?php echo __('add_to_watchlist');?>" rel="<?php echo $product_result['product_id'];?>"  name="<?php echo URL_BASE;?>auctions/addwatchlist"><?php echo __('add_to_watchlist');?></a>
                                </span>
                                <span class="soon_left soon_right fl">&nbsp;</span>
                            </div>
				<?php } ?>
		<!--Lightbox link-->
			<div id="gallery" class="fl">
                          <a href="<?php echo $product_full_size;?>" style="width: auto;font: bold 12px/20px arial;
color: #EDEDED;" class="fl lightbox" title="<?php echo ucfirst($product_result['product_name']);?>">  
			<div class="enlarge_image fl ml20 mt5">
				
                            	<?php echo __('Click_to_enlarge_Image_label');?></div></a>
                            </div>
                        </div>
			
                    
                    <div class="product_detail_top fl clr mt20 pb20">
                    	<div class="product_bid_price fl mt15">
                        	
                            <table cellpadding="0" cellspacing="0" border="0" align="right" class="mt10 mr10">
                            	<tr>
                                	<th align="right"><?php echo __('With each bid, the auction price increases by_label');?>:</th>
                                    <td align="left"><?php echo $site_currency." ".Commonfunction::numberformat($product_result['bidamount']);?></td>
                                </tr>                            
                            	<tr>
                                	<th align="right"><?php echo __('retail_price_label')?>:</th>
                                    <td align="left"><?php echo $site_currency." ".Commonfunction::numberformat($product_result['product_cost']);?></td>
                                </tr>
                                
                            </table>
                        </div>
                    	  </div>
            </div>
            </div>	
                   
	   <?php if($product_result['product_process']==CLOSED){?>
                        </div>
              <?php   } ?>
	   
        </div><div class="product_content_top product_content_btm fl clr"></div>
</div>
  
        <!--product sidebar START-->
        <div class="product_sidebar fr">
        <!--product sidebar Bid History START-->
        	<div class="product_sidebar1 fl clr">
            	<div class="product_sidebar_tab fl">
                	<ul class="fl">
                    	<li class="fl ml10">
                        	<a href="#" title="Bid History" class="fl">
                            	<span class="fl product_sidebar_tab_left">&nbsp;</span>
                                <span class="fl product_sidebar_tab_middle pl5 pr5"><?php echo __('bid_history_label');?></span>
                                <span class="fl product_sidebar_tab_left product_sidebar_tab_right">&nbsp;</span>
                            </a>
                        </li>
                  </ul>
                </div>
            	<div class="product_sidebar_top fl clr"></div>
                <div class="product_sidebar_middle fl clr">
                	<table cellpadding="0" cellspacing="0" border="0" width="100%">
                    	<tr>
                            <th width="80" align="center"><?php echo __('Price_label');?></th>
                         
                            <th width="82" align="center"><?php echo __('Date_label');?></th>
			
                        </tr> 
			</table>
		<!--Bid history-->
			 <div class="bid_history" id="<?php echo URL_BASE;?>site/scratch/bid_history/<?php echo $id;?>" style="" rel="<?php echo $product_result['lastbidder_userid'];?>"  name="<?php echo $auction_userid;?>"><img src="<?php echo IMGPATH.'ajax-loader.gif';?>"/></div><!--End of bid history-->                      
                </div>
                <div class="product_sidebar_top product_sidebar_btm fl clr"></div>
            </div>
        
            <!--Auction News END-->   
        </div>
        <!--product sidebar START-->
    </div>
<div class="product_container fl clr pt10 ml20">
		<h2 class="product_detail_title fl clr"><?php echo __('product_description');?></h2>
		<p class="product_detail_description fl clr mt10"><?php echo $product_result['product_info'];?></p>
	</div>
    <!-- product_container END-->
    <div class="product_container fl clr mt20 pt10 ml20">
    	<div class="product_btm_content_left fl">
         <div class="yello_top"><p>Auctions Details</p></div>
                <div class="yello_mid">
        	<table align="left" cellpadding="0" cellspacing="0" border="0">
            	<tr>
                	<th align="left"><?php echo __('auction_id_label');?>: </th>
                	<td align="right"><p><?php echo $product_result['product_id'];?></p></td>
            	</tr>
                <tr>
                	<th align="left"><?php echo __('Auction_type_label');?> : </th>
                	<td align="right"><span><?php echo Ucfirst($product_result['typename']);?></span></td>
            	</tr>
                
            </table>
            </div>
             <div class="yello_bot"></div>
        </div>
        <div class="product_btm_content_middle fl ml20 pl5">
         <div class="yello_top"><p>Auctions Details</p></div>
                <div class="yello_mid">
        	<table align="right" cellpadding="0" cellspacing="0" border="0">
            	 <tr>
                	<th align="left"><?php echo __('price_starts_from');?>: </th>
                	<td align="right"><span><?php echo $site_currency." ".Commonfunction::numberformat($product_result['starting_current_price']);?></span></td>
            	</tr>
                <tr>
                	<th align="left"><?php echo __('start_time_label');?>: </th>
                	<td align="right"><span><?php echo Commonfunction::date_to_string($product_result['startdate']);?></span></td>
            	</tr>
                <tr>
                	<th align="left"><?php echo __('end_time_label');?>: </th>
                	<td align="right"><span><?php echo Commonfunction::date_to_string($product_result['enddate']);?></span></td>
            	</tr>
            </table>
            </div>
              <div class="yello_bot"></div>
        </div>
        <div class="shipping_detail fr">
        <div class="yello_top"><p>Auctions Details</p></div>
                <div class="yello_mid">
        	<div class="shipping_title fl clr">
            	<p class="fl"><?php echo __('Shipping_fee_label');?> :</p>
                <span class="fr"><?php echo $site_currency." ".$product_result['shipping_fee'];?></span>
                </div>
                
                <div class="shipping_title fl clr">
            	<p class="fl"><?php echo __('Shipping_information_label');?> :</p>
                <span class="fr"><?php echo $product_result['shipping_info'];?></span>
                </div>
                </div>
                 <div class="yello_bot"></div>
        </div>
    </div>    
<?php endforeach;?>       
<script type="text/javascript">

$(document).ready(function(){	

    $('.example1').show().before('<div class="scratch_price clearfix"><span class="scratch_price_left">&nbsp;</span><span class="scratch_price_mid" id="open_example22"><a href="#" id="open-example1" title="<?php echo __("scratch_label");?>"><?php if($product_result["product_process"]!=CLOSED){?><?php echo __("scratch_label");?> <?php }?></a></span><span class="scratch_price_right">&nbsp;</span></div>');

	$('a#open-example1').click(function() {
		$('.example1').slideDown(100);
		return false;
	});
	$('a#close-example1').click(function() {
		$('.example1').slideUp(100);
		return false;
	});
});
$('.scratchbid').live('click',function(){ $('#ecommersebuynow').hide(); })
</script>

