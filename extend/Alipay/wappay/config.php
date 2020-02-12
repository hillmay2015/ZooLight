<?php

$config=[//应用ID,您的APPID。
    'app_id' => "2018102361824249",

    //商户私钥，您的原始格式RSA私钥
    'merchant_private_key' => "MIIEpAIBAAKCAQEA2li11zw0hBIcaVsNieSnC7CX79Nzz1+a0CxJyCqTloaLX7dNUh4Uk/KcYbp8KmOoxYxKl1HvLd1xtXOC76IDCUAyBeVcQTW5m+Hmg+TsJbzB6dlWcO1k0z+LJ+0uLpfAjXoQv5VeSuPUKhvc9Bhgz8K/VqjxT6lnsHtnKaEc10QzpDSyv7xk64EigNAazdjnLpTw+kyz/9bUlgbF032+3LLMMmfsdaW2Ro9W+Kh+f4MjNPxBFxkhibz+AJB6cyznKp6znRG6qmi+riUqPdI6XIuJulvFJ4TPY/eh4SvW2blW2yTUwYtiPZ88X3ssL6zUWGA3XG3HeL0Q3W5ztsjRewIDAQABAoIBADlKhYwQNAdjaSkLxyWjZWFf2L4I0Z5cC5cLx+BJq6gXbYKT6ind0rBvPDE4aVQGCkarZPcHfKagMDHYOUb/T6Shv35kjCxgGG+aeo2pB31vZcIiUNgYshfr2GuFhFSdZNy6ZqKeYrtrxEO4Q+WYb+6TvvjSI18vqBFaj9sQdyzUMFITDAiHwOazxd3p1RymQN+6EZ2XvYPUKiEk15j00bv1dyF9XDwWS84WxWWvE/Epzb7SBCVSc7DR1ioasENId2AIPA+ecpKRmGAgc32AIJzlvieiP1rt6xHlzdYiqJIyJficmaNiVjJqRBDZc2DQ5S07+lncaUBb/VT7iQo0xuECgYEA8GMlwfeLEpXeIndZqkUtDlFZTLL0Wt1KHlSHaeeSg0fY4l4vzwUVii3tOJVbpAqAaw5O36lEO/tyX+GNN01gWtoV61zsx8eGCHBoteBd5Bu7SpPG7Dgm5TSoXSC7tuiEObrgGg1muYGIfhOZhnQYZ5o378dlezUM0hywmogVuL0CgYEA6IcY2pOdQxzvsMCjl4+WoAZ02Rp8FziOxFlzjrCaJZisnECmbuF9TAI0YMcoByyxRd4mhKHWqwe/huXkjzi5gzI61OCIAVdrgtMw8ATKxS1dkecn8qR+wYQI04zrxGcxTNfRpc1kaYrVzFzzCECMS+ZV5m5I3Kia5sjyR9uK4pcCgYEAtsKKmFe9slmi0w1ubFe/k50hiYCc6uBHU5vsgAYBjDH5oND/BCPXZoDYVCapz6P0UnBEYyNrrzbSlDcFiEAZu7kG5TR3CMSXEJ913KFCgQTcdiy4Fivy1lwcjQEv9jX9IW8Epon9yZfD0CbSmDh3vXywfmpYqz2AC9aoJjTEXvkCgYBF73QDMYiICejxUU8io3YbFTYJohSWa1VNKtY9oVILYrrvl+Y2zS0BMlyMivm4BrIeoG0XURGeiQsKyJQQm2/4TKAzLIDbXm6gf2JlnhtaaIWO/2YdbWoOS+bXsberb5n9UZ/lbTv5Hl+lQoN6BOftYA6P6rWRYEiOhvuPrzE7awKBgQCyX49bCsnY8rCcqlpDXWbmm3m8u8sPUjazjUk+DvFWn2gj+APGOER30+i1mhKuHeBjYrZz1gSQ5+JBvWXY9iWYRFj9Egp2oCy/OENOsG0M0R7KmvPRUXcbsd4OPsuNMbmdd/ylGpVMpm30arSlCaum6Zp+EQCATK3gXI25YiBzbw==",
    //异步通知地址
    'notify_url' => "http://xxx/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",

    //同步跳转
    'return_url' => "http://mitsein.com/alipay.trade.wap.pay-PHP-UTF-8/return_url.php",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmN4T6I53xtt76TLJQUKoOITkA+RkU1Q9K+oM9zjCtYJqi8wpRwxO0sJZLBgI6QfwDyTFT2ddQlWYt975iZlMVLoUidEJQc2h7VTBhxqDx2UBL++7ON4zva5ebNS0hgaF53SyJKqUrL8mpKV683H0pB01ioTLoM4dvxY8UlNeAjRn+kDVxV4w+QdJPfcDYF4uIHKydTgsnkHlRkBn1mTdw6w4iwuRcrpUiIA3Hk6NZzd7d/HmL0JW43/C9PD5TP85fVClLXKlkLqBTjHPnCCi//WG1WnQOkEFKYsZhxJaBUP5XUGKfJgv3enYzofTuhtDK3e4zqZRUSaWqb3qCHNQywIDAQAB"
];
