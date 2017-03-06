<?php
date_default_timezone_set("PRC");
require_once(dirname(__FILE__) . "/../common/Request.class.php");
require_once(dirname(__FILE__) . "/../common/Cookies.class.php");
require_once(dirname(__FILE__) . "/../common/iwookongConfig.class.php");
require_once(dirname(__FILE__) . "/../common/CheckUserLogin.class.php");
require_once(dirname(__FILE__) . "/../common/Utility.class.php");
//if (CheckLogin::check() == -1) {
//    header("Location:../login.php ");
//    exit();
//}
$userCookie = new Cookies();
$userInfo = $userCookie->get(iwookongConfig::$usercookie);
if (isset($userInfo)) {
    $info = json_decode($userInfo, true);
    $userName = $info['user_name'];
    $uid = $info['user_id'];
    $token = $info['token'];
}else{
    $uid = '';
    $token = '';
}
//?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../static/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="../static/plugins/typeahead/jquery.typeahead.min.css">
    <link rel="stylesheet" href="<?php echo UtilityTools::AutoVersion('/static/css/common.min.css') ?>">
    <link rel="stylesheet" href="<?php echo UtilityTools::AutoVersion('/static/css/trade-sys/holdings.css') ?>">
    <link rel="stylesheet" href="<?php echo UtilityTools::AutoVersion('/static/css/trade-sys/trade.css') ?>">
    <link rel="stylesheet" href="<?php echo UtilityTools::AutoVersion('/static/css/trade-sys/analysis.css') ?>">
</head>
<body>
<nav class="wk-header">
    <div class="container wk-container">
        <div class="navbar-header navbar-brand">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <img src="/static/imgs/trade/logo.png">
            <spna class="navbar-title">模拟股票交易系统</spna>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="wk-nav-search">
                    <div class="typeahead__container">
                        <div class="typeahead__field"><span class="typeahead__query"> <input class="wk-head-search" type="search" placeholder="搜索(股票/行业/概念/事件)" autocomplete="off"> </span>
                            <span class="typeahead__button"> <button> <i class="typeahead__search-icon"></i> </button> </span>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right wk-nav-user">
                <li><a href="http://stock.iwookong.com/ajax/login/nologin.php?uid=<?php echo $uid ?>&token=<?php echo $token ?>" target="_blank">悟空首页</a></li>
                <li class="wk-nav-fuxi"><a href="#">&nbsp;|&nbsp;</a></li>
                <li><a href="../index.php" target="_blank">伏羲回测</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container wk-container wk-content">
    <!-- 左边菜单 -->
    <div class=" wk-nav-tabs left">
        <div class="wk-nav-hushen" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><img src="../static/imgs/trade/hushen.png">&nbsp;&nbsp;我的沪深</div>
        <ul class="nav" role="tablist" id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <li role="presentation" class="active myAccount"><a href="#attention" role="tab" data-toggle="tab">我的关注</a></li>
            <li role="presentation" class="myAccount"><a href="#holdings" role="tab" data-toggle="tab">我的账户</a>
                <ul role="tablist" id="collapseOne" class="panel-collapse collapse in  dropdown-menu myAccount-1" style="display: none">
                    <a href="#"><li role="presentation" class="change-name">我的账户1&nbsp<span class="glyphicon glyphicon-pencil"></span>&nbsp<span class="fa fa-trash-o"></span></li></a>
                    <a href="#"><li role="presentation">我的账户2&nbsp<span class="glyphicon glyphicon-pencil"></span>&nbsp<span class="fa fa-trash-o"></span></li></a>
                    <a href="#"><li role="presentation">我的账户3&nbsp<span class="glyphicon glyphicon-pencil"></span>&nbsp<span class="fa fa-trash-o"></span></li></a>
                    <a href="#"><li role="presentation">我的账户4&nbsp<span class="glyphicon glyphicon-pencil"></span>&nbsp<span class="fa fa-trash-o"></span></li></a>
                    <a href="#"><li role="presentation">我的账户5&nbsp<span class="glyphicon glyphicon-pencil"></span>&nbsp<span class="fa fa-trash-o"></span></li></a>
                </ul>
            </li>
            <li role="presentation" class="myAccount"><a href="#trade" role="tab" data-toggle="tab">模拟交易</a></li>
            <li role="presentation" class="myAccount"><a href="#analysis" role="tab" data-toggle="tab">收益分析</a></li>
        </ul>
    </div>
    <!-- 右边内容 -->
    <div class="tab-content wk-nav-content left">
        <!-- 我的关注 -->
        <section role="tabpane1" class="tab-pane active" id="attention">
            <ul class="group-name-list">
                <li class="left gp-active" data-gid="1">创业</li>
                <li class="left" data-gid="2">概念</li>
                <li class="left" data-gid="3">金融</li>
                <li class="left add-group trade-add-group" data-gid="-1">自定义<i class="fa fa-plus"></i></li>
                <div class="clear"></div>
            </ul>
            <hr>
            <div class="input-group">
            <div class="typeahead__container">
                <div class="typeahead__field">
                <span class="typeahead__query">
                    <span class="typeahead__cancel-button"></span>
                    <input class="wk-attention-search" type="search" placeholder="请输入股票代码" autocomplete="off">
                </span>
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                </div>
            </div></div>

            <!--账户股票列表-->
            <div class="group-stock-list table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <td>序号</td>
                        <td><input type="checkbox" class="left checkedAll"><span class="left">证券名称(代码)</span></td>
                        <td>股票名称</td>
                        <td>查看热度<img src="/static/imgs/trade/arrow_down.png" data-hot-sort="visit_heat" data-sort-type="desc" class="sort_img"></td>
                        <td>最新价<img src="/static/imgs/trade/arrow_down.png" data-hot-sort="price" data-sort-type="desc" class="sort_img"></td>
                        <td>涨跌幅<img src="/static/imgs/trade/arrow_down.png" data-hot-sort="change" data-sort-type="desc" class="sort_img"></td>
                        <td>成交量(万手)<img src="/static/imgs/trade/arrow_down.png" data-hot-sort="volume" data-sort-type="desc" class="sort_img"></td>
                        <td>行业</td>
                        <td class="bulk-trade-op">
                            操作(
                            <img src="../static/imgs/trade/op_buy.png"  data-toggle="modal" data-target="#bulk-trade-buy">
                            <img src="../static/imgs/trade/op_sale.png" data-toggle="modal" data-target="#bulk-trade-sale">
                            )
                        </td>
                        <td width="27px"></td>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input type="checkbox" class="left"><span class="left">000002</span></td>
                            <td>jjdjj</td>
                            <td>jjdjj</td>
                            <td>22</td>
                            <td>jjdjj</td>
                            <td>jjdjj</td>
                            <td>jjdjj</td>
                            <td><img src="../static/imgs/trade/op_buy.png" class="one-stock-trade" data-trade-type="1" href="#trade" data-toggle="tab"><img src="../static/imgs/trade/op_sale.png" class="one-stock-trade" data-trade-type="2" href="#trade" data-toggle="tab"></td>
                            <td><i class="fa fa-minus-circle text-danger btn-del-stock" data-stock-code="000002" data-stock-gid="1"></i></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><input type="checkbox" class="left"><span class="left">000003</span></td>
                            <td>jjdjj</td>
                            <td>jjdjj</td>
                            <td>33</td>
                            <td>jjdjj</td>
                            <td>jjdjj</td>
                            <td>jjdjj</td>
                            <td><img src="../static/imgs/trade/op_buy.png" class="one-stock-trade" data-trade-type="1" href="#trade" data-toggle="tab"><img src="../static/imgs/trade/op_sale.png" class="one-stock-trade" data-trade-type="2" href="#trade" data-toggle="tab"></td>
                            <td><i class="fa fa-minus-circle text-danger btn-del-stock" data-stock-code="000002" data-stock-gid="1"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--批量买-->
            <div class="modal fade" id="bulk-trade-buy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="bulk-trade-error">委托的总金额超出总资产</div>
                            <div>
                                委托价格：
                                <select>
                                    <option value="1">当前价格</option>
                                </select>
                            </div>
                            <div class="modal-trade-num">
                                委托数量：
                                <input type="number">手
                            </div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary bulk-trade-btn" data-dismiss="modal" data-trade-type="1">确定</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--批量卖-->
            <div class="modal fade" id="bulk-trade-sale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="bulk-trade-error">委托的总金额超出总资产</div>
                            <div>
                                委托价格：
                                <select>
                                    <option value="1">当前价格</option>
                                </select>
                            </div>
                            <div class="modal-trade-num">
                                委托数量：
                                <input type="number">手
                            </div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary bulk-trade-btn" data-dismiss="modal" data-trade-type="2">确定</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- 持仓 -->
        <section role="tabpanel" class="tab-pane" id="holdings">
            <div class="container-fluid index-container">
                <!--                上证指数-->
                <div class="row index-items"></div>
            </div>
            <div class="container-fluid index-container index-main">
                <div class="row encharts">
                    <div class="encharts_left col-md-4 col-sm-6">
                        <div id="profit" class="pull-left">
                        </div>
                        <div class=" profit-amount "><p class="redColor">65%</p>
                            <p>1笔盈利交易</p>
                        </div>
                    </div>

                    <div class='encharts_right col-md-6 col-sm-6'>
                        <div id="loss" class="pull-left">

                        </div>
                        <div class="loss-amount">
                            <p class="greenColor">35%</p>
                            <p>1笔亏损交易</p>
                        </div>
                    </div>
                </div>
                <!--用户资产信息-->
                <div class="container-fluid fund-data ">
                    <div class="row"></div>
                </div>
                <div class="dashed-line">
                </div>
                <div class="index-tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs index-tabs-items" role="tablist">
                        <li role="presentation" class="active"><a href="#index1" role="tab" data-toggle="tab">当前持仓</a></li>
                        <li role="presentation"><a href="#index2" role="tab" data-toggle="tab">当日委托</a></li>
                        <li role="presentation"><a href="#index3" role="tab" data-toggle="tab">当日成交</a></li>
                        <li role="presentation"><a href="#index4" role="tab" data-toggle="tab">历史成交</a></li>
                        <li role="presentation"><a href="#index5" role="tab" data-toggle="tab">对账单</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="index1">
                            <div class="table-responsive holdingStock">
                                <table class="table ">
                                    <thead>
                                    <tr>
                                        <td>序号</td>
                                        <td>证券名称（代码）</td>
                                        <td>当前持仓</td>
                                        <td>可用股数</td>
                                        <td>持仓成本</td>
                                        <td>最新价</td>
                                        <td>持股市值</td>
                                        <td>浮动盈亏</td>
                                        <td>盈亏比例</td>
                                        <td>仓位</td>
                                        <td>操作(<a href="#"><img src="../static/imgs/trade/op_buy.png" alt="">&nbsp<img src="../static/imgs/trade/op_sale.png" alt=""></a>)</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>华丽家族(600503)</td>
                                        <td>89955</td>
                                        <td>896</td>
                                        <td>8639</td>
                                        <td>8.54</td>
                                        <td>2669</td>
                                        <td>15%</td>
                                        <td>5%</td>
                                        <td>12%</td>
                                        <td><a href="#"><img src="../static/imgs/trade/op_buy.png" alt="">&nbsp<img src="../static/imgs/trade/op_sale.png" alt=""></a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>浙江东方(600120)</td>
                                        <td>87798</td>
                                        <td>896</td>
                                        <td>8439</td>
                                        <td>18.54</td>
                                        <td>664</td>
                                        <td>25%</td>
                                        <td>51%</td>
                                        <td>12%</td>
                                        <td><a href="#"><img src="../static/imgs/trade/op_buy.png" alt="">&nbsp<img src="../static/imgs/trade/op_sale.png" alt=""></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="index2">
                            <div class="toggle-responsive orderStock">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>序号</td>
                                        <td>证券名称(代码)</td>
                                        <td>买入/卖出</td>
                                        <td>委托价格</td>
                                        <td>委托数量</td>
                                        <td>委托时间</td>
                                        <td>成交状态</td>
                                        <td>操作</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>华丽家族(600503)</td>
                                        <td>买入</td>
                                        <td>8.54</td>
                                        <td>8000</td>
                                        <td>2017-3-03</td>
                                        <td>成交</td>
                                        <td>--</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>浙江东方(600120)</td>
                                        <td>买入</td>
                                        <td>600</td>
                                        <td>18.54</td>
                                        <td>2017-3-03</td>
                                        <td>成交</td>
                                        <td>--</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="index3">
                            <div class="table-responsive finishedOrder">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>序号</td>
                                        <td>证券名称(代码)</td>
                                        <td>买入/卖出</td>
                                        <td>成交价格</td>
                                        <td>成交数量</td>
                                        <td>成交金额</td>
                                        <td>成交时间</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>华丽家族(600503)</td>
                                        <td>买入</td>
                                        <td>8.54</td>
                                        <td>8000</td>
                                        <td>69200</td>
                                        <td>2017-3-03</td>

                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>浙江东方(600120)</td>
                                        <td>买入</td>
                                        <td>18.54</td>
                                        <td>600</td>
                                        <td>9184</td>
                                        <td>2017-3-03</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="index4">
                            <div class="table-responsive HistoryOrder">
                                <div class="query">
                                    <span>从</span><input type="text" onFocus="WdatePicker({lang:'zh-cn',maxDate:new Date()})"><span>到</span><input
                                        type="text" onFocus="WdatePicker({lang:'zh-cn',maxDate:new Date()})">
                                    <a href="#">查询</a>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>序号</td>
                                        <td>证券名称(代码)</td>
                                        <td>买入/卖出</td>
                                        <td>成交价格</td>
                                        <td>成交数量</td>
                                        <td>成交金额</td>
                                        <td>成交时间</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>华丽家族(600503)</td>
                                        <td>买入</td>
                                        <td>8.54</td>
                                        <td>8000</td>
                                        <td>69200</td>
                                        <td>2017-3-03</td>

                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>浙江东方(600120)</td>
                                        <td>买入</td>
                                        <td>18.54</td>
                                        <td>600</td>
                                        <td>9184</td>
                                        <td>2017-3-03</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="index5">
                            <div class="table-responsive statement">
                                <div class="query">
                                    <span class="">从</span><input type="text" onFocus="WdatePicker({lang:'zh-cn',maxDate:new Date()})"><span>到</span><input
                                        type="text" onFocus="WdatePicker({lang:'zh-cn',maxDate:new Date()})">
                                    <a href="#">查询</a>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>成交时间</td>
                                        <td>证券名称(代码)</td>
                                        <td>类型</td>
                                        <td>成交价格</td>
                                        <td>成交数量</td>
                                        <td>佣金</td>
                                        <td>印花税</td>
                                        <td>过户费</td>
                                        <td>发生金额</td>
                                        <td>可用资金</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>2017-3-03</td>
                                        <td>华丽家族(600503)</td>
                                        <td>类型</td>
                                        <td>8.54</td>
                                        <td>8000</td>
                                        <td>69</td>
                                        <td>59</td>
                                        <td>32</td>
                                        <td>69200</td>
                                        <td>58200</td>
                                    </tr>
                                    <tr>
                                        <td>2017-3-03</td>
                                        <td>浙江东方(600120)</td>
                                        <td>类型</td>
                                        <td>18.54</td>
                                        <td>600</td>
                                        <td>38</td>
                                        <td>45</td>
                                        <td>12</td>
                                        <td>69200</td>
                                        <td>58200</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                新闻列表-->
                <div class="wk-user-mynews" data-stock="00000x|" data-query-type="1" data-info-type="0">
                    <div class="btn-group active" data-target="wk-user-news-list">
                        <div class="wk-user-news-slider">
                            <span class="news">新闻</span>
                            <i class="fa fa-chevron-down" data-expand="false"></i>
                        </div>
                    </div>
                    <div class="btn-group" data-target="wk-user-vpoint-list">
                        <div class="wk-user-vpoint-slider">
                            <span>达人观点</span>
                            <i class="fa fa-chevron-down" data-expand="false"></i>
                        </div>
                    </div>
                    <div class="btn-group" data-target="wk-user-fastnews-list">
                        <div class="wk-user-fastnews-slider">
                            <span>快讯</span>
                        </div>
                    </div>
                    <div class="btn-group" data-target="wk-user-notice-list">
                        <div class="wk-user-notice-slider">
                            <span>公告</span>
                        </div>
                    </div>
                    <div class="btn-group" data-target="wk-user-report-list">
                        <div class="wk-user-report-slider">
                            <span>研报</span>
                        </div>
                    </div>
                </div>
                <div class="wk-user-news-tabcon">
                    <div class="wk-user-news-list" id="wk-user-news-list">
                        <div class="wk-user-news-ctrl">
                            <div class="wk-user-news-ctrl-head">
                                <div class="user-default active"><label>默认</label></div>
                                <div class="user-define"><span>自定义</span>&nbsp;<i class="fa fa-caret-down" data-expand="false"></i></div>
                            </div>
                            <div class="wk-user-news-ctrl-con"></div>
                        </div>
                        <div class="wk-con"></div>
                        <div class='wk-user-news-loading'><i class='fa fa-refresh fa-spin'></i>&nbsp;正在加载...</div>
                    </div>
                    <div class="wk-user-vpoint-list" id="wk-user-vpoint-list" style="display: none;">
                        <div class="wk-user-vpoint-ctrl">
                            <div class="wk-user-news-ctrl-head">
                                <div class="user-default active"><label>默认</label></div>
                                <div class="user-define"><span>自定义</span>&nbsp;<i class="fa fa-caret-down" data-expand="false"></i></div>
                            </div>
                            <div class="wk-user-news-ctrl-con"></div>
                        </div>
                        <div class="wk-con"></div>
                        <div class='wk-user-news-loading'><i class='fa fa-refresh fa-spin'></i>&nbsp;正在加载...</div>
                    </div>
                    <div class="wk-user-fastnews-list" id="wk-user-fastnews-list" style="display: none;">
                        <div class="wk-con"></div>
                        <div class='wk-user-news-loading'><i class='fa fa-refresh fa-spin'></i>&nbsp;正在加载...</div>
                    </div>
                    <div class="wk-user-notice-list" id="wk-user-notice-list" style="display: none;">
                        <div class="wk-con"></div>
                        <div class='wk-user-news-loading'><i class='fa fa-refresh fa-spin'></i>&nbsp;正在加载...</div>
                    </div>
                    <div class="wk-user-report-list" id="wk-user-report-list" style="display: none;">
                        <div class="wk-con"></div>
                        <div class='wk-user-news-loading'><i class='fa fa-refresh fa-spin'></i>&nbsp;正在加载...</div>
                    </div>
                </div>

            </div>
        </section>

        <!-- 交易 -->
        <section role="tabpanel" class="tab-pane" id="trade">
            <ul class="nav" role="tablist">
                <li class="active left"><a href="#buy" role="tab" data-toggle="tab">买入</a></li>
                <li class="left"><a href="#sale" role="tab" data-toggle="tab">卖出</a></li>
                <div class="clear"></div>
            </ul>

            <div class="tab-content">
                <!--买入-->
                <div class="row tab-pane active" id="buy">
                    <!--买入下单 -->
                    <div class="col-md-6">
                        <div class="buy-tip">购买单只股票仓位不能超过总资产的40%</div>
                        <ul class="trade-info">
                            <li>
                                <lable class="left">买入股票：&nbsp;&nbsp;</lable>
                                <select class="user-group left">
                                </select>
                                <div class="typeahead__container left">
                                    <div class="typeahead__field">
                                        <span class="typeahead__query">
                                            <input class="wk-trade-search" type="search" placeholder="请输入股票名称/代码/拼音" autocomplete="off">
                                        </span>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li><lable>股票名称：&nbsp;&nbsp;</lable><span class="stock-name"></span></li>
                            <li><lable>当前价格：&nbsp;&nbsp;</lable><span class="now-price"></span></li>
                            <li class="price">
                                <lable>买入价格：&nbsp;&nbsp;</lable>
                                <input type="text" class="buy-price" onkeypress="return event.keyCode>=48&&event.keyCode<=57 || event.keyCode==46" readonly>
                                <div class="buy-wrong" data-wrong-type="-1">请输入正确的买入价格!(小数点后最多两位)</div>
                            </li>
                            <li class="stop-price">
                                <lable>止损价格：&nbsp;&nbsp;</lable>
                                <input type="text" onkeypress="return event.keyCode>=48&&event.keyCode<=57 || event.keyCode==46" placeholder="选填">
                            </li>
                            <li><lable>当前可买：&nbsp;&nbsp;</lable><span class="now-num"></span></li>
                            <li class="num">
                                <lable>买入数量：&nbsp;&nbsp;</lable>
                                <input type="text" class="buy-num" onkeypress="return event.keyCode>=48&&event.keyCode<=57" readonly>
                                <div class="num-scale">
                                    <input type="radio" name="scale" data-scale="1" disabled="true">全部&nbsp;&nbsp;
                                    <input type="radio" name="scale" data-scale="0.5" disabled="true">1/2&nbsp;
                                    <input type="radio" name="scale" data-scale="0.33" disabled="true">1/3&nbsp;
                                    <input type="radio" name="scale" data-scale="0.25" disabled="true">1/4&nbsp;
                                    <input type="radio" name="scale" data-scale="0.2" disabled="true">1/5&nbsp;
                                </div>
                                <div class="buy-wrong" data-wrong-type="-1">请输入正确数量(100的倍数且不超过最大买入量)</div>
                            </li>
                            <li><lable>买入金额：&nbsp;&nbsp;</lable><span class="buy-total"></span></li>
                        </ul>
                        <div class="stock-code"></div>
                        <button class="trade-btn btn" data-type="0" data-buy-gid="0">买入下单</button><button class="trade-reset btn">重置</button>
                    </div>

                    <!--股票信息-->
                    <div class="col-md-6 right-infos">
                        <table class="table table1 left">
                            <tr><td>现 &nbsp;&nbsp;价：<span>--</span></td></tr>
                            <tr><td>今 &nbsp;&nbsp;开：<span>--</span></td></tr>
                            <tr><td>昨 &nbsp;&nbsp;收：<span>--</span></td></tr>
                            <tr><td>最 &nbsp;&nbsp;高：<span>--</span></td></tr>
                            <tr><td>最 &nbsp;&nbsp;低：<span>--</span></td></tr>
                            <tr><td>涨停价：<span>--</span></td></tr>
                            <tr><td>跌停价：<span>--</span></td></tr>
                            <tr><td>换手率：<span>--</span></td></tr>
                            <tr><td>成交量：<span>--</span></td></tr>
                        </table>
                        <table class="table table2 left">
                            <tr><td>卖5</td><td>--</td><td>--</td></tr>
                            <tr><td>卖4</td><td>--</td><td>--</td></tr>
                            <tr><td>卖3</td><td>--</td><td>--</td></tr>
                            <tr><td>卖2</td><td>--</td><td>--</td></tr>
                            <tr><td>卖1</td><td>--</td><td>--</td></tr>
                            <tr class="info-now-price"><td colspan="2">当前价</td><td>--</td></tr>
                            <tr><td>买1</td><td>--</td><td>--</td></tr>
                            <tr><td>买1</td><td>--</td><td>--</td></tr>
                            <tr><td>买1</td><td>--</td><td>--</td></tr>
                            <tr><td>卖2</td><td>--</td><td>--</td></tr>
                            <tr><td>卖1</td><td>--</td><td>--</td></tr>
                        </table>
                        <div class="clear"></div>
                    </div>
                </div>
                <!--卖出-->
                <div class="tab-pane row" id="sale">
                    <!--卖出下单-->
                    <div class="col-md-6">
                        <ul class="trade-info">
                            <li>
                                <lable>卖出股票：&nbsp;&nbsp;</lable>
                                <select class="user-group sale-stock-group">
                                    <option value="-1">请选择</option>
                                </select>
                                <select class="sale-stock">
                                    <option value="-1">请选择</option>
                                </select>
                            </li>
                            <li><lable>股票名称：&nbsp;&nbsp;</lable><span class="stock-name"></span></li>
                            <li><lable>当前价格：&nbsp;&nbsp;</lable><span class="now-price"></span></li>
                            <li class="price">
                                <lable>卖出价格：&nbsp;&nbsp;</lable>
                                <input type="text" class="buy-price" onkeypress="return event.keyCode>=48&&event.keyCode<=57 || event.keyCode==46" readonly>
                                <div class="buy-wrong" data-wrong-type="-1">请输入正确的买入价格!(小数点后最多两位)</div>
                            </li>
                            <li><lable>最大可买：&nbsp;&nbsp;</lable><span class="now-num"></span></li>
                            <li class="num">
                                <lable>卖出数量：&nbsp;&nbsp;</lable>
                                <input type="text" class="buy-num" onkeypress="return event.keyCode>=48&&event.keyCode<=57" readonly>
                                <div class="num-scale">
                                    <input type="radio" name="scale" data-scale="1" disabled="true">全部&nbsp;&nbsp;
                                    <input type="radio" name="scale" data-scale="0.5" disabled="true">1/2&nbsp;
                                    <input type="radio" name="scale" data-scale="0.33" disabled="true">1/3&nbsp;
                                    <input type="radio" name="scale" data-scale="0.25" disabled="true">1/4&nbsp;
                                    <input type="radio" name="scale" data-scale="0.2" disabled="true">1/5&nbsp;
                                </div>
                                <div class="buy-wrong" data-wrong-type="-1">请输入正确数量(100的倍数且不超过最大买入量)</div>
                            </li>
                            <li><lable>卖出金额：&nbsp;&nbsp;</lable><span class="buy-total"></span></li>
                        </ul>
                        <div class="stock-code"></div>
                        <button class="trade-btn btn" data-type="1">卖出下单</button><button class="trade-reset btn">重置</button>
                    </div>

                    <!--股票信息-->
                    <div class="col-md-6 right-infos">
                        <table class="table table1 left">
                            <tr><td>现 &nbsp;&nbsp;价：<span>--</span></td></tr>
                            <tr><td>今 &nbsp;&nbsp;开：<span>--</span></td></tr>
                            <tr><td>昨 &nbsp;&nbsp;收：<span>--</span></td></tr>
                            <tr><td>最 &nbsp;&nbsp;高：<span>--</span></td></tr>
                            <tr><td>最 &nbsp;&nbsp;低：<span>--</span></td></tr>
                            <tr><td>涨停价：<span>--</span></td></tr>
                            <tr><td>跌停价：<span>--</span></td></tr>
                            <tr><td>换手率：<span>--</span></td></tr>
                            <tr><td>成交量：<span>--</span></td></tr>
                        </table>
                        <table class="table table2 left">
                            <tr><td>卖5</td><td>--</td><td>--</td></tr>
                            <tr><td>卖4</td><td>--</td><td>--</td></tr>
                            <tr><td>卖3</td><td>--</td><td>--</td></tr>
                            <tr><td>卖2</td><td>--</td><td>--</td></tr>
                            <tr><td>卖1</td><td>--</td><td>--</td></tr>
                            <tr class="info-now-price"><td colspan="2">当前价</td><td>--</td></tr>
                            <tr><td>买1</td><td>--</td><td>--</td></tr>
                            <tr><td>买1</td><td>--</td><td>--</td></tr>
                            <tr><td>买1</td><td>--</td><td>--</td></tr>
                            <tr><td>卖2</td><td>--</td><td>--</td></tr>
                            <tr><td>卖1</td><td>--</td><td>--</td></tr>
                        </table>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

            <!--当日委托-->
            <div class="day_orders table-responsive">
                <div class="title"><h3><span>当日委托</span></h3></div>
                <table class="table">
                    <thead>
                        <tr>
                            <td>序号</td>
                            <td>证券名称(代码)</td>
                            <td>买入/卖出</td>
                            <td>委托价格</td>
                            <td>委托数量</td>
                            <td>委托时间</td>
                            <td>成交状态</td>
                            <td>操作</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </section>

        <!-- 收益分析 -->
        <section role="tabpanel" class="tab-pane" id="analysis">
            <div id="income-analyze"></div>
        </section>
    </div>
    <div class="clear"></div>
</div>
<script src="../static/plugins/jquery-1.11.3.min.js"></script>
<script src="../static/plugins/bootstrap.min.js"></script>
<script src="http://cdn.bootcss.com/echarts/3.1.10/echarts.min.js"></script>
<script src="http://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="http://js.97uimg.com/js/My97DatePicker/WdatePicker.js"></script>
<script src="../static/plugins/typeahead/jquery.typeahead.min.js"></script>
<script src="<?php echo UtilityTools::AutoVersion('/static/js/common.js') ?>"></script>
<script src="<?php echo UtilityTools::AutoVersion('/static/js/Utility.min.js') ?>"></script>
<script src="<?php echo UtilityTools::AutoVersion('/static/js/trade-sys/holdings.js') ?>"></script>
<script src="<?php echo UtilityTools::AutoVersion('/static/js/trade-sys/trade.js') ?>"></script>
<script src="<?php echo UtilityTools::AutoVersion('/static/js/trade-sys/analysis.js') ?>"></script>
<script src="<?php echo UtilityTools::AutoVersion('/static/js/trade-sys/attention.js') ?>"></script>
<script src="../static/plugins/template-native.js" ></script>
<script type="text/html" id="tpl">
    <%for(var i = 0;i
    <index_info.length;i++ ){%>
    <div class="col-md-4  index-item">

        <%if(index_info[i].up_price>0){%>
        <% var imgurl="../static/imgs/trade/arrow_up.png" %>
        <div class='index redStyle'>
            <%}else{%>
            <% var imgurl="../static/imgs/trade/arrow_down.png" %>
            <div class='index greenStyle'>
                <%}%>

                <p class='index-title'><%==index_info[i].name%></p>
                <div class="index-box ">
                    <div class='index-box-left pull-left'>
                        <p><img src=<%==imgurl%> alt="">
                            <%var percent=(index_info[i].price).toFixed(2)%>
                            <span><%==percent%></span>
                            <!--                            <span><%==index_info[i].price%></span>-->
                        </p>
                    </div>
                    <div class='index-box-right pull-right'>
                        <p><%==index_info[i].up_price%></p>
                        <%var percent=(index_info[i].up_percent*100).toFixed(2)%>
                        <p><%==percent%>%</p>
                    </div>
                </div>
            </div>
        </div>
        <%}%>
</script>
<script>
    var thisHost = "http://" + window.location.host + "/";
    var uid=<?php echo $uid ?>;
    var token=<?php echo '"'.$token.'"' ?>;
    /**
     * 搜索框自动完成
     */
    $(".wk-head-search").typeahead({
        minLength: 2,
        maxItem: 20,
        order: "asc",
        hint: true,
        group: true,
        maxItemPerGroup: 5,
        backdrop: false,
        dynamic: true,
        filter: false,
        emptyTemplate: '未找到 "{{query}}" 的相关信息',
        source: {
            "股票": {url: [thisHost + "ajax/trade/ajax_search.php?message={{query}},&type=0", "stock"]},
            "行业": {url: [thisHost + "ajax/trade/ajax_search.php?message={{query}},&type=0", "hy"]},
            "概念": {url: [thisHost + "ajax/trade/ajax_search.php?message={{query}},&type=0", "gn"]},
            "热点事件": {url: [thisHost + "ajax/trade/ajax_search.php?message={{query}},&type=0", "event"]}
        },
        callback: {
            onClickAfter: function (node, a, item) {
                if (item.display !== "") {
                    switch (item.group) {
                        case "股票":
                            window.open("http://stock.iwookong.com/ajax/login/nologin.php?stock=" + item.display.substring(item.display.indexOf("(") + 1, item.display.indexOf(")")) + '&uid=' +uid+ '&token=' + token , "_blank");
                            break;
                        case "行业":
                            window.open("http://stock.iwookong.com/ajax/login/nologin.php?industry=" + item.display + '&uid=' + uid+ '&token=' + token , "_blank");
                            break;
                        case "概念":
                            window.open("http://stock.iwookong.com/ajax/login/nologin.php?concept=" + item.display+ '&uid=' + uid+ '&token=' + token , "_blank");
                            break;
                        case "热点事件":
                            window.open("http://stock.iwookong.com/ajax/login/nologin.php?event=" + item.display + '&uid=' + uid+ '&token=' + token , "_blank");
                            break;
                        default:
                            window.open(thisHost + "error.php", "_blank");
                            break;
                    }
                }
            }
        }
    });
</script>
</body>
</html>