<!DOCTYPE html>
<html>
<head>
    <title>商品0元秒杀</title>
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <style type="text/css">
        body {
            background: rgb(240, 240, 240);
        }
        .imgDiv {
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
        .titleDiv {
            margin-top: 10px;
            background: white;
        }
        .titleStyle {
            font-size: 40px;
        }
        .oldPrice {
            font-size: 34px;
        }
        .seckillPrice {
            font-size: 38px;
            color: red;
        }
        .flaotL {
            float: left;width: 33%;  
        }
        .clearFloat {
            clear: both;
        }
        .bottomDiv {
            position:relative;
            /*position:fixed;*/
            bottom:0px;
            width:100%;
            background-color: white;
            height: 80px;
        }
        .seckillBtn {
            color: #fff;
            background-color: #d9534f;
            border-color: #d43f3a;
            font-size: 40px;
            padding: 6px 12px;
            width: 100%;
            height: 80px; 
        }
        .introduce {
            font-size: 38px;
        }
        .points {
            font-size: 30px;
        }
        .form-class {
            display: block;
            width: 100%;
            padding: 6px 12px;
            font-size: 30px;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
    </style>
</head>
<body>
    <div class="imgDiv">
        <img src="{{ asset('/img/test.jpg') }}" style="width: 99.8%">
    </div>

    <div class="titleDiv">
        <div>
            <span class="titleStyle">YSFT显瘦小仙女黑色职业装瘦腿裤潮流厉害好看超级无敌细腿裤</span><br><br>
        </div>
        <div>
            <div class="flaotL">
                <strike class="oldPrice">￥24.8</strike>
            </div>
            <div class="flaotL">
                <span class="seckillPrice">秒杀价￥0.00</span>
            </div>
            <div class="clearFloat"></div>
        </div>
        <div>
            <div style="float: left;width: 33%;">
                <strike class="points">快递：￥8.00</strike>
            </div>
            <div style="float: left;width: 33%;">
                <span class="points">销量：1254</span>
            </div>
            <div style="float: left;width: 33%;">
                <span class="points">地点：浙江杭州</span>
            </div>
            <div class="clearFloat"></div>
        </div>
    </div>

    <div class="titleDiv">
        <span class="introduce">秒杀活动说明</span><br>
        <span class="points">1、点击立即秒杀之前请在下方的输入框里填写好微信号。注:未填写的无法参与!</span><br>
        <span class="points">2、有时候秒杀的商品需要支付邮费，具体按情况而定。</span><br>
        <span class="points">3、秒杀完成之后等待管理员公布结果。</span><br>
        <span class="points">4、本次活动最终解释权归管理员所有。</span><br>
    </div>

    <div class="titleDiv" style="padding: 12px 14px;">
        <div style="float: left;margin-top: 5px;">
            <span class="points">请填写您的微信号：</span>
        </div>
        <div style="float: left;">
            <input type="text" name="phoneNumber" class="form-class" placeholder="请输入联系您的微信号">
        </div>
        <div class="clearFloat"></div><br>
        <span style="color:red;font-size: 30px;">特别备注：该微信号是秒杀活动结束后联系您的方式，请务必保证微信号的正确性，如若填错，本次秒杀将视为无效处理！</span>
    </div>

    <div class="bottomDiv">
        <button class="seckillBtn" onclick="formSub()">立即秒杀</button>
    </div>
</body>
<script type="text/javascript" src="{{ asset('js/jquery-1.8.2.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/layui/layui/layui.js') }}" ></script>
<script type="text/javascript">
    layui.use('layer',function(){
        window.layer = layui.layer;
    });

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    });

    function formSub() {
        var phoneNumber = $('input[name="phoneNumber"]').val();
        if (!phoneNumber) {
            var html = '<span style="font-size:30px;">请填写您的微信号！</span>';
            layer.alert(html, {
                icon: 5,
                area: ['500px', '200px']
            });
        } else {
            $.ajax({
                url: "/formSubmit",
                type: "POST",
                dataType: "json",
                data: {
                    'phoneNumber':phoneNumber
                },
                success: function (data) {
                    switch(data.result)
                    {
                        case 1:
                            var html = '<span style="font-size:30px;">您已经提交信息完毕，请等待管理员公布结果！</span>';
                            var icon = 6;
                            break;
                        case 2:
                            var html = '<span style="font-size:30px;">您的信息提交失败，请重新秒杀！</span>';
                            var icon = 5;
                            break;
                        case 3:
                            var html = '<span style="font-size:30px;">您已经参与了本次秒杀，请勿重复操作！</span>';
                            var icon = 6;
                            break;
                    }
                    layer.alert(html, {
                        icon: icon,
                        area: ['500px', '200px']
                    }); 
                }
            });
        }
    }
</script>
</html>