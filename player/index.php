﻿<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <title>BiliPlayer</title>
    <link rel="shortcut icon" href="https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@master/player/img/play.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@master/player/css/yzmplayer.css">
    <style>
        .yzmplayer-full-icon span svg,
        .yzmplayer-fulloff-icon span svg {
            display: none;
        }

        .yzmplayer-full-icon span,
        .yzmplayer-fulloff-icon span {
            background-size: contain !important;
            float: left;
            width: 22px;
            height: 22px;
        }

        .yzmplayer-full-icon span {
            background: url(https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@master/player/img/5eca627664041.png) center no-repeat;
        }

        .yzmplayer-fulloff-icon span {
            background: url(https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@master/player/img/5eca6278b7137.webp) center no-repeat;
        }

        #loading-box {
            background: #<?php echo ($_GET['color']); ?> !important;
        }

        #vod-title {
            overflow: unset;
            width: 285px;
            white-space: normal;
            color: #fb7299;
        }

        #vod-title e {
            padding: 2px;
        }

        .layui-layer-dialog {
            text-align: center;
            font-size: 16px;
            padding-bottom: 10px;
        }

        .layui-layer-btn.layui-layer-btn- {
            padding: 15px 5px !important;
            text-align: center;
        }

        .layui-layer-btn a {
            font-size: 12px;
            padding: 0 11px !important;
        }

        .layui-layer-btn a:hover {
            border-color: #00a1d6 !important;
            background-color: #00a1d6 !important;
            color: #fff !important;
        }

        .yzmplayer-controller .yzmplayer-icons .yzmplayer-toggle input+label.checked:after {
            left: 17px;
        }

        .yzmplayer-setting-jlast:hover #jumptime,
        .yzmplayer-setting-jfrist:hover #fristtime {
            display: block;
            outline-style: none
        }

        #player_pause .tip {
            color: #f4f4f4;
            position: absolute;
            font-size: 14px;
            background-color: hsla(0, 0%, 0%, 0.42);
            padding: 2px 4px;
            margin: 4px;
            border-radius: 3px;
            right: 0;
        }

        #player_pause {
            position: absolute;
            z-index: 9999;
            top: 50%;
            left: 50%;
            border-radius: 5px;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            max-width: 80%;
            max-height: 80%;
        }

        #player_pause img {
            width: 100%;
            height: 100%;
        }

        #jumptime::-webkit-input-placeholder,
        #fristtime::-webkit-input-placeholder {
            color: #ddd;
            opacity: .5;
            border: 0;
        }

        #jumptime::-moz-placeholder {
            color: #ddd;
        }

        #jumptime:-ms-input-placeholder {
            color: #ddd;
        }

        #jumptime,
        #fristtime {
            width: 50px;
            border: 0;
            background-color: #414141;
            font-size: 12px;
            padding: 3px 3px 3px 3px;
            margin: 2px;
            border-radius: 12px;
            color: #fff;
            position: absolute;
            left: 5px;
            top: 3px;
            display: none;
            text-align: center;
        }

        #link {
            display: inline-block;
            width: 100px;
            height: 35px;
            line-height: 35px;
            text-align: center;
            font-size: 14px;
            border-radius: 22px;
            margin: 0px 10px;
            color: #fff;
            overflow: hidden;
            box-shadow: 0px 2px 3px rgba(0, 0, 0, .3);
            background: rgb(0, 161, 214);
            position: absolute;
            z-index: 9999;
            top: 20px;
            right: 35px;
        }

        #close c {
            float: left;
            display: none;
        }

        .dmlink,
        .playlink,
        .palycon {
            float: left;
            width: 400px;
        }

        #link3-error {
            display: none;
        }
        /*定义页面背景色*/
        .yzmplayer-video-wrap{
            background: #111111;
        }
        /*定义加载背景图*/
        #loading-box .video-panel-blur-image{
            /*background: url(https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@master/player/img/search-bg.jpg) #000000;*/
            background: #fff;
            background-size: cover;
            background-position: 50%;
            -webkit-filter: blur(20px);
            -moz-filter: blur(20px);
            -ms-filter: blur(20px);
            filter: blur(20px);
        }
        /*定义加载动图*/
        .loading .pic {
        	background: url(https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@master/player/img/hilarious%402x.gif) no-repeat;
        	background-size: 100%;
        	margin: -50px 0 0 -50px;
        	height: 100px;
            width: 100px;
        }
        /*定义加载文字颜色*/
        #close {
        	color: #07c160;
        	font-weight: 700;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@master/player/js/yzmplayer.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@master/player/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@1.0.0/player/js/setting.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@master/player/js/setting.js"></script>-->
    <?php
    if (strpos($_GET['url'], 'm3u8')) {
        echo '<script src="https://cdn.jsdelivr.net/gh/btjson/5mrk@0.0.1/js/hls.min.js"></script>';
    } elseif (strpos($_GET['url'], 'flv')) {
        echo '<script src="https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@master/player/js/flv.min.js"></script>';
    }
    ?>
    <!--<script src="https://cdn.jsdelivr.net/gh/aobocodoeo/omgYouTube@master/player/js/layer.js"></script>-->

    <script>
        var css = '<style type="text/css">';
        var d, s;
        d = new Date();
        s = d.getHours();
        if (s < 17 || s > 23) {
            css += '#loading-box{background: #fff;}'; //白天
        } else {
            css += '#loading-box{background: #000;}'; //晚上
        }
        css += '</style>';
        // $('head').append(css).addClass("");
    </script>
</head>

<body>
    <div id="player"></div>
    <div id="ADplayer"></div>
    <div id="ADtip"></div>
    <!--统计代码-->
    <div class="tj">
        <script>
            !function(p){"use strict";!function(t){var s=window,e=document,i=p,c="".concat("https:"===e.location.protocol?"https://":"http://","sdk.51.la/js-sdk-pro.min.js"),n=e.createElement("script"),r=e.getElementsByTagName("script")[0];n.type="text/javascript",n.setAttribute("charset","UTF-8"),n.async=!0,n.src=c,n.id="LA_COLLECT",i.d=n;var o=function(){s.LA.ids.push(i)};s.LA?s.LA.ids&&o():(s.LA=p,s.LA.ids=[],o()),r.parentNode.insertBefore(n,r)}()}({id:"JJ4wSFmDMxMGWcWJ",ck:"JJ4wSFmDMxMGWcWJ"});
        </script>
    </div>
    <script>
        var up = {
            "usernum": "<?php include("tj.php"); ?>", //在线人数
            "mylink": "/player/?url=", //播放器路径，用于下一集
            "diyid": [0, '游客', 1] //自定义弹幕id
        }
        var config = {
            "api": '/dmku/', //弹幕接口
            "av": '<?php echo ($_GET['av']); ?>', //B站弹幕id 45520296
            "url": "<?php echo ($_GET['url']); ?>", //视频链接
            "id": "<?php echo (substr(md5($_GET['url']), -20)); ?>", //视频id
            "sid": "<?php echo ($_GET['sid']); ?>", //集数id
            "pic": "<?php echo ($_GET['pic']); ?>", //视频封面
            "title": "<?php echo ($_GET['name']); ?>", //视频标题
            "next": "<?php echo ($_GET['next']); ?>", //下一集链接
            "user": '<?php echo ($_GET['user']); ?>', //用户名
            "group": "<?php echo ($_GET['group']); ?>" //用户组
        }
        YZM.start()
    </script>
</body>

</html>