/**
 * Created by may on 2019/4/5.
 */
var setting = {
    view: {
        dblClickExpand: false,
        showLine: false,
        selectedMulti: false
    },
    data: {
        simpleData: {
            enable:true,
            idKey: "id",
            pIdKey: "pId",
            rootPId: ""
        }
    },
    callback: {
        beforeClick: function(treeId, treeNode) {
            var zTree = $.fn.zTree.getZTreeObj("tree");
            if (treeNode.isParent) {
                zTree.expandNode(treeNode);
                return false;
            } else {
                demoIframe.attr("src",treeNode.file + ".html");
                return true;
            }
        }
    }
};

$(document).ready(function(){
    getGoodsCategory();
    function getGoodsCategory() {
        var arr;
        $.ajax({
            url: '/admin/category/getCateGory',
            dataType: 'json',
            success: function (result) {
                if (result.code) {
                    $.fn.zTree.init($("#treeDemo"), setting,result.data);
                    var zTree = $.fn.zTree.getZTreeObj("tree");
                }else{
                    layer.msg(result.msg);
                }
            }
        });
    }
});