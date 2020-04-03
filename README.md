<p align="center">
	<a target="_blank" href="https://travis-ci.org/aoju/bus">
		<img src="https://travis-ci.org/aoju/bus.svg?branch=master">
	</a>
	<a target="_blank" href="https://www.mysql.com">
		<img src="https://img.shields.io/badge/Mysql-5.7-blue.svg">
	</a>
	<a target="_blank" href="http://www.php.net">
		<img src="https://img.shields.io/badge/php-7.2.0-yellow.svg">
	</a>
	<a target="_blank" href="http://www.thinkphp.cn/">
		<img src="https://img.shields.io/badge/thinkphp-5.1.0-blue.svg">
	</a>
	<a target="_blank" href="https://www.mit-license.org">
		<img src="https://img.shields.io/badge/license-MIT-green.svg">
	</a>
</p>

<p align="center">
	-- QQ群①：<a href="https://shang.qq.com/wpa/qunwpa?idkey=c207666cbc107d03d368bde8fc15605bb883ebc482e28d440de149e3e2217460">275264059</a> --
	-- QQ群②：<a href="https://shang.qq.com/wpa/qunwpa?idkey=17fadd02891457034c6536c984f0d7db29b73ea14c9b86bba39ce18ed7a90e18">839128</a> --
</p>

**Diatto是一个基于 [Mauve](https://github.com/aoju/mauve.git) 使用的协同软件,帮助团队轻松共享和讨论工作中的任务、文件、分享、日程等内容，让团队协作焕发无限可能。所以你随时随地都可以和团队协作**
 

## 概述
- 不支持 IE8 及以下版本，建议使用基于Webkit内核的现代浏览器访问
- 为前后端分离架构，因此安装分为后端和前端两大部分，需要分别进行部署和运行
- 后端：./config/app.php   app_version

## 环境要求

- PHP >= 7.0.0 (推荐PHP7.2版本)
- MySQL >= 5.7.0 (需支持innodb引擎)
- Nginx
- PDO PHP Extension
- Redis

## 安装步骤
### 安装PHP
CentOS 6.x: 
```
rpm -Uvh https://mirror.webtatic.com/yum/el6/latest.rpm
```
CentOS 7.x: 
```
rpm -Uvh https://mirror.webtatic.com/yum/el7/epel-release.rpm
```
```
yum install php71w-common php71w-fpm php71w-opcache php71w-gd php71w-mysqlnd php71w-mbstring php71w-pecl-redis php71w-pecl-memcached php71w-devel
```
```
service php-fpm restart 或者 systemctl restart php-fpm
```
### 安装MySQL
```
rpm -Uvh https://dev.mysql.com/get/mysql57-community-release-el6-9.noarch.rpm
```
```
yum install mysql-community-server
```
修改/etc/my.conf 如下：
```
sql_mode=NO_ENGINE_SUBSTITUTION,STRICT_TRANS_TABLES
```
```
service mysqld restart 或者 systemctl restart mysqld
```
### 安装redis:
```
yum install epel-release
```
```
service redis restart 或者 systemctl restart redis
```

## 服务配置
### Nginx
```
location / { 
	try_files $uri $uri/ /index.php$uri;
    if ( -f $request_filename) {  
    	break;  
    }  
    if ( !-e $request_filename) {  
    	rewrite ^(.*)$ /index.php/$1 last;  
    	break;  
    }  
}
 location ~ \.php(.*)$ {
   fastcgi_pass   127.0.0.1:9000;
   fastcgi_index  index.php;
   fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
   fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
   fastcgi_param  PATH_INFO  $fastcgi_path_info;
   fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
   include        fastcgi_params;
}
```
### Diatto

#### 基础信息
1. 修改 ./config/database.php 修改对应信息数据库相关信息
2. 修改 ./config/app.php  中 app_debug  true/false 方便调试

#### 消息推送
1. 修改 ./diatto/common/Plugins/GateWayWorker
2. 修改 config.php，将 SERVER_ADDRESS 的值为内网IP地址，如  192.168.0.110  。端口号根据情况需改，注意服务器要放行对应的端口
3. 如果是HTTPS协议，需要开启SSL支持。将 USE_SSL 的值修改为  true  ，修改根目录下  server.key  和  server.pem 文件
4. 启动/停止服务

```
   php diatto/common/Plugins/GateWayWorker/start_register.php start &
   php diatto/common/Plugins/GateWayWorker/start_gateway.php start &
   php diatto/common/Plugins/GateWayWorker/start_businessworker.php start &
```

```
   php diatto/common/Plugins/GateWayWorker/start_register.php stop 
   php diatto/common/Plugins/GateWayWorker/start_gateway.php stop
   php diatto/common/Plugins/GateWayWorker/start_businessworker.php stop
```

#### 钉钉推送
1. 修改 ./config/config.php 修改 dingtalk_push 的值为  true  
2. 修改 ./config/dingtalk.php 修改 agent_id 的值为 对应的应用id 其中 oauth->redirect 的值为 https://你的域名/index.php/index/oauth/dingTalkOauthCallback

#### 短信服务
1. 修改  ./config/sms.php 填写对应的配置信息， debug  的值设置为  false 
2. 参考资料 [easy-sms](https://github.com/overtrue/easy-sms)

#### 邮件服务
1. 修改  ./config/mail.php 填写对应的配置信息， open  的值设置为  true 
2. 参考资料 [PHPMailer](https://github.com/PHPMailer/PHPMailer)

#### 第三方存储
1. 修改  ./config/storage.php 填写对应的配置信息，修改  stoage_type  为对应的值，目前支持上传至七牛云和阿里云OSS
2. 参考资料 [七牛](https://developer.qiniu.com/) 或者 [阿里云](https://help.aliyun.com/product/31815.html)
