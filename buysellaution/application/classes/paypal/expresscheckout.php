<?php defined('SYSPATH') or die('No direct script access.');

/**
 * PayPal ExpressCheckout integration.
 *
 * @see  https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_ECGettingStarted
 *
 * @Package: Nauction Platinum Version 1.0
 * @Created on October 24, 2012
 * @Updated on October 24, 2012
 * @Author: NDOT Team
 * @copyright  (c) 2009 Kohana Team
 * @license    http://kohanaphp.com/license.html 
 */
class PayPal_ExpressCheckout extends PayPal {

	// Default parameters
	protected $_default = array(
		'PAYMENTACTION' => 'Sale',
	);

    public function DoExpressCheckoutPayment(array $params)
    {
        $required = array('PAYERID','TOKEN','AMT');      
        $params += $this->_default;
        
        foreach ($required as $key) {

            if ( ! isset($params[$key])) {
	
		/* throw new Kohana_Exception('You must provide a :param parameter for :method',
		array(':param' => $key, ':method' => __METHOD__));*/

		$this->session->set('paypal_error','Paypal Error : You must provide a :param parameter for :method',
		array(':param' => $key, ':method' => __METHOD__));
		return 0;
            }
        }
        
        return $this->_post('DoExpressCheckoutPayment', $params);
    }
    
    public function GetExpressCheckoutDetails(array $params)
    {
		
        $required = array('TOKEN');
        
        $params += $this->_default;
        
        foreach ($required as $key) {
            if ( ! isset($params[$key])) {

		/*
		throw new Kohana_Exception('You must provide a :param parameter for :method',
		array(':param' => $key, ':method' => __METHOD__));
		*/
	
		$this->session->set('paypal_error','Paypal Error : You must provide a :param parameter for :method',
		array(':param' => $key, ':method' => __METHOD__));
		return 0;
            }
        }
        
        return $this->_post('GetExpressCheckoutDetails', $params);
    }

	/**
	* Make an SetExpressCheckout call.
	*
	* @param  array   NVP parameters
	*/
	public function set(array $params = NULL)
	{			
			if ($params === NULL)
			{ 
				
				// Use the default parameters
				$params = $this->_default;
			}
			else
			{
				
				// Add the default parameters				
				$params+= $this->_default;
			}
		
			if ( ! isset($params['AMT']))
			{
				/*
				throw new Kohana_Exception('You must provide a :param parameter for :method',
					array(':param' => 'AMT', ':method' => __METHOD__));
				*/
			
				$this->session->set('paypal_error','Paypal Error : You must provide a :param parameter for :method',
				array(':param' => $key, ':method' => __METHOD__));
				return 0;
			}	
		
		return $this->_post('SetExpressCheckout', $params);
	}

} // End PayPal_ExpressCheckout
