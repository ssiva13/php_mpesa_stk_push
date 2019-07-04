function populateFoods(url, div) {
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (data) {
            $.each(data.data, function (i, single) {
                div.append(
                    '<div style="border: 2px solid #005252;padding: 10px;border-radius-right: 15px; border-right-style: none; height: 67px;" class="" id="food_name" value="' + single.id + '">' + single.name + '</div>'
                );
            });
        }
    });
}

function populatePrices(url, div) {
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (data) {
            $.each(data.data, function (i, single) {
                var id = single.id;
                var Amount = single.Amount;
                var i = 0;
                i++;
                var name = single.name;
                div.append(
                    '<div style="border: 2px solid #005252; padding: 10px;border-radius-right: 8px; border-left-style: none; height: 65px; " id="price" name="food_id" value="' + id + '"><div style="margin-left:10%;">' + Amount + '/- <button style="float: right; margin-right:20%;" id="select' + i + '" onclick="payNow()" type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick ="$("#yourModal").modal({"backdrop": "static"});" value="' + id + '">SELECT THIS MEAL</button></div></div>'
                );

            });
        }
    });
}
function payNow() {
    var n = 0;
    n++;
    var id = event.target.id;
    var val = event.target.value;
    $.getJSON('http://localhost/php_mpesa_stk_push/api/food/read.php?id=' + val, function (food) {
        $('#pricediv').append('<label>Food: </label><input id="food_name" name="food_name" class="form-control" value="'
            + food.name + '" readonly></div>    <div style="visibility:hidden;"><input name="food_id" id="food_id" class="form-control" value="'
            + food.id + '" readonly></input></div><label>Price: </label><input id="food_price" name="Amount" class="form-control" value="'
            + food.Amount + '" readonly></div>');
    });
/*
    $('#myModal').on('hidden.bs.modal', function () {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end();
    })
*/

    $("#phoneForm").val('');
    
    //$("#food_name").val('');
    //$("#food_id").val('');
    //$("food_price").val('');


}

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $("#selectform").submit(function () {

        $.ajax({

            url: 'http://localhost/php_mpesa_stk_push/api/payment/lipa.php',
            type: 'POST',
            data: $('#selectform').serialize(), //serialize input
            success: function (data) {
                $('#purchaseAlertSuccess').css("display", "block");

            },
            error: function (data) {
                $('#purchaseAlertDangerMpesa').css("display", "block");
                $('#purchaseAlertSuccess').css("display", "none");

                window.setTimeout(function () {

                    // Move to a new location or you can do something else
                    window.location.href = "http://localhost/php_mpesa_stk_push/";

                }, 5000);
                return false;


            }


        });

        //event.preventDefault();
        $.ajax({

            url: 'http://localhost/php_mpesa_stk_push/api/purchases/create.php',
            type: 'POST',
            data: $('#selectform').serialize(), //serialize input
            success: function (data) {
                $('#purchaseAlertSuccess').css("display", "block");
                $('#purchaseAlertSuccessMpesa').css("display", "none");


                window.setTimeout(function () {

                    // Move to a new location or you can do something else
                    window.location.href = "http://localhost/php_mpesa_stk_push/";

                }, 5000);


            },
            error: function (data) {
                $('#purchaseAlertDanger').css("display", "block");
                return false;
            }

        });

        return false;

    });

    $(function () {
        // when the modal is closed
        $('#myModal').on('hidden.bs.modal', function () {
            // remove the bs.modal data attribute from it
            $(this).removeData('bs.modal');
            // and empty the modal-content element
            $('#pricediv').empty();
        });
    });

    populatePrices('http://localhost/php_mpesa_stk_push/api/food/read.php', $('#cost'));
    populateFoods('http://localhost/php_mpesa_stk_push/api/food/read.php', $('#foody'));

});