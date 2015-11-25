<?php
/**
 * Created by PhpStorm.
 * User: mason.ding
 * Date: 2015/11/10
 * Time: 10:43
 */

return [
    'pageTitle' => '牛妞小店的管理后台',
    'nav' => [
      'leftNav' => [
          'product' => '产品管理',
          'activities' => '活动管理',
      ],
      'rightNav' => [
          'login' => '登　录',
          'logout' => '登　出',
          'welcome' => '欢迎',
      ],
    ],
    'banner' => [
        'title' => '牛妞小店的管理后台',
        'content' => '作为搞技术的老公我，能帮助老婆的只有给她做个管理系统，方便她壮大自己的小生意吧。',
    ],
    'index' => [
        'title' => '管理我的小店',
        'productAdminInfo' => '在这里，你可以添加新的产品数据，也可以修改或删除现有产品的数据',
        'activityAdminInfo' => '在这里，你可以添加新的活动数据，也可以修改或删除现有活动的数据'
    ],
    'products' => [
        'productList' => [
            'title' => '产品列表',
            'edit' => '修改',
            'pInfo' => [
                'thumbnail' => '图片',
                'name' => '名称',
                'subtitle' => '描述',
                'price' => '售价',
                'operation' => '操作'
            ],
        ],
        'addNewProduct' => [
            'title' => '新增产品',
            'form' => [
                'pName' => '名称',
                'pNameTip' => '请输入产品名称',
                'pSubtitle' => '副标题',
                'pSubtitleTip' => '请输入副标题',
                'pImg' => '图片',
                'pCategory' => '类型',
                'pPrice' => '零售价',
                'pPriceTip' => '请输入零售价格',
                'pWholesalePrice' => '代理价',
                'pWholesalePriceTip' => '请输入代理价格',
                'pCount' => '数量',
                'pCountTip' => '请输入数量',
                'pDescription' => '介绍',
                'pDescriptionTip' => '请输入简单的产品介绍',
                'pAdd' => '添加'
            ],
            'errors' => [
                'title' => '填写产品信息有误，以下是错误详情',
                'addError' => '产品添加失败',
            ]
        ],
        'editProduct' => [
            'title' => '修改产品'
        ],
        'pagination' => '每页显示@件，共#件商品',
        'form' => [
            'mustFill' => '* 必填项',
            'mustSelect' => '* 必选',
            'recommend' => '建议填写'
        ]
    ]
];