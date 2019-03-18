<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" style="width:8.33%;">#</th>
            <th scope="col" style="width:8.33%;">Product</th>
            <th scope="col" style="width:8.33%;">Price</th>
            <th scope="col" style="width:8.33%;">Quantity</th>
            <th scope="col" style="width:8.33%;">Subtotal</th>
            <th style="width:8.33%;"></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; foreach($products as $product): ?>
        <tr id="product-<?php echo $product['id']; ?>">
            <th scope="row"><?php echo $i+1; ?></th>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo number_format($product['price']); ?> VND</td>
            <td>
                <input id="quantities-product-<?php echo $product['id']; ?>" type="number" class="form-control text-center" value="<?php echo $product['quantities'];?>">
            </td>
            <td id="total-<?php echo $product['id']; ?>"><?php echo number_format($product['total']); ?> VND</td>
            <td>
                <button id="btn-update-<?php echo $product['id']; ?>" class="btn btn-sm btn-outline-primary">Update</button>
                <button id="btn-delete-<?php echo $product['id'];?>" class="btn btn-sm btn-outline-danger">Delete</button>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td><a  href="<?php echo base_url('manage_products/show_products'); ?>" class="btn btn-danger"><i class="fa fa-angle-left"> Back to menu</i></a></td>
            <td colspan="3"></td>
            <td>Total <strong id="total"><?php echo number_format($invoice->total*1.1); ?> </strong> VND</td>
            <td><a style="display:none;color: white" id="check-out"  class="btn btn-info">Check Out <i class="fa fa-angle-right"></i></a></td>
        </tr>
    </tfoot>
</table>
<hr style="border:2px solid;">
<div class="row">
    <div class="col-md-4">
        <div class="input-group">
            <div class="input-group-append">
                <span class="input-group-text">Tiền Khách Đưa $</span>
            </div>
            <input id="guest-cash" type="text" class="form-control is-invalid">
        </div>
        <p style="margin-top: 30px;">Tiền thừa <strong id="excess-money"> 0</strong> VND</p>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-6">
        <table class="table-striped">
            <thead>
                <th scope="col" style="width:16.66%;">#</th>
                <th scope="col" style="66.68%">Type</th>
                <th scope="col" style="width:16.66%;">Quantities</th>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td id="value-cash-1">500000 VND</td>
                    <td id="quant-1">0</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td id="value-cash-2">200000 VND</td>
                    <td id="quant-2">0</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td id="value-cash-3">100000 VND</td>
                    <td id="quant-3">0</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td id="value-cash-4">50000 VND</td>
                    <td id="quant-4">0</td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td id="value-cash-5">20000 VND</td>
                    <td id="quant-5">0</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td id="value-cash-6">10000 VND</td>
                    <td id="quant-6">0</td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td id="value-cash-7">5000 VND</td>
                    <td id="quant-7">0</td>
                </tr>
                <tr>
                    <th scope="row">8</th>
                    <td id="value-cash-8">2000 VND</td>
                    <td id="quant-8">0</td>
                </tr>
                <tr>
                    <th scope="row">9</th>
                    <td id="value-cash-9">1000 VND</td>
                    <td id="quant-9">0</td>
                </tr>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
</div>

<script>

    document.getElementById("guest-cash").focus();
    function pressButtonUpdate(){
        <?php reset($product); foreach($products as $product): ?>
            var btnUpdate = document.getElementById("btn-update-<?php echo $product['id']; ?>"); 
            btnUpdate.addEventListener("click",function(){
                var input = document.getElementById("quantities-product-<?php echo $product['id']; ?>");
                console.log(input.value);
                AJAXUpdateQuantities(<?php echo $product['id'] ?>,input.value);
            });
        <?php endforeach; ?>
    }

    function AJAXUpdateQuantities(id,value){
        $.ajax({
            type:"post",
            url:"<?php echo base_url('manage_products/update_quantities_product'); ?>",
            data:{id_product:id,quantities:value}
        }).done(function(data){
            change = JSON.parse(data);
            console.log(data);
            document.getElementById("total").innerHTML = change.totalInvoice;
            document.getElementById("total-"+id).innerHTML = change.totalProduct + " VND";
            alert("success");
        }).fail(function(data,jqXHR,textStatus){
            alert("failed");
        });
    }

    function pressButtonDelete(){
        <?php reset($products); foreach($products as $product): ?>
            var btnDelete = document.getElementById("btn-delete-<?php echo $product['id']; ?>");
            btnDelete.addEventListener("click",function(){
                //alert(<?php echo $product['id']; ?>);
                AJAXDeleteProductInDetailInvoice(<?php echo $product['id']; ?>);            
            });
        <?php endforeach; ?>
    }

    function AJAXDeleteProductInDetailInvoice(id_product){
        $.ajax({
            type:"post",
            url: "<?php echo base_url('manage_products/detele_product_in_detail_invoice'); ?>",
            data:{id:id_product}
        }).done(function(data){
            //var product = document.getElementById("product-"+id_product);
            //product.style.display = "none";
            $("#product-" + id_product).fadeOut(1500);
            document.getElementById("total").innerHTML = data;
        }).fail(function(data,jqXHR,textStatus){
            console.log(data);
        });
    }

    function checkOutCondition(){
        var checkOut = document.getElementById("check-out");
        var guestCash = document.getElementById("guest-cash").value;
        var trueValue = parseInt(guestCash.replace(/[^0-9]/g,''));
        var total = document.getElementById("total").innerHTML;
        total = parseInt(total.replace(/[^0-9]/g,''));
        if(trueValue >= total){
            document.getElementById("guest-cash").classList.remove("is-invalid");
            document.getElementById("guest-cash").classList.add("is-valid");
            document.getElementById("excess-money").innerHTML = trueValue - total;
            exchangeCash(trueValue,total);
            $("#check-out").fadeIn(1000);
        }else{
            document.getElementById("guest-cash").classList.remove("is-valid");
            document.getElementById("guest-cash").classList.add("is-invalid");
            document.getElementById("excess-money").innerHTML = "0 VND";
            for(var i = 1; i < 10; i++){
                var quantities = document.getElementById("quant-"+i).innerHTML = 0;
            }
            $("#check-out").fadeOut(0);
            return;
        }
    }

    function firedCheckOutCondition(){
        var guestCash = document.getElementById("guest-cash");
        guestCash.addEventListener("input",function(){
            checkOutCondition();
        });
    }

    function exchangeCash(guestMoney,total){
        var excessMoney = guestMoney-total;
        for(var i = 1;i < 10; i++){
            var quantities = document.getElementById("quant-"+i);
            var valueCash = document.getElementById("value-cash-"+i);
            valueCash = parseInt(valueCash.innerHTML);
            if(excessMoney/valueCash > 0){
                quantities.innerHTML = parseInt(excessMoney/valueCash);
                excessMoney = excessMoney - parseInt(excessMoney/valueCash)*valueCash;
            }else{
                quantities.innerHTML = 0;
            }
        }
    }

    function pressCheckOut(){
        var checkOut = document.getElementById("check-out");
        checkOut.addEventListener("click",function(){
            var guestCash = document.getElementById("guest-cash").value;
            window.location.href = "<?php echo base_url(); ?>"+'business/charge_invoice/'+guestCash;
        });
    }

    pressButtonUpdate();
    pressButtonDelete();
    firedCheckOutCondition();
    pressCheckOut();    

</script>