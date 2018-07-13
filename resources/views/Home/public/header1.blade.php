<div class="top_box">
    <div class="top_cont">
        <div class="top_login_r top_red">
        </div>
        @if (!session("lenovoHomeUserInfo.id"))
        <ul class="top_login top_red">
           
            <li class="top_loginbtn" id="LoginID">
                <a href="/login" class="login">登录</a>
            </li>
            <li class="top_regist" id="RegisterID">
                <a href="/reg" class="regist">注册</a>
            </li>
        </ul>
        @else
        <div class="top_phone" style="" id="UserInfo">
            <div class="top_phone_title"><span id="UserNameID">{{session("lenovoHomeUserInfo.name")}}</span> 
                <a href="#" class=" top_usepng top_downs"></a>
            </div>
        </div>
        @endif
        <ul class="top_login top_red">
            <li style="border-left:none;"><a href="/">返回首页</a></li>
        </ul>
    </div>
</div>