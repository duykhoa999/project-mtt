<?php

return [
	'del_flag' => [
		'undelete' => 0,
		'deleted'  => 1
	],
	'active' => [
		'inactive' => 0,
		'active'   => 1
	],
	'feature' => [
		'notfeatured' => 0,
		'featured'   => 1
	],
	'trending' => [
		'notTrending' => 0,
		'trending'   => 1
	],
	'dealofdate' => [
		'notDOD' => 0,
		'DOD'   => 1
	],
	'active_title' => [
		0 => 'Inactive',
		1 => 'Active'
	],
    'status_order'=>[
        'new_order' => 'New order',
        'confirm' => 'Confirm',
        'to_receive' => 'To Receive',
        'receive_failed' => 'Receive failed',
        'receive_success' => 'Receive success'
    ],
    'order_status'=>[
        'new_order' => 0,
        'confirm' => 1,
        'to_receive' => 2,
        'receive_failed' => 3,
        'receive_success' => 4,
    ],
	'controller' => [
		'admin' => [
			'config' => 'admin.config',
			'image' => 'admin.image',
			'product' => 'admin.product',
			'customer' => 'admin.customer',
			'feeship'=> 'admin.feeship',
			'dashboard'=> 'admin.dashboard',
			'coupon' => 'admin.coupon',
			'category'=>'admin.category',
			'user'    =>'admin.user',
			'order' =>'admin.order',
			'manufacture' =>'admin.manufacture',
			'trademark' =>'admin.trademark',
			'category' =>'admin.category',
			'order' =>'admin.order',
			'company_order' =>'admin.company_order',
			'import' =>'admin.import',
			'coupon' =>'admin.coupon',
		]
	],
	'regex' => [
		'numeric'  => '/^[0-9]+$/',
		'alpha'    => '/^[a-zA-Z ]+$/',
		'alphaNumeric' => '/^[a-zA-Z0-9 ]+$/',
		'slug' => '/^[a-zA-Z0-9-]+$/',
		'script' => '/<[^>]*script/',
		'html_tag' => '/<[^<>]+>/'
	],
	'paginate' => [
		'customer_index' => 10,
		'image_index' => 10,
        'user_index' => 10,
        'category_index' => 10,
        'product_index' => 10,
        'coupon_index' => 10,
        'feeship_index' => 10,
        'list_order_user' => 10,
        'product_view'=>18,
        'manufactures_index'=>10,
        'company_order_index'=>10,
        'import_index'=>10,
	],
    'expires_time' => 5,
    'image_backup' => 'assets/images/avatar.png',
	'feature_product' => 5,
	'hot_product' => 10,
];
