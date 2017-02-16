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
			'image' => '头像',
			'banner' => '头图',
			'role' => '管理员',
			'created_at' => '创建时间',
		],
		'message' => [
			'password' => '留空则保留原来的密码'
		]

	],

	'media' => [
		'name' => '媒体库',
		'button' => [
			'add_folder' => '新建文件夹',
		    'destination' => '目标文件夹',
		    'title' => '名称',
		    'type' => '类型',
		    'size' => '大小',
		    'url' => '链接',
		    'updated_at' => '修改时间',
		],
	    'message' => [
		    'empty' => '没有文件',
	        'unselected' => '没有选择文件或文件夹',
	        'unsupported' => '不支持该媒体类型',
		    'delete' => '您确定要删除:name吗?',
	        'confirm' => '您确定吗？',
	        'drag_upload' => '拖动至此上传文件',
	        'loading' => '正在加载',
	        'new_folder' => '新文件夹'
	    ]
	],

	'menu_builder' => [
		'name' => '菜单设置',
		'attribute' => [
			'title' => '标题',
		    'url' => '链接',
		    'icon' => '图标',
		    'color' => '颜色',
		    'open' => '打开方式',
		    'self' => '当前页面',
		    'new' => '新页面',
		    'class' => '图标参考'
		],
		'message' => [
			'arrange' => '拖拽菜单可以重新排序',
			'create' => '创建菜单项',
		    'edit' => '编辑菜单项'
		]
	],

	'menu' => [
		'message' => [
			'use' => '你可以在程序中调用 :usage 来使用菜单',
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
		'attribute' => [
			'name' => '名称',
		    'key' => '键值',
		    'type' => '类型',
		    'option' => '选项',
		    'valid' => '有效格式',
		    'invalid' => '无效格式'
		],
		'message' => [
			'use' => '你可以在程序中调用 :usage 来使用菜单',
		    'option' => '高级配置，适用于下拉框、复选框的高级配置'
		]
	]

];
