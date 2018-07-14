<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title><?php echo e(config('web.title')); ?>_结算中心</title>
  <meta name="keywords" content="<?php echo e(config('web.keywords')); ?>" />
  <meta name="description" content="<?php echo e(config('web.description')); ?>" />
	<link rel="shortcut icon" href="/style/home/img/1.png">
	<link rel="stylesheet" href="/style/home/css/zhufu.css">
	<script src="/style/home/js/jquery.js"></script>

	<script src="/style/home/js/zhifu.js"></script>
</head>
<body>
<?php echo $__env->make("home.public.header1", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="top_logob">
    <a href="/"><img src="/style/home/img/pic-15.jpg" class="top_logob_imga"></a>
    <img src="/style/home/img/pic-16.jpg" class="top_logob_imgb">
</div>
<form action="/orders" method="post">
    <?php echo e(csrf_field()); ?>

<div class="wrap" style="padding-top: 40px;">
<div class="box-01">
    <div class="box-tl">
        <p>请填写并核对以下信息</p>
    </div>
    <div class="box-a" id="box-a">
    	<p>收货信息：<span class="showbtn-SH showbtn new_p" ><span onclick="opens()" style="cursor:pointer;">＋新增收货地址</span>
    </span></p>
    <div id="addressList-SH">

        <?php $__currentLoopData = $addr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p>
                <input type="radio" checked name="aid" value="<?php echo e($site->id); ?>">
                <span><?php echo e($site->sname); ?></span>
                <span><?php echo e($site->stel); ?></span>
                <span><?php echo e($site->addr); ?></span>
                <span><?php echo e($site->addrInfo); ?></span>
            </p>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div id="bg-SH" class="bg-n"></div>
    </div>
            <div class="box-b" id="box-b">
            	<p>支付方式：</p> 
            <div style="cursor:pointer;" class="box-ax bgse pink"  id="bgdiv0" value="0"> <p>
            	<span>在线支付</span>
        </p>
             <img src="/style/home/img/pic-07.jpg" id="icon"> </div>
             <input id="presellflag" type="hidden" value="false">
        </div>
<!-- <div class="box-c">
    <p class="c-p">发票信息&nbsp;<span style="font-family: '微软雅黑';font-size: 12px;line-height: 50px;color: red">(发票内容只能开明细，开增值税发票不赠送乐豆)</span>：</p>
    <div style="border:none;" class="box-ax">
        <input type="hidden" id="invoice_header" value="">
        <p>发票抬头：<span latag="latag_pc_ordersubmit_invoice" id="invoice_head">个人</span>
            发票类型：<span id="invoice_type">电子发票</span>
            开票方式：<span id="invoice_way">电子发票</span>
            <span style="cursor:pointer;" class="red showbtna">修改</span>
        </p>
    </div>
    <div id="bg"></div>
    <div id="fapinfoid" style="display: none; left: 104px; top: 633.4px;" class="boxa">
        <a class="close"href="#">╳</a>
        <div class="tm">
            <p>发票信息</p>
            <input id="VAT" type="hidden">
            <input id="notices" type="hidden" value="">
            <input id="invoicestatus" type="hidden" value="">
            <img src="http://m1.lefile.cn/trade/pc/images/pic-08.jpg">
        </div>
        <ul style="margin-left: 17px">
            <li>
                <p>发票属性：</p>

                <p id="invoiceType">
                <input id="Radioheadtype1" type="radio" onclick="checkshow_click(this)" checked="checked" value="0" name="RadioGroup2">
                <label for="radioheadtype1">个人</label>
                <input id="Radioheadtype2" type="radio" onclick="checkshow_click(this)" class="shoubtnx" value="1" name="RadioGroup2">
                <label for="radioheadtype2">公司
                </label>
                </p>

            </li>
        </ul>
        <ul style="margin-left: 17px">
            <li>
                <p>发票类型：</p>

                <p id="tempinvoiceType_p">
                <input type="radio" id="00" onclick="canEdit()" value="电子发票" name="RadioGroup1" checked="checked">
                <label>电子发票</label>
                <input type="radio" id="01" onclick="canEdit()" value="普通发票" name="RadioGroup1"><label>普通发票</label>
                </p>
                <p id="tempinvoiceType_c" style="display: none;">
                <input type="radio" id="11" checked="checked"  value="普通发票" name="RadioGroup11">
                <label>普通发票</label>
                <input type="radio" id="12" value="增值发票" name="RadioGroup11">
                <label>增值发票</label></p>
            </li>
        </ul>
        <ul id="zpinfo" style="margin-left: 17px; display: block;">
            <li>
                <p>抬头内容：</p>

                <p><input type="text" latag="latag_pc_ordersubmit_invoice" id="invoiceheadcontent" placeholder="个人" class="ipt"></p>

                <p class="tishi-ct"></p>
            </li>
            <li id="tipsid"><p class="tishi">温馨提示：根据上海自由贸易试验区创新精神，在本交易平台订购的产品启用电子发票，本企业承诺电子发票与纸质发票具有同等法律效力。</p></li>
            <li>
                <button class="bta" latag="latag_pc_ordersubmit_invoice_confirm" onclick="saveInvoiceInfo(1);">保存发票信息
                </button>
            </li>
        </ul>
        <div style="display: none;" id="tabd">
            <img src="http://m1.lefile.cn/trade/pc/images/pic-invoice.jpg" class="pic-s">

            <div style="display: block;" id="tabh">
                <ul>
                    <li>
                        <p class="ps"><span>* </span>纳税人识别码：</p>

                        <p>
                            <input id="taxNo" type="text" name="taxNo" class="ipts" >&nbsp;&nbsp;
                        <input type="button" class="bttn" value="换票" ><span></span></p>
                    </li>
                    <li>
                        <p class="ps"><span>* </span>发票抬头：</p>

                        <p><input id="customerName" type="text" name="customerName" class="ipts" onkeyup="getShareInfo()"><span></span></p>
                    </li>
                    <li>
                        <p class="ps"><span>* </span>注册地址：</p>

                        <p><input type="text" id="address" name="address" class="ipts"><span></span></p>
                    </li>
                    <li>
                        <p class="ps"><span>* </span>注册电话：</p>

                        <p><input type="text" id="phoneNo" name="phoneNo" class="ipts"><span></span><br><em style="color: red">请填写固话或者手机号，固话请加区号，例如：010-xxxxxxx</em></p>
                    </li>
                    <li>
                        <p class="ps"><span>* </span>开户银行：</p>

                        <p><input type="text" id="bankName" name="bankName" class="ipts"><span></span></p>
                    </li>
                    <li>
                        <p class="ps"><span>* </span>银行账号：</p>

                        <p><input type="text" id="accountNo" name="accountNo" class="ipts"><span></span></p>
                    </li>
                    <li>
                        <p class="ps">
                            <span>* </span>
                            是否合并开票：
                        </p>

                        <p id="ismergeId">
                            <input type="radio" name="needmerge" id="needmerge_yes" checked="checked">
                            是
                            <input type="radio" name="needmerge" id="needmerge_no">
                            否
                            <span></span>
                        </p>
                    </li>
                    <li class="agreedShareInfo">
                        <p class="ps">
                            <span>* </span>
                            是否同意共享：
                        </p>

                        <p id="isshareId">
                            <input type="radio" name="agreedshare" id="sharebtn_yes">
                            是
                            <input type="radio" name="agreedshare" id="sharebtn_no">
                            否
                            <span></span>
                        </p>
                    </li>
                    <li class="agreedShareInfo" style="padding-left: 50px;line-height: 20px;margin-top: -9px;color:red">
                        <span>您提交的公司名称、税号、注册地址及电话、开户行及帐号，审核通过后将在联想商城保存叁年，</span><br>
                        <span>仅用于联想商城开具增值税专用发票信息，共享给其他提交同样公司名称和税号的客户。</span><br>
                        <span>如您同意请勾选"是",如需删改请联系客服。</span><br>
                    </li>
                    <li id="uploadimg">
                    
                    </li>
                </ul>
                <div class="tspk">
                    <dl>
                        <dd>
                        </dd>
                    </dl>
                    <dl>
                        <dd>
                        </dd>
                    </dl>
                </div>
                <ul>
                    <li style="padding-left: 50px;line-height: 20px;margin-top: -9px;color: #6f7170;">
                        <span>温馨提示：请确保以上信息准确无误，如发现有误请立即联系客服，避免因填写错误导致贵公司损失！</span><br>
                        <span>增值税专用发票在订单付款成功后由专人审核，正常情况下10个工作日内按收票地址寄出，请及时认证抵扣；</span><br>
                        <span>根据税务局要求，如发生退货，需购买方提供冲红通知单；税后扣除相关问题，由专业财务人员帮您处理。</span><br>
                    </li>
                    <li>
                        <p class="ps">&nbsp;</p>

                        <p>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="bttn" onclick="saveInvoice();">保存</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <button onclick="cancel();" class="bttn">取消</button>
                        </p>
                    </li>
                </ul>
            </div>


        </div>

    </div>
</div> -->

<div class="box-d" id="box-d" style="display:none">
</div>

<div class="box-02" id="productList">
    <div class="box-tl"><p><a href="/car" latag="latag_pc_ordersubmit_backtocart">返回购物车修改&gt;</a>确认商品</p>
</div>
<div class="box-ls" style="margin-bottom: -20px;">
    <p class="tl-a">&nbsp;</p><p class="tl-b">商品名称</p>
<p class="tl-c">单价</p><p class="tl-d">数量</p>
<p class="tl-e">金额</p></div>
<div class="divide" style="margin-top: 20px;border-bottom: 1px solid #d9d8d6;">
</div>
<?php
    $tot = 0;
?>
<?php $__currentLoopData = $newShop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="list" id="52771" style="border-bottom: none;">
    <input type="hidden" name="ids[]" value="<?php echo e($shop['id']); ?>">
    <input type="hidden" name="nums[]" value="<?php echo e($shop['num']); ?>">
    <input type="hidden" name="prices[]" value="<?php echo e($shop['goodsInfo']->price); ?>">
    <p class="list-a">
        <a href="/goods/<?php echo e($shop['id']); ?>"><img title="<?php echo e($shop['goodsInfo']->title); ?>" src="/Uploads/goods/<?php echo e($shop['goodsInfo']->img); ?>" width="110px" height="110px"></a>
    </p>
    <p class="list-b">
        <a href="/goods/<?php echo e($shop['id']); ?>" title="<?php echo e($shop['goodsInfo']->title); ?>"><?php echo e($shop['goodsInfo']->title); ?></a>
    </p>
    <p class="list-c"><?php echo e($shop['goodsInfo']->price); ?></p>
    <p class="list-d"><?php echo e($shop['num']); ?></p>
    <?php
        $money = $shop['goodsInfo']->price * $shop['num'];
        $tot +=$money;
    ?>
    <p class="list-e"><?php echo e($money); ?></p>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
    <div class="box-03" id="discount" style="display:block">
    <div class="box-tl">
        <p>优惠信息<span style="color: red;font-size: 15px;" id="tipsinfo">&nbsp;&nbsp;&nbsp;温馨提示：您优惠券、优惠码使用过程中，有任何问题请联系客服</span></p>
    </div>
    <!-- --------------使用优惠券 --------------- -->
    <!-- <div class="message" id="couponlist">
             <input type="hidden" id="selectedCoupon" value="">
        <p class="menuTitle yh">
            <a href="javascript:;">
            </a>
            <span class="red">使用优惠券</span>
        </p>
        <div class="msg menuContent" style="display:none;">
            <ul>
                <li>
                    <a href="javascript:;" class="hong aa">可使用优惠劵(<span id="listsize">0</span>)</a>
                </li>
            </ul>
        <div id="tab_01" style="display:block">
        </div>
        <div class="msg-b"></div>
    </div>
    </div> -->
  <!-- --------------使用内购额度------------- -->
    <!-- <div class="dou" id="innerlimitmoney" style="display:none">
    <p class="menuTitle">
        <a href="javascript:;" class=""></a>
        <span class="red">使用内购额度</span>（用户总内购额度<label class="red" id="userCanuseInnerBuy">0</label> 元）</p>
        <div class="dous menuContent" style="display: none;">
            <div class="dous-a">
            <p>商品可减免内购额度：<span class="red" id="innerbuySum">0</span> 元</p>
            </div>
            <div class="dous-a">
            <p>使用内购额度：<input type="text" id="innerLimitMoney" placeholder="输入内购额度（单位：元）">
            <input type="checkbox" id="innerLimitcheck" onclick="useInnerLimit()" style="width: 40px;height: 24px;" latag="latag_pc_ordersubmit_couponcodeinput">
            使用</p>
            </div>
        </div>
    </div>
<div class="dou" id="couponcodeDiv">
    <p class="menuTitle"><a href="javascript:;"></a><span class="red">使用优惠码</span></p>
    <div class="dous  menuContent" style="display:none;">
        <div class="dous-a">
            <p>优惠码：<input type="text" id="couponcode" placeholder="输入优惠码" latag="latag_pc_ordersubmit_couponcodeinput">
                      <input type="checkbox" id="couponcheck" onclick="useCouponCode()" style="width: 40px;height: 24px;" latag="latag_pc_ordersubmit_couponcodeconfirm">
                        使用
                                        </p>
        </div>
    </div>
</div> 
<div class="dou" style="display: block;" id="happyBeanNum">
            <p class="menuTitle"><a href="javascript:;" class=""></a><span class="red">使用乐豆</span>（总乐豆数量<label class="red" id="LeDouTotalCount">300</label>个）</p>
            <div class="dous menuContent" style="display: none;">
                <div class="dous-a">
                    <p>最大支持使用乐豆：<span class="red" id="availableHappyBeanNum">6699</span> 个</p>
                </div>
                <div class="dous-a">
                    <p>使用乐豆：<input type="text" id="useHappyBeanNum" placeholder="输入乐豆数" latag="latag_pc_ordersubmit_ledouinput">
                    <input type="checkbox" id="happyBeancheck" onclick="useHappyBean()" style="width: 40px;height: 24px;" latag="latag_pc_ordersubmit_ledouconfirm">
                    使用
                    </p>
                                    </div>
            </div>
        </div> -->


</div>
</div>
<!--    <div class="box-04">
 <div class="box-tl">
     <p>订单备注</p>
 </div>
 <div class="dan">
     <p>客服经理编码：<input type="text" id="managercode" placeholder="如果您联系过客服，可以填写其编码"></p>
 </div>
 <div class="dans">
     <p style="padding-right: 36px">订单备注:</p>
     <textarea id="ordermark" placeholder="告诉我您的特殊要求,限150字"></textarea>
 </div>
</div>
  ﻿
<div style="text-align:right;" id="agree_condition">
             <span id="lenovocondition">
         <input type="checkbox" name="isagreed" id="isagreed" checked="checked" latag="latag_pc_odersubmit_agree">
         <a target="_blank" href="turnB2C.jhtm" latag="latag_pc_odersubmit_turnb2c">我同意  《联想产品网络销售通用条款和条件》</a>
    </span>
       
</div> -->

    <div class="box-06 clearfix" id="discountinfo" style="display: block;">
    <p><span>商品总价：<em style="color: #e2231a;font-weight: bold;font-style: normal;" id="totalPrice"><?php echo e($tot); ?></em>元</span></p>
    <p id="submitbutton" style="margin-bottom: 15px;"><button style="font-size: 18px;cursor: pointer;margin-top: 2px;">提交订单</button></p>
</div>
<div id="orderformDiv"></div>

</div>
</form>
    <div style="display:none" id="addAddr" class="box-SH box">
    <input type="hidden" id="flag1-SH" value="0">
    <input type="hidden" id="deliveridupdate-SH" value=""><a class="close" onclick="closes()" href="javascript:void(0);" >╳</a>    <ul>
        <li><label><span>* </span>收货人：</label><input type="text" id="name-SH"><label id="alertName-SH" style="display:none;color:red">收货人不能为空</label></li>
        <li><label><span>* </span>手机：</label>
            <input type="text" id="mobile-SH">
            <label>  固定电话：</label>
            <input type="text" id="phone-SH"></li><li><label><span>* </span>地址：</label>
            <select id="goodsProvince-SH" name="goodsProvince-SH" onchange="getCities('SH')" style=" height:25px;width:120px"><option value="">省份</option>
            </select>
            <select id="goodsCity-SH" name="goodsCity-SH"  style=" height:25px;width:120px"><option value="">城市</option> </select>
            <select id="goodsCounty-SH" name="goodsCounty-SH" style=" height:25px;width:120px"><option value="">区/县</option></select></li><li><label><span>* </span>详细地址：</label><input type="text" style="width:410px;" id="goodsStreet-SH"></li><li><label>邮箱：</label><input type="text" id="mail-SH">
            <span style="color:red;vertical-align: middle;padding-left: 5px;">用来接收订单提醒邮件，便于您及时了解订单状态</span>
        </li>
        <li>
            <label><input type="checkbox" style="width:14px;height:14px;margin-top: -8px;" id="isCheck-SH" >&nbsp;&nbsp;</label>设置为默认收货地址</li>
        <li>
            <label>
        </label>
        <button id="submitbtn-SH" >保存收货人信息</button>
    </li>
    </ul>
    </div>
<script type="text/javascript">
        function opens() {
            $("#addAddr").show();
        }
        function closes() {
            $("#addAddr").hide();
        }
    </script>
 <div class="footer">
   <img src="/style/home/img/99999.png" alt="">

   <img src="/style/home/img/9999.png" alt="">
 </div>
</body>
</html>