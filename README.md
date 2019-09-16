# poeaa
企业应用架构模式（Patterns of Enterprise Application Architecture）示例代码

# 安装依赖组件
本示例代码采用Composer管理组件依赖，执行Composer安装命令，安装相关依赖组件
```shell script
composer install
```

# 生成示例数据库表结构
本示例采用SQLite数据库，数据库文件位于：/database/poeaa.sqlite

本示例数据库使用Doctrine Migration组件管理数据库迁移文件，迁移文件位于：/database/migration

执行Doctrine数据库迁移命令，可自动生成数据库表结构
```shell script
"vendor/bin/doctrine-migrations" migrate
```
