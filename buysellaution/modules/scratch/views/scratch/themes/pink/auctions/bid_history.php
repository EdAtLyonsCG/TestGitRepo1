<ul class="table-bid-history">
        <?php if($count > 0){?>
        <?php $i=0;foreach($bid_histories as $bid_history):?>
        <?php $bg_none=($i==$count-1)?'bg_none':"";?>
        <ul>
  <li class="fl" style="border-right:none;width:130px;float:left; word-wrap:break-word;border-bottom: 1px solid #e2e1e1;color: #868686;font-weight: bold;list-style: none outside none;padding: 10px 0;text-align: center;">  <?php echo $site_currency." ".Commonfunction::numberformat($bid_history['price']);?></li>
		
  
  <li class="fl" style="float:left;width:120px;border-bottom: 1px solid #e2e1e1;color: #868686;font-weight: bold;list-style: none outside none;padding: 10px 0;text-align:left;">
             <?php echo $bid_history['date'];?></li>
   
    
                

</ul>
<?php endforeach;?>		
        <?php }  else { ?>
        
        <ul>
            <li class="fl">
            	<p class="no_data"><?php echo __('no_bids_yet');?></p> </li>
        </ul>
        
		<?php }?>
        
</ul>
<script type="text/javascript">
$(function(){
$("ul.table-bid-history ul:last li").css({'border-bottom':'none'});
		   });
</script>
