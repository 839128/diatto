<?php
define('SERVER_ADDRESS', '172.171.0.9');//服务注册地址，需为内网IP地址
define('SERVER_PORT', '9003');//服务注册端口
define('CLIENT_PORT', '9002');//客户端监听端口

//ssl配置 请使用绝对路径。不开启可以不用关注
define('USE_SSL', false);//是否使用ssl
define('LOCAL_CERT', '/data/900x/9001/attach/cert.d/team.hidoctor.wiki.pem');// 证书路径也可以是crt文件
define('LOCAL_PK', '/data/900x/9001/attach/cert.d/team.hidoctor.wiki.key');
define('VERIFY_PEER', false);
define('ALLOW_SELF_SIGNED', true);//如果是自签名证书需要开启此选项
