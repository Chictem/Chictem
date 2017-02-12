<?php

return [


	'dashboard' => [
		'user' => [
			'display' => '用户',
			'message' => '有 :number 位注册用户, 点击查看所有用户列表',
			'button' => '查看所有用户'
		],
		'post' => [
			'display' => '内容',
			'message' => '有 :number 篇内容, 点击查看所有内容列表',
			'button' => '查看所有内容'
		],
		'page' => [
			'display' => '页面',
			'message' => '有 :number 个页面, 点击查看所有页面',
			'button' => '查看所有页面'
		],
	],

	'profile' => [
		'button' => [
			'edit' => '编辑我的资料'
		]
	],

	'user' => [
		'name' => '用户',
		'attribute' => [
			'name' => '姓名',
			'email' => '电子邮件',
			'password' => '密码',
			'avatar' => '头像',
			'banner' => '头图',
			'role' => '管理员',
			'created_at' => '创建时间',
		],
		'message' => [
			'password' => '留空则保留原来的密码'
		]

	],

	'menu_builder' => [
		'name' => '菜单设置',
		'message' => [
			'arrange' => '拖拽菜单可以重新排序',
		]
	],

	'menu' => [
		'message' => [
			'use' => '你可以在程序中调用 :usage 来使用菜单'
		]
	],

	'banner_builder' => [
		'name' => '图文设置',
		'message' => [
			'arrange' => '拖拽图文可以重新排序',
		]
	],

	'banner' => [
		'message' => [
			'use' => '你可以在程序中调用 :usage 来使用菜单'
		]
	],


	'database' => [
		'name' => '数据库',
		'attribute' => [
			'name' => '表名',
			'bread' => '增删改查设置'
		],
		'button' => [
			'edit' => '修改BREAD设置',
			'delete' => '删除BREAD设置',
			'add' => '添加BREAD设置',
			'add_table' => '新建表'
		]
	],

	'setting' => [
		'name' => '配置',
		'message' => [
			'use' => '你可以在程序中调用 :usage 来使用菜单'
		]
	]

];
