var peak=true;
NAuction.prototype.peakauction = function(item)
{
		var price=$("#"+item.Product.element+' .price').html();
				
					switch(item.Product.current_status)
					{					
						case 0:						
							if(item.Product.lastbidder==0)
							{
								a[item.Product.element]['bid'].hide();
								a[item.Product.element]['countdown'].html(language.comingsoon_text);
								a[item.Product.element]['futureday'].html(item.Product.status);
								a[item.Product.element]['comingsoon'].show(1);
														
							}
							else if(item.Product.lastbidder!=0)
							{
								
								a[item.Product.element]['bidme_link'].hide();
								a[item.Product.element]['countdown'].html(language.resume_text+" "+item.Product.resume_time);	
								a[item.Product.element]['countdown'].css({"font-size":"1.28em"});	
								a[item.Product.element]['futureday'].html(item.Product.status);
							}
							else
							{
								if(item.settingIncrement.timestamp == 1){
									//a[item.Product.element].remove();
								}
							}
							break;	
						case 1:			
							a[item.Product.element]['bidme_link'].show();
							
							if(item.settingIncrement.timestamp <= 10 && item.settingIncrement.timestamp > 0){				
								a[item.Product.element]['countdown'].addClass("countdown_red");
							}
							else{
								a[item.Product.element]['countdown'].removeClass("countdown_red");	
								
							}
							if(a['status']==6)
							{
								/*saveover=item.Product.extras.product_cost - item.Product.price;
								saveover = (saveover < 0)? 0 : saveover;
								saveover = item.Product.currency +" "+saveover;								
								$("#"+item.Product.element+" .saveover").html(saveover);*/
								saveover=item.Product.extras.savings;
								$("#"+item.Product.element+" .saveover").html(saveover);						
								pricepaid = item.Product.currency +" "+item.Product.price;
								$("#"+item.Product.element+" .pricepaid").html(pricepaid);
							}
							if(peak) {
							peak=false;
							if($(".productDetail").length){
										if(item.Users.lat!=""){
										
											rendergmap = true;
											(a['status']==6)?Auction.gmap(item.Users.lat,item.Users.lng):""; 
										}
										
							
										}
										}
							
							if(set>1){
							
								if(price!=item.Product.price){
								
									var auction_elements=$("#"+item.Product.element+" .countdown, #"+item.Product.element+" .currentprice, #"+item.Product.element+" .lastbidder");									
									auction_elements.hide();
									auction_elements.css({'backgroundColor':'#ffe373'});
									auction_elements.fadeIn(400, function () {
										$(this).css({'backgroundColor' : ''});
										
										if($(".productDetail").length){
										if(item.Users.lat!=""){
										
											rendergmap = true;
											(a['status']==6)?Auction.gmap(item.Users.lat,item.Users.lng):""; 
										}
										
							
										}
										
										 

									});
									
								}
							}
							$(".bidder_photo"+item.Product.id).attr("src",item.Product.user_img);								
							break;	
						case 2:
							a[item.Product.element]['countdown'].html(language.closed_text);
							a[item.Product.element]['bid'].hide();
							break;		
						case 3:							
							$("#"+item.Product.element+' .bidme_link').hide();
							(a['status']==6)?a[item.Product.element]['product_bidnow_link'].hide():"";
							$("#"+item.Product.element+' .bid').hide();
							//$("#"+item.Product.element+' .countdown').html(language.paused);
							break;							
					}					
					$("#"+item.Product.element+' .currentprice').html(item.Product.current_price);
					$("#"+item.Product.element+' .price').html(item.Product.price);
					(item.Product.lastbidder!=0)?$("#"+item.Product.element+' .lastbidder').html(item.Users.username):$("#"+item.Product.element+' .lastbidder').html(language.no_bids_yet);			
					var dy = item.Product.time_diff['day'];
					var hr = item.Product.time_diff['hr'];
					var mins = item.Product.time_diff['min'];
					var sec = item.Product.time_diff['sec'];
					var d = new Date();
					d.setHours(hr);
					d.setMinutes(mins);
					d.setSeconds(sec);
					mine = d.getTime();
					a[item.Product.element]['unix_timestamp'] =a['unix_timestamp']=item.Product.unix_timestamp;
					
					a[item.Product.element]['time_d_day'] = dy;
					a[item.Product.element]['time_d'] = mine;
					a[item.Product.element]['starttime']=item.Product.peaktiming[0];
					a[item.Product.element]['endtime']=item.Product.peaktiming[1];
					a[item.Product.element]['peakupdated']=item.Product.peakupdated;
					a[item.Product.element]['current_status']=item.Product.current_status;
					a[item.Product.element]['checking_time'] = item.Product.checking_time;
					a[item.Product.element]['timestamp_diff']=item.settingIncrement.timestamp;					
					a[item.Product.element]['current_status']=item.Product.current_status;
					a[item.Product.element]['lastbidders']=item.Product.lastbidder;
					a[item.Product.element]['resume_time']=language.resume_text+" "+item.Product.resume_time;

}

NAuction.prototype.timer_peakauction=function(auctionId,type)
{
	
	tsd = a[auctionId]['timestamp_diff'];
	
	if(a[auctionId]['current_status'] ==0)
	{
		
		Auction.timer_peakcountdown(auctionId,type);
	}
	else
	{
		//console.log(tsd);
		//console.log(a[auctionId]['unix_timestamp']+">"+a[auctionId]['starttime']);
		if(a[auctionId]['unix_timestamp'] > a[auctionId]['starttime'] && a[auctionId]['unix_timestamp'] < a[auctionId]['endtime'])
		{
				a[auctionId]['product_bidnow_link'].show();
				if(a[auctionId]['peakupdated'] == 0)
				{
					Auction.updateAuction(5,auctionId,type,{'updatepeak':1,'now':tsd});
				}
				Auction.timer_peakcountdown(auctionId,type);
					
		}
		else
		{
			a[auctionId]['countdown'].html(a[auctionId]['resume_time']);
			
			if(a[auctionId]['peakupdated'] == 1)
			{
				Auction.updateAuction(5,auctionId,type,{'updatepeak':0,'now':tsd});
			}
		
		}
	}
}

NAuction.prototype.timer_peakcountdown = function(auctionId,type)
{
		var condi_remove = function (){
				if(a['status'] != 6) {
					if(aj > closedremovetime)
					{
						console.log('Closed Updated');
						Auction.updateAuction(3,auctionId,type);						
						Auction.getauctionstatus(a['status'],"1");
						a[auctionId].remove();
						aj=0;
					}
					else
					{
						a[auctionId]['countdown'].html(language.closed_text);
						if(tsd < -(parseInt(a[auctionId]['checking_time'])+5)){
							a[auctionId]['bidme_link'].remove();
						}
					}
					}else{
						a[auctionId]['countdown'].html(language.closed_text);
						a[auctionId]['bidme_link'].remove();
						Auction.updateAuction(3,auctionId,type);
						a[auctionId]['product_bidnow_link'].remove();	
						}
			};		
			var countdownset =a[auctionId]['timestamp_diff'];
			//console.log(a[auctionId]['current_status']);
			if(a[auctionId]['current_status']!=0 && a[auctionId]['current_status']!=3)
			{		
					
				if (tsd > 0) {	
					var d = new Date();
					d.setTime(a[auctionId]['time_d']);
					end_time_string = Auction.countdown(d, a[auctionId]['time_d_day']);
					if(a[auctionId]['peakupdated'] == 0)
					{
						a[auctionId]['countdown'].html("Starting...");
					}
					else
					{
						a[auctionId]['countdown'].html(end_time_string);
					}
					if (countdownset < 10 && countdownset > 1) {
						a[auctionId]['countdown'].css({'background-color':'#ff0000', 'padding-left':'2px', 'padding-right':'2px'});
					}
					else if (countdownset < 1 && countdownset > -(parseInt(a[auctionId]['checking_time']))) {
						
						a[auctionId]['countdown'].removeAttr('style');
						a[auctionId]['countdown'].html(language.checking+'...');						
					}
					else if (countdownset < -(parseInt(a[auctionId]['checking_time']))) {						
						aj++;
						condi_remove();
					}
					
				} else {
					if (countdownset < 1 && countdownset > -(parseInt(a[auctionId]['checking_time']))) {						
						a[auctionId]['countdown'].removeAttr('style');
						a[auctionId]['countdown'].html(language.checking+'...');						
					}
					else if(countdownset < -(parseInt(a[auctionId]['checking_time'])))
					{
						if(tsd < -(parseInt(a[auctionId]['checking_time'])+5)){
							aj++;
							condi_remove();							
						}
						else
						{
							a[auctionId]['countdown'].html('Closing...');	
						}
					}
				}
			}
			else if(a[auctionId]['current_status']==3)
			{
				a[auctionId]['countdown'].html(language.paused);	
			}
			else
			{
			
				if(a[auctionId]['lastbidders']==0)
				{					
					a[auctionId]['countdown'].html(language.comingsoon_text);		
					
					
					if(countdownset < 2){
							console.log('New Auction Started');
							console.log(a['status']);
							Auction.updateAuction(0,auctionId,type);
							(a['status'] != 6) ? a[auctionId].remove() : "";
					}								
				}
				else if(a[auctionId]['lastbidders']!=0)
				{					
						
					a[auctionId]['countdown'].html(a[auctionId]['resume_time']);	
					if(countdownset < 2){
						console.log('Auction is resumed');
						Auction.updateAuction(2,auctionId,type);
						Auction.getauctionstatus(5,"1");
					}
				}
				else
				{
					if(countdownset == 1){						
						Auction.updateAuction(3,auctionId,type);
						condi_remove();
					}
				}
			}
			a[auctionId]['time_d'] = a[auctionId]['time_d'] -1000 ;		
			a[auctionId]['timestamp_diff'] = a[auctionId]['timestamp_diff'] - 1;
}

