/**
 * Created by Chenrongguang on 2016-8-28.
 */
/*全选*/
//checkbox全选按钮---标签必须（class="checkAll" onclick="clickAll()"）
function clickAll() {
    $(".checkOne").prop("checked", $(".checkAll").prop("checked"));
}

//checkbox单个按钮---标签必须（class="checkOne" onclick="clickOne()"）
function clickOne() {
    var allChecked = true;
    $(".checkOne").each(function() {
        if ($(this).prop("checked") == false) {
            allChecked = false;
        }
    });
    if (allChecked) {
        $(".checkAll").prop("checked", true);
    } else {
        $(".checkAll").prop("checked", false);
    }
}