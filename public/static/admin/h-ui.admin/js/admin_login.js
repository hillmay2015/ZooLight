/**
 * Created by may on 2019/5/9.
 */

//重置按钮
$('input[type="reset"]').click(function () {
    $('input[type="admin_name"]').val('');
    $('input[type="password"]').val('');
    $('input[type="captcha"]').val('');
    var capsrc = '{$verify}?d=';
    $('#verify_img').attr('src', capsrc + Math.random());
});

$(function () {
    change_verify();
})
//刷新验证码
function change_verify() {
    var capsrc = '{$verify}?d=';
    $('#verify_img').attr('src', capsrc + Math.random());
}

$('input[type="submit"]').click(function () {

    var crypt = new JSEncrypt();
    crypt.setPublicKey($('#rsa_public_key').val());

    var username = $("#admin_name").val();
    var pwd = $("#password").val();

    // 经RSA加密后的数据
    var rsa_username = crypt.encrypt(username);
    var rsa_pwd = crypt.encrypt(pwd)

    $.ajax({
        url: "{:url('login/loginPost')}",
        data: {
            "admin_name": rsa_username,
            "password": rsa_pwd,
            "captcha": $('#captcha').val()
        },
        dataType: 'json',
        type: 'post',
        success: function (data) {
            if (data.code == 1) {
                layer.msg(data.msg);
                window.location.href = '/admin/index/index';
            } else {
                layer.msg(data.msg);
                change_verify();
            }

        }
    })
})