function checkdefined(e){if(typeof e!=="undefined"){return e}return""}function GetIndexByValue(e,t){var n="";var r=-1;for(var i in e){if(e[i]==t){r=i;return r}}}var scratchcounter="";if(typeof NAuction!=="undefined"){NAuction.prototype.scratch=function(e){var t=$("#"+e.Product.element+" .price").html();switch(e.Product.current_status){case 0:if(e.Product.lastbidder==0){a[e.Product.element]["bid"].hide();a[e.Product.element]["countdown"].html(language.comingsoon_text);a[e.Product.element]["futureday"].html(e.Product.status);a[e.Product.element]["comingsoon"].show(1)}else if(e.Product.lastbidder!=0){a[e.Product.element]["bidme_link"].hide();a[e.Product.element]["countdown"].html(language.resume_text+" "+e.Product.resume_time);a[e.Product.element]["countdown"].css({"font-size":"1.28em"});a[e.Product.element]["futureday"].html(e.Product.status)}else{}break;case 1:a[e.Product.element]["bidme_link"].show();if(e.settingIncrement.timestamp<=10&&e.settingIncrement.timestamp>0){a[e.Product.element]["countdown"].addClass("countdown_red")}else{a[e.Product.element]["countdown"].removeClass("countdown_red")}if(a["status"]==6){saveover=e.Product.extras.product_cost-e.Product.price;saveover=saveover<0?0:saveover;saveover=e.Product.currency+" "+saveover;$("#"+e.Product.element+" .saveover").html(saveover);pricepaid=e.Product.currency+" "+e.Product.price;$("#"+e.Product.element+" .pricepaid").html(pricepaid);userbidcount=e.Product.user_bid_count}if(set>1){if(t!=e.Product.price){var n=$("#"+e.Product.element+" .countdown, #"+e.Product.element+" .currentprice, #"+e.Product.element+" .lastbidder");n.hide();n.css({backgroundColor:"#ffe373"});n.fadeIn(400,function(){$(this).css({backgroundColor:""});if($(".productDetail").length){if(e.Users.lat!=""){}}})}}$(".bidder_photo"+e.Product.id).attr("src",e.Product.user_img);break;case 2:a[e.Product.element]["countdown"].html(language.closed_text);a[e.Product.element]["bid"].hide();break;case 3:$("#"+e.Product.element+" .bidme_link").hide();a["status"]==6?a[e.Product.element]["product_bidnow_link"].hide():"";$("#"+e.Product.element+" .bid").hide();$("#"+e.Product.element+" .countdown").html(language.paused);break}$("#"+e.Product.element+" .currentprice").html(e.Product.current_price);$("#"+e.Product.element+" .price").html(e.Product.price);e.Product.lastbidder!=0?$("#"+e.Product.element+" .lastbidder").html(e.Users.username):$("#"+e.Product.element+" .lastbidder").html(language.no_bids_yet);$("#"+e.Product.element+" #bid_count").html(e.bid_history_count);var r=e.Product.time_diff["day"];var i=e.Product.time_diff["hr"];var s=e.Product.time_diff["min"];var o=e.Product.time_diff["sec"];var u=new Date;u.setHours(i);u.setMinutes(s);u.setSeconds(o);mine=u.getTime();a["unix_timestamp"]=e.Product.unix_timestamp;a[e.Product.element]["time_d_day"]=r;a[e.Product.element]["time_d"]=mine;a[e.Product.element]["checking_time"]=e.Product.checking_time;a[e.Product.element]["timestamp_diff"]=e.settingIncrement.timestamp;a[e.Product.element]["current_status"]=e.Product.current_status;a[e.Product.element]["lastbidders"]=e.Product.lastbidder;a[e.Product.element]["resume_time"]=language.resume_text+" "+e.Product.resume_time};NAuction.ScratchBid=function(e,t,n,r){var i="";var n=n||"";var r=r||"";if(r!="")f=$("#"+r).length>0?$("#"+r).serializeArray():"";else f=$("#bidform").length>0?$("#bidform").serializeArray():"";var s=n!=""?{pid:t,timestamp:n,formvalues:f}:{pid:t,formvalues:f};typeof t!="object"?$(".loader"+t).show():"";$.ajax({url:e,cache:false,type:"get",dataType:"jsonp",timeout:5e3,data:s,contentType:"application/json; charset=utf-8",complete:function(e,t){},success:function(e){var n=$(".bid").attr("title");var r=$("#notice_msg"+e.id);$(".loader"+e.id).hide();Auction.check_userbalance();Auction.check_userbonus();if(e.Message===null&&e.Bid_count>0){Auction.customscript(GetIndexByValue(auction_types,"scratch"),"buynow",{pid:t});Auction.getauctionstatus(a["status"],"1",a["pid"]);Auction.bidhistory()}else{$(r).show();$(r).html(e.Message);$(r).fadeOut(5e3)}},error:function(e,t,n){Auction.showConsole(n)}})};NAuction.prototype.customscript=function(auction_type,fname,param){if(auction_type!==""){var fun="Auction."+fname+"_"+auction_types[auction_type];try{if(typeof eval(fun)==="function")window["Auction"][fname+"_"+auction_types[auction_type]](param)}catch(e){Auction.showConsole(e)}}};NAuction.prototype.timer_scratch=function(e,t){tsd=a[e]["timestamp_diff"];var n=function(){if(a["status"]!=6){if(aj>closedremovetime){Auction.updateAuction(3,e,t);Auction.getauctionstatus(a["status"],"1");a[e].remove();aj=0}else{a[e]["countdown"].html(language.closed_text);if(tsd<-(parseInt(a[e]["checking_time"])+5)){a[e]["bidme_link"].remove()}}}else{a[e]["countdown"].html(language.closed_text);a[e]["bidme_link"].remove();Auction.updateAuction(3,e,t);a[e]["product_bidnow_link"].remove()}};var r=a[e]["timestamp_diff"];if(a[e]["current_status"]!=0&&a[e]["current_status"]!=3){if(tsd>0){var i=new Date;i.setTime(a[e]["time_d"]);end_time_string=Auction.countdown(i,a[e]["time_d_day"]);a[e]["countdown"].html(end_time_string);if(r<10&&r>1){a[e]["countdown"].css({"background-color":"#ff0000","padding-left":"2px","padding-right":"2px"})}else if(r<1&&r>-parseInt(a[e]["checking_time"])){a[e]["countdown"].removeAttr("style");a[e]["countdown"].html(language.checking+"...")}else if(r<-parseInt(a[e]["checking_time"])){aj++;n()}}else{if(r<1&&r>-parseInt(a[e]["checking_time"])){a[e]["countdown"].removeAttr("style");a[e]["countdown"].html(language.checking+"...")}else if(r<-parseInt(a[e]["checking_time"])){if(tsd<-(parseInt(a[e]["checking_time"])+5)){aj++;n()}else{a[e]["countdown"].html("Closing...")}}}}else if(a[e]["current_status"]==3){console.log("sd");a[e]["countdown"].html(language.paused)}else{if(a[e]["lastbidders"]==0){a[e]["countdown"].html(language.comingsoon_text);if(r<2){console.log("New Auction Started");Auction.updateAuction(0,e,t);a["status"]!=6?a[e].remove():""}}else if(a[e]["lastbidders"]!=0){a[e]["countdown"].html(a[e]["resume_time"]);if(r<2){console.log("Auction is resumed");Auction.updateAuction(2,e,t);Auction.getauctionstatus(5,"1")}}else{if(r==1){Auction.updateAuction(3,e,t);n()}}}a[e]["time_d"]=a[e]["time_d"]+1e3;a[e]["timestamp_diff"]=a[e]["timestamp_diff"]-1};NAuction.prototype.scratchbuynow=function(e){a["scratchcount"]=a["scratchcount"]-1;$(".scratchbuycountdown p span.showcountdown").text(a["scratchcount"]);if(a["scratchcount"]<=0){$(".scratchbuycountdown").hide();clearInterval(scratchcounter);$.ajax({url:baseurl+"site/scratch/timetobuy_update/",type:"get",data:"pid="+e,cache:false,contentType:"application/x-www-form-urlencoded;charset=ISO-8859-15",complete:function(e){a["scratchcount"]=e.responseText;alert("Time is over!")}});$(".buynowok").show();$("#show_pric").hide();return}};NAuction.prototype.buynow_scratch=function(e){$(".buynowok").hide();$(".example1").hide();scratchcounter=setInterval(function(){Auction.scratchbuynow(e["pid"])},1e3);$(".scratchbuycountdown").show()}}$(function(){$(".popup_close, .cancel_scratch").live("click",function(){$("#fade, #box").fadeOut()});$(".scratchbid").live("click",function(){var e=$(this).attr("name");var t=$(this).attr("id");var n=typeof $(this).attr("data-formid")!==undefined?$(this).data("formid"):"";var r=$(this).data("auctiontype");var i=baseurl+modulebidurl+auction_types[r]+"/bid";if(!a["auction_"+t]["bid"].hasClass("new_block")){NAuction.ScratchBid(i,t,a["auction_"+t]["timestamp_diff"],n)}});$(".bidding_inner ul li:last").after('<li><a href="#" title="'+language.auction_scratch_label+'" class="scratch_icon1">'+language.auction_scratch_label+"</a></li>");$(".user_panel_list ul li:nth-child(9),.dash_lsd ul li:nth-child(9)").after('<li class="fl clr "><a href="'+language.baseurl+'site/scratch/scratchlist" title="'+checkdefined(language.auction_scratch_won)+'"  id="scratchactive">'+checkdefined(language.auction_scratch_won)+"</a></li>");if(!$(".user").html()){$("#dialog_link").mouseover(function(){$(this).html(language.login_labels);$(this).click(function(){window.location=$(this).attr("rel")})});$("#dialog_link").mouseout(function(){$(this).html(language.bid_me_label)})}$("#yourbidding").keyup(function(){$(this).val()!=""?$(this).css({"border-color":"#ccc"}):""});if($(".user").html()){$("#dialog_link").click(function(){if($("#yourbidding").val()!=""){var e=$(this).attr("data-pid");var t=$(this).attr("data-rel").length>0?$(this).attr("data-rel"):$(this).attr("rel");$("#"+t).fadeIn();$("body").append('<div id="fade"></div>');$("#fade").css({filter:"alpha(opacity=80)"}).fadeIn();var n=($("#"+t).height()+10)/2;var r=($("#"+t).width()+10)/2;$("#"+t).css({position:"fixed"});$("#sample").text($("#yourbidding").val())}else{$("#yourbidding").css({border:"1px solid red"})}return false})}})