<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Modulename — My own custom module.
 *
 * @package    Commonfunction
 * @category   Base
 * @author     Myself Team
 * @copyright  (c) 2012 Myself Team
 * @license    http://kohanaphp.com/license.html
 */
class Kohana_Scratch extends Controller_Site_Scratch {
	
	/**
	* @var array configuration settings
	*/
	protected $_config = array();
	protected $_scratchauction ;

	/**
	* Class Main Constructor Method
	* This method is executed every time your module class is instantiated.
	*/
	public function __construct() 
	{	
		$this->session=Session::instance();
		$this->scratchauction_model = Model::factory('scratch');	
		$this->checking_time=CHECKING_TIME;
		$this->getCurrentTimeStamp=Commonfunction::getCurrentTimeStamp();
		$this->site_currency =SITECURRENCY;
		$this->update_autobid_account();
	}
	
	public function timediff($time)
	{
                	
                /*	
                $tDiff = $time + time();
		$days = floor($tDiff / 86400);//Calc Days
		$hours = ($tDiff / 3600) % 24;//Calc hours
		$mins = ($tDiff / 60) % 60;//Calc mins
		$secs = ($tDiff) % 60;//Calc Secs */

                $now = strtotime ("now");
                $then = strtotime ($time);
                $difference = $now - $then ;
                $num = $difference/86400;
                $days = intval($num);
                $num2 = ($num - $days)*24;
                $hours = intval($num2);
                $num3 = ($num2 - $hours)*60;
                $mins = intval($num3);
                $num4 = ($num3 - $mins)*60;
                $secs = intval($num4);
		return array('day' => $days , 'hr' => $hours , 'min' => $mins, 'sec' => $secs);
	}
	
	/**
	 * ****Checking current status of the auction item****
	 * @param $sdate , $edate eg. 2011-11-16 20:15:00
	 * @return 0 1 2
	 */	
	public function currentstatus($sdate,$edate)
	{
		$currentdate=$this->getCurrentTimeStamp;
		$today=date("Y-m-d")." "."23:59:59";
		if($sdate > $currentdate)
		{
			return 0;//Coming soon
		}
		else if($sdate < $currentdate)
		{
			return 1;//live
		}
		else if($edate < $currentdate)
		{
			return 2;//closed
		}
	}
	
	public function update_autobid_account()
	{
		
		$result=$this->scratchauction_model->selectall_autobid_closed();
		
		foreach($result as $products)
		{
			if($products['dedicated_auction']!=ENABLE){
				//get user balance and add the amount
				$amts= Commonfunction::get_user_balance($products['userid']) + $products['bid_amount'];
			}
			else
			{
				//get user bonus and add the amount
				$amts=Commonfunction::get_user_bonus($products['userid'])+$products['bid_amount'];
			}			
			$this->scratchauction_model->update(USERS,array('user_bid_account'=>$amts),'id',$products['userid']);
			$this->scratchauction_model->delete_autobid($products['userid'],$products['product_id']);
		}
		return;
	}
	
	public function process($pid,$status=1,$array=array())
	{				
	
		$product_results = $this->scratchauction_model->select_products_detail($pid,$status,$array);
		$array=array();	
		foreach($product_results  as $product_result)
		{
			/*if($this->getCurrentTimeStamp<=$product_result['enddate'])
			{*/
				if($product_result['auction_process']==RESUMES)
				{
					//Decrement the db timestamp with current timestamp (unix timestamp e.g: 1236545888)
					$time_stamp=$product_result['increment_timestamp']-time();					
				}
				else if($product_result['auction_process']==HOLD)
				{
					//increment the db timestamp when holded (unix timestamp e.g: 1236545888)
					$time_stamp=$product_result['increment_timestamp']+20;
					//$current_status=3;
					$time=__('paused');
				}
				$time_stamp=$product_result['increment_timestamp']-time();
                                $current_status=$this->currentstatus($product_result['startdate'],$product_result['enddate']);
                                 /*$current_status=$this->currentstatus($product_result['startdate']);*/
				$today=$this->today_midnight();
				$status=($today>$product_result['increment_timestamp'])?__("start_on_label_today")." ".substr($this->date_to_string($product_result['startdate']),7,20):__("start_on_label")." ".$this->date_to_string($product_result['startdate']);
						$resume_time=($today>$product_result['increment_timestamp'])?substr($this->date_to_string($product_result['startdate']),7,20):$this->date_to_string($product_result['startdate']);
						
				if(($product_result['photo'])!="" && file_exists(DOCROOT.USER_IMGPATH_THUMB.$product_result['photo']))
				{ 
					$user_img_path=URL_BASE.USER_IMGPATH_THUMB.$product_result['photo'];
				}
				else
				{
					$user_img_path=IMGPATH.USER_NO_IMAGE;
				}
                       
                       
                $array[]= array("Product"=> array("id"=>$product_result['product_id'],
                        "currency"=>$this->site_currency,
                        "current_price"=>$this->site_currency." ".Commonfunction::numberformat($product_result['current_price']),
                        "price" =>Commonfunction::numberformat($product_result['current_price']),
                        "current_status" =>$current_status,
                        "extras"=>array('bidamount' => $product_result['bidamount'],'product_cost'=> $product_result['product_cost']),
                        "status"=>$status,
                        "user_bid_count" =>$product_result['timetobuy'],
                        "auction_type" => $product_result['auction_type'],
                        "resume_time" =>$resume_time,
                        "db_timestamp" => $product_result['increment_timestamp'],
                        "element" =>"auction_".$product_result['product_id'],
                        "lastbidder"=>$product_result['lastbidder_userid'],
                        "user_img" =>$user_img_path,
                        "autobid" =>$product_result['autobid'],
                        // "time_diff" => $this->timediff($product_result['increment_timestamp']),
                        "time_diff" => $this->timediff($product_result['startdate']),
                        "unix_timestamp" =>$this->create_timestamp($this->getCurrentTimeStamp),
                        "element"=>"auction_".$product_result['product_id'],								
                        "checking_time" =>$this->checking_time),
                        "settingIncrement" => array("countdown"=>time()+$product_result['max_countdown'],
                        //'time_left'=>$time,
                        'timestamp' =>$time_stamp),
                        "Users"=>array("username"=>ucfirst(Text::limit_chars($product_result['username'],12)),
                        "lat"=>$product_result['latitude'],
                        "lng"=>$product_result['longitude']));	
                       // }
                }
                return $array;
	}
	
		
	public static function product_block($pids,$status="",$arrayset=array())
	{
		$scratchauction = Model::factory('scratch');		
		$productsresult = $scratchauction->select_products_detail($pids,$status,$arrayset);
                $user_id = Session::instance()->get('auction_userid');
		switch($status)
		{
			case 3:
			$view = View::factory('scratch/'.THEME_FOLDER.'auctions/future')
							->set('productsresult', $productsresult)
							->set('status',$status);
							break;
			case 6:
                        $productid=$productsresult[0]['product_id'];
			$bid_count= $scratchauction->select_bid_history_count_details($productid);
                       // $bid_count=0;
			$view = View::factory('scratch/'.THEME_FOLDER.'auctions/product_detail')
							->set('productsresult', $productsresult)
                                                        ->set('bid_count',$bid_count)							
							->set('status',$status);
							break;
			case 2:
			$view = View::factory('scratch/'.THEME_FOLDER.'auctions/closed')
							->set('productsresult', $productsresult)
							->set('status',$status);
							break;
			case 10:
			$view = View::factory('scratch/'.THEME_FOLDER.'auctions/winner')
							->set('productsresult', $productsresult)
							->set('status',$status);
							break;
			case 8:
			$view = View::factory('scratch/'.THEME_FOLDER.'auctions/closedunclosed')
							->set('productsresult', $productsresult)
							->set('status',$status);
							break;
                        case 11:
			$view = View::factory('scratch/'.THEME_FOLDER.'auctions/buynow')
							->set('productsresult', $productsresult)
							->set('status',$status);
							break;
			default:
			$view = View::factory('scratch/'.THEME_FOLDER.'auctions/live')
							->set('productsresult', $productsresult)
							->set('status',$status);
							break;
		}					
		return $view->render();
	}
	
	
}
