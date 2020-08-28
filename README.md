# qscmf 所见即所得组件

## install
composer require quansitech/qscmf-wsig

## usage
1. 先在前台html页面设置需要配置的元素，配置办法可详见 [所见即所得react组件](https://github.com/quansitech/react-wysiwyg)
2. 在后台页面调用组件生成控件页面
```php
$pc = new Wsig();  //初始化不指定宽高，自适应后台页面大小，适合PC端页面展示
//或者
$mobile = new Wsig(411, 731); //设置固定宽高尺寸，适合移动端

//渲染组件html效果
//第一个参数是前台页面的html
//第二个参数是所见即所得react组件需要配置的options 具体查看react组件说明文档
$mobile->render('/?mobile=1', ['imageUploadUrl' => '/api/upload/uploadImage']);
```
3. 修改页面的内容，点击保存后自动将内容保存到数据库。
4. 可通过 WsigData::getValue($key)来获取对应的设置值。

## 提示
1. 组件是通过iframe嵌套前台页面，同时给页面注入js启动代码来渲染完成页面的元素可配置化。所以当需要展示移动端页面时，iframe是无法做到发送移动端的user-agent给php程序的。
所以此时需要通过url请求参数的方式来获取移动端的html主题。可见上例的?mobile=1
