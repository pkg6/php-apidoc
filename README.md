# PHP-ApiDoc

**为基于 PHP 的 API 应用生成文档**
 无需依赖框架，无需额外依赖。

------

## 📋 环境要求

- PHP >= 5.3.2

## 📦 安装

使用 Composer 安装：

```
composer require pkg6/apidoc
```

## 🚀 使用方法

在你的类和方法上使用注解：

~~~
namespace Pkg6\Apidoc\Tests\TestClasses;

class User
{
    /**
     * @ApiDescription(section="User", description="获取用户信息")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/user/get/{id}")
     * @ApiParams(name="id", type="integer", nullable=false, description="用户ID")
     * @ApiParams(name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *   'transaction_id':'int',
     *   'transaction_status':'string'
     * }")
     */
    public function get() {}

    /**
     * @ApiDescription(section="User", description="创建新用户")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/user/create")
     * @ApiParams(name="username", type="string", nullable=false, description="用户名")
     * @ApiParams(name="email", type="string", nullable=false, description="邮箱")
     * @ApiParams(name="password", type="string", nullable=false, description="密码")
     * @ApiParams(name="age", type="integer", nullable=true, description="年龄")
     */
    public function create() {}
}

~~~

## ⚙️ 生成 API 文档

~~~
<?php

use Pkg6\Apidoc\Builder;

require 'vendor/autoload.php';

$classes = array(
    "Pkg6\Apidoc\Tests\TestClasses\User",
    "Pkg6\Apidoc\Tests\TestClasses\Article"
);

$output_file = 'api.html'; // defaults to index.html
try {
    $builder = new Builder($classes, ".", 'Api Title', $output_file);
    $builder->generate();
} catch (Exception $e) {
    echo 'There was an error generating the documentation: ', $e->getMessage();
}
~~~

然后通过命令行执行该文件：

~~~
php apidoc.php
~~~

生成的API文档将保存在 `api.html` 。

## 🧩 支持的注解方法

目前支持以下注解：

- `@ApiDescription(section="...", description="...")`
- `@ApiMethod(type="get|post|put|delete|patch")`
- `@ApiRoute(name="...")`
- `@ApiParams(name="...", type="...", nullable=..., description="...", [sample="..."])`
- `@ApiHeaders(name="...", type="...", nullable=..., description="...")`
- `@ApiReturnHeaders(sample="...")`
- `@ApiReturn(type="...", sample="...")`
- `@ApiBody(sample="...")`

## 💡 小技巧

如果你希望展示复杂对象的输入示例，可以使用 `@ApiParams` 并设置 `type=object|array|array(object)`，例如：

~~~
@ApiParams(
    name="data", 
    type="object", 
    sample="{'user_id':'int','profile':{'email':'string','age':'integer'}}"
)
~~~

## 🙏 感谢

本项目灵感来源并参考了优秀的开源项目 [calinrada/php-apidoc](https://github.com/calinrada/php-apidoc)，在此致以诚挚感谢 🙌。
