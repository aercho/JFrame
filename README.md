# JFrame
轻量级PHP微小项目框架

## JFrame概述

JFrame是一个日常工作中总结、提炼而出的用于微小PHP项目的快速框架，用于快速构建工作中遇到的微小PHP项目。JFrame支持简单的MVC、MySQL数据库、Redis缓存以及Smarty模板系统。

JFrame完美支持composer安装使用，依赖的外部库Smarty不加入版本控制，请使用composer命令自助安装，初始化JFrame后，在命令行模式下`composer update`即可；JFrame需PHP环境不低于5.5，建议PHP7.0及其以上环境。

JFrame非常适合用于微小PHP项目或内部流量可控、可预测项目，用于大中型项目请谨慎选择。


## JFrame的MVC支持情况

JFrame设计成单一入口形式，同伙php的pathinfo模式传递框架参数和Get变量参数。JFrame的url结构为两层文件夹结构式，譬如`http://yourdomain/home/page`（或`http://yourdomain/home/page.html`）这种结构的url，通过服务器的rewrite后`home`就是执行的控制器类的名称（实际类名称是带有Controller后缀的，也就是`HomeController`），而`page`则为执行的home类中的page方法（PHP的类方法不区分大小写的机制导致操作名不区分大小写），当然这个方法必须是`public`作用域。关于服务器rewrite和php的pathinfo不再赘述。

JFrame利用PHP的反射（Reflection）机制，映射类名和方法名，用于执行控制器类和控制器方法，为了便于说明，称通过反射执行的PHP类为控制器（有时也会称之为控制器类，指代特定类型的统一PHP类），类中被执行的方法（public作用域）为操作。

在控制器类中可以通过命名空间（use语句）调用模型类，模型类与数据表一一对应，简化了MySQL对应数据表的操作，当然你也可以建立一个不予数据表对应的模型，为了便于叙述这种模型称之为空模型。

控制器类中自动初始化Smarty模板系统，通过Smarty快速构建前端界面。

## JFrame的MySQL数据库支持情况


## JFrame的Redis缓存支持情况


## JFrame的Smarty模板系统支持情况


## JFrame的常见问题