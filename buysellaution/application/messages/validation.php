<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'alpha'         => __(':field').' '.__('validate.alpha'),
	'alpha_dash'    => __(':field').' '.__('validate.alpha_dash'),
	'alpha_space'   => __(':field').' '.__('validate.alpha_space'),
	'alpha_numeric' => __(':field').' '.__('validate.alpha_numeric'),
	'color'         => __(':field').' '.__('validate.color'),
	'credit_card'   => __(':field').' '.__('validate.credit_card'),
	'date'          => __(':field').' '.__('validate.date'),
	'decimal'       => __(':field').' '.__('validate.decimal'),
	'digit'         => __(':field').' '.__('validate.digit'),
	'email'         => __(':field').' '.__('validate.email'),
	'email_domain'  => __(':field').' '.__('validate.email_domain'),
	'equals'        => __(':field').' '.__('validate.equals'),
	'exact_length'  => __(':field').' '.__('validate.exact_length'),
	'in_array'      => __(':field').' '.__('validate.in_array'),
	'ip'            => __(':field').' '.__('validate.ip'),
	'matches'       => __('validate.matches'),
	'min_length'    => __(':field').' '.__('validate.min_length'),
	'max_length'    => __(':field').' '.__('validate.max_length'),
	'not_empty'     => __(':field').' '.__('validate.not_empty'),
	'numeric'       => __(':field').' '.__('validate.numeric'),
	'phone'         => __(':field').' '.__('validate.phone'),
	'range'         => __(':field').' '.__('validate.range'),
	'regex'         => __(':field').' '.__('validate.regex'),
	'not_numbers'         => __(':field').' '.__('validate.not_numbers'),	
	'url'           => __(':field').' '.__('validate.url'),
	'user_id'       => __(':field').' '.__('validate.user_id'),
	'Upload::valid'    	=> __(':valid msg'),
	//'Upload::not_empty'    	=> __(':not_empty msg'),
	'Upload::not_empty'    	=> __('image not empty'),
	'Upload::type'    	=> __(':type msg'),
	'Upload::size'    	=> __(':size msg'),
	'default'  		=> __(':default msg'),
	'Model_Users::check_email' => __('email_not_in_database'),
	'Model_Users::unique_email' => __('email_exists'),
	'Model_Users::unique_username' => __('username_exists'),
	'Model_Users::check_label_not_empty' =>__(':field').' '.__('validate.not_empty'),
	'Model_Users::check_country_not_null' =>__(':field').' '.__('has to be selected'),
	'Model_users::check_pass' =>__('oldpassword_error'),
	'Model_Auction::autobid_already_exists'=>__('autobid_already_exists'),
	'Model_Users::notempty' =>__(':field').' '.__('validate.alpha_dash'),
	'Model_Adminproduct::start_datevalidate'=>__('validate.startdate_validate'),
	'Model_Auction::check_label_not_empty' =>__(':field').' '.__('validate.not_empty'),
	'Model_Auction::check_userbid_morethan'=>__('autobid amtcheck_userbid_morethan'),	
	'Model_Adminproduct::product_decimal_check'=>__(':field').' '.__('validate.biddamount_decimal_check'),
	'Model_Adminproduct::maxcountdown'=>__('maxcountdown_greater_lable'),
	'Model_Adminproduct::server_cuurent_time_validate'=>__(':field').' '.__('server_time_validate_startdate'),
	'Model_Auction::ab_product_current_price'=>__('autobid_greater_than_currentprice'),
	//selvam-May 9-2013
	'check_field_table'           => __('validate.check_field_table').' '.__(':field'),
	'check_no_of_use_table' =>__(':field').' '. __('validate.check_no_of_use_table'),
	'custom_range'       => __(':field').' '.__('validate.custom_range'),
	'out_of_range'       => __(':field').' '.__('validate.out_of_range'),
	'custom_numeric'       => __('validate.custom_numeric'),
	'custom_price_numeric'       => __('validate.custom_price_numeric'),
	'check_cc'       => __('validate.check_cc'),
    'luhn_check'=>__('validate.luhn_check'),
);?>
