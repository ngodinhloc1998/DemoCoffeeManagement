
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Supplier</div>
                </div>
                <input id="text-new-supplier" type="text" class="form-control form-control-sm" required>
            </div>
            <p id="notify-supplier" style="display:none;" class="text-center text-danger mt-3">Invalid</p>
      </div>
      <div class="modal-footer">
        <button id="save-new-supplier" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Supplier</span>
                    </div>
                    <select class="custom-select" name="" id="supplier">
                        <option value="cafe1">Cafe1</option>
                        <option value="cafe2">Cafe2</option>
                        <option value="cafe3">Cafe3</option>
                        <option value="cafe4">Cafe4</option>
                        <option value="cafe5">Cafe5</option>
                        <option value="cafe6">Cafe7</option>
                        <option value="cafe8">Cafe8</option>
                        <option value="cafe9">Cafe9</option>
                        <option value="cafe10">Cafe10</option>
                        <option value="new">New Item</option>
                    </select>
                 </div> 
             </div>        
        </div>     
        <table class="table table-striped">
            <thead>
                <th style="width: 8.33%;" scope="col">#</th>
                <th style="width: 24.99%;" scope="col">Product</th>
                <th style="width: 8.33%;" scope="col">Quantity</th>
                <th style="width: 16.66%;" scope="col">Price</th>
                <th style="width: 8.33%;"></th>
            </thead>
            <tbody id="container-items">
                <tr id="item-1">
                    <th scope="row">1</th>
                    <td>
                        <select class="custom-select" name="" id="">
                            <option value="cafe1">Cafe1</option>
                            <option value="cafe2">Cafe2</option>
                            <option value="cafe3">Cafe3</option>
                            <option value="cafe4">Cafe4</option>
                            <option value="cafe5">Cafe5</option>
                            <option value="cafe6">Cafe7</option>
                            <option value="cafe8">Cafe8</option>
                            <option value="cafe9">Cafe9</option>
                            <option value="cafe10">Cafe10</option>
                            <option id="new-product-1" value="new">New Product</option>
                        </select>
                    </td>
                    <td>
                        <input id="input-qant-1" type="number" class="form-control">
                    <td>1,000,000 VND</td>
                    <td>
                        <div id="btn-delete-1" class="btn btn-danger">Delete</div>
                    </td>
                </tr>
                <tr id="item-2">
                    <th scope="row">1</th>
                    <td>
                        <select class="custom-select" name="" id="list-products-1">
                            <option value="cafe1">Cafe1</option>
                            <option value="cafe2">Cafe2</option>
                            <option value="cafe3">Cafe3</option>
                            <option value="cafe4">Cafe4</option>
                            <option value="cafe5">Cafe5</option>
                            <option value="cafe6">Cafe7</option>
                            <option value="cafe8">Cafe8</option>
                            <option value="cafe9">Cafe9</option>
                            <option value="cafe10">Cafe10</option>
                            <option value="new">New Product</option>
                        </select>
                    </td>
                    <td>
                        <input id="input-price-1" type="number" class="form-control">
                    </td>
                    <td>1,000,000 VND</td>
                    <td>
                        <div id="btn-delete-2" class="btn btn-danger">Delete</div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <div id="btn-add-item" class="btn btn-danger">
                            <i class="fas fa-plus-square"></i>
                        </div>
                    </td>
                    <td></td>
                   <td colspan="2">
                        <p>Total <strong>15,000,000 VND</strong></p>
                   </td>
                   <td>
                        <div class="btn btn-sm btn-primary">
                            Save
                        </div>
                        <div class="btn btn-sm btn-danger">
                            Cancel
                        </div>
                   </td>
                </tr>
            </tfoot>
        </table>
        <hr style="border: 2px solid black;">
    </div>
    <div class="col-md-6" style="border-right: 2px solid;">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">So tien giao dich</span>
            </div>
            <input type="text" class="form-control">
        </div>
        <div>
            <p>Tien Thua: 100,000,000 VND</p>
        </div>
    </div>
    <div class="col-md-6">
        <table class="table table-striped">
            <thead>
                <th style="width: 16.66%;" scope="col">#</th>
                <th style="width: 41.65%" scope="col">Menh Gia</th>
                <th style="width: 41.65%;" scope="col">So To</th>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>500,000 VND</td>
                    <td>0</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>200,000 VND</td>
                    <td>0</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>100,000 VND</td>
                    <td>0</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>50,000 VND</td>
                    <td>0</td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>20,000 VND</td>
                    <td>0</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>10,000 VND</td>
                    <td>0</td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>5,000 VND</td>
                    <td>0</td>
                </tr>
                <tr>
                    <th scope="row">8</th>
                    <td>2,000 VND</td>
                    <td>0</td>
                </tr>
                <tr>
                    <th scope="row">9</th>
                    <td>1,000 VND</td>
                    <td>0</td>
                </tr>
            </tbody>
            <tfoot>
            
            </tfoot>
        </table>
    </div>
</div>

<script>
    function createNewItem(index){
        var container = document.getElementById('container-items');

        var tr = document.createElement("TR");
        var tdNum = document.createElement("TH");
        tdNum.setAttribute('scope','row');
        tdNum.appendChild(document.createTextNode(parseInt(index)+1));
        tr.appendChild(tdNum);

        var tdProduct = document.createElement("TD");
        var product = document.createElement("SELECT");
        product.classList.add("custom-select");
        for(var i = 0; i < 10;i++){
            var option = document.createElement("OPTION");
            option.appendChild(document.createTextNode("Cafe"+i));
            product.appendChild(option);
        }
        tdProduct.appendChild(product);
        tr.appendChild(tdProduct);

        var tdQuantity = document.createElement("TD");
        var quantity = document.createElement("INPUT");
        quantity.setAttribute("type","number");
        quantity.classList.add("form-control");
        tdQuantity.appendChild(quantity);
        tr.appendChild(tdQuantity);

        var price = document.createElement("TD");
        price.appendChild(document.createTextNode("1,000,000 VND"));
        tr.appendChild(price);

        var tdDelete = document.createElement("td");
        var deleteBtn = document.createElement("div");
        deleteBtn.classList.add("btn");
        deleteBtn.classList.add("btn-danger");
        deleteBtn.appendChild(document.createTextNode('Delete'));
        tdDelete.appendChild(deleteBtn);
        tr.appendChild(tdDelete);

        container.appendChild(tr);

    }

    function triggerAddNewItem(){
        var btnAddItem = document.getElementById("btn-add-item");
        btnAddItem.addEventListener("click",function(){
            createNewItem(3);
        });
    }

    triggerAddNewItem();

    function triggerAddNewSupplier(){
        var supplier = document.getElementById("supplier");
        var newSupplier = document.getElementById("text-new-supplier"); 
        supplier.addEventListener("change",function(){
            console.log(supplier.value);
            if(supplier.value == 'new'){
                supplier.style.display = "none";
                newSupplier.style.display = "block";
                $("#exampleModalCenter").modal("toggle");
            }else{

            }
        });
    }

    function eventSaveNewSupplier(){
        var supplier = document.getElementById("supplier");
        var newSupplier = document.getElementById("text-new-supplier");
        newSupplier.addEventListener('input',function(){
            if(checkValidInput())
            var newOption = document.createElement("OPTION");
            newOption.appendChild(document.createTextNode(newSupplier.value));
            newOption.value = newSupplier.value;
            supplier.appendChild(newOption);
            newSupplier.style.display = "none";
            supplier.style.display = "block";
        });

    }

    function checkValidInput(input,data){

    }

    function eventTypedNewSupplier(){
        
    }



    function triggerAddNewProduct(){

    }

    function AJAXChooseSupplier(){

    }

    triggerAddNewSupplier();

</script>