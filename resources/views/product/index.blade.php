<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>有线鼠标</title>
    <meta name="keywords" content="有线鼠标， 外设天下，商城">
    <meta name="description" content="外设天下 烧友所爱，值得信赖">
    <script src="static/js/jquery-1.10.2.js"></script>
    <script src="static/js/jq_color.js"></script>
    <script src="static/js/base.js"></script>
    <script src="static/js/youxianshubiao_zxr.js"></script>
    <script src="static/js/SteelSeries_zxr.js"></script>
    <link rel="stylesheet" href="static/css/base.css">
    <link rel="stylesheet" href="static/css/SteelSeries_zxr.css">
    <link rel="stylesheet" href="static/css/youxianshubiao_zxr.css">
</head>
<body>
<div class="show_zxr">
    <ul>
        <li><a style="color:#be202e" href="#"> 默认排序</a><span>|</span></li>
        <li><a href="#"> 销量</a><span>|</span> </li>
        <li><a href="#"> 价格</a> </li>
    </ul>
    <div class="clear"></div>
    @foreach($product as $values)
    <div class="showshangpin_zxr_">
        <img src="{{$values->image}}">
        <p><a href="{{route('product.show',[$values->id])}}">{{$values->title}}</a></p>
        <p class="showshangpin_zxr_p">
            ￥{{$values->price}}
        </p>
        <div class="showshangpin_zxr_img">
            <img src="static/image/jianpan12_zxr.jpg">
        </div>
    </div>
    @endforeach
    <div class="clear"></div>
</div>

<!--下方滚动浏览-->
<div class="bigimg_zxr">

    <div class="canshu">
        <div class="canshubiao1_zxr">
            你可能感兴趣的商品

        </div>
        <div class="shubiaoshow_zxr shu1 shuai" >
            <div class="lunbo_zxr">
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<div class="dianji">
    <div class="dianji2"></div>
    <div class="dianji1"></div>
</div>
<!--尾部-->
<div class="footer">
    <div class="promise">
        <ul>
            <li><span>100%</span>品牌授权正品</li>
            <li><span>7</span>天无理由退换货</li>
            <li><span>15</span>天质量问题换新</li>
            <li class="number">客服电话：<span>400-616-7778</span></li>
        </ul>
    </div>
    <div class="items">
        <h4 class="txt">帮助中心</h4>
        <ul>
            <li><a href="#">购物指南</a></li>
            <li><a href="#">支付方式</a></li>
            <li><a href="#">配送方式</a></li>
        </ul>
    </div>
    <div class="items">
        <h4 class="txt">售后服务</h4>
        <ul>
            <li><a href="#">售后政策</a></li>
            <li><a href="#">自助服务</a></li>
            <li><a href="#">相关下载</a></li>
        </ul>
    </div>
    <div class="items">
        <h4 class="txt">关于我们</h4>
        <ul>
            <li><a href="#">公司简介</a></li>
            <li><a href="#">加入我们</a></li>
            <li><a href="#">联系我们</a></li>
        </ul>
    </div>
    <div class="items">
        <h4 class="txt">关注我们</h4>
        <ul>
            <li><a href="#">新浪微博</a></li>
            <li><a href="#">外设导航</a></li>
            <li><a href="#">外设社区</a></li>
        </ul>
    </div>
    <div class="item-service">
        <h4 class="txt"><img src="static/image/touxiang-jzx.png" width="20px"> 客户服务</h4>
        <ul>
            <li><i class="fa-caret-right"></i> 周一至周日 09:00-24:00</li>
            <li><i class="fa-caret-right fa-qq"></i>: 4006167778</li>
        </ul>
    </div>
    <div class="item-twodcode">
        <h4 class="txt">微信公众号</h4>
        <ul>
            <li><img src="static/image/erweima-jzx.png" width="60px"></li>
        </ul>
    </div>
    <div class="container">
        <p><span>PENTA LILL&copy;2007-2016</span><span><a href="#">黑ICP备53</a></span><span>版权所有 &copy; 2016 PENTA LILL</span></p>
    </div>
</div>
</body>
</html>