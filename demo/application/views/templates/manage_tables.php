
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Book Table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <p>Book Table</p>
            <div class="input-group mb-3">
                <label class="input-group-text" for="date">Date</label>
                <input type="date" id="date" class="form-control-sm">
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="time-start">Time Start</label>
                <input type="time" id="time-start" class="form-control-sm">
            </div>
            <hr>
            <p style="display:none;" id="notification" class="text-danger">Please enter date and time for book table</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn-close-book-table" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-book-button">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!--ADD TABLE-->
<div class="modal fade" id="modalAddNewTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTableLabel">Add Table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="input-add">Table</label>
            <input id="input-new-table" type="number" class="form-control">
            <p style="display: none;" id="notify-add" class="border text-center mt-3">Notification</p>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" style="display: none;" class="btn btn-primary" id="add-table-button">Add new table</button>
      </div>
    </div>
  </div>
</div>
<!--END ADD TABLE-->

<!--DELETE TABLE-->
<div class="modal fade" id="modalDeleteTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="deleteTableLabel">Delete Table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label class="text-danger" for="choose">Choose Table</label>
            <select name="" id="name-table" class="custom-select">
                <?php foreach($tables as $table): ?>
                <option value="<?php echo $table['name']; ?>"><?php echo $table['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <p style="display: none;" id="notify-delete" class="border text-center mt-3">Notification</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <button type="button" style="display: none;" class="btn btn-danger" id="delete-table-button">Delete this table</button>
      </div>
    </div>
  </div>
</div>
<!--DELETE ADD TABLE-->



<div class="row el-element-overlay">
    <?php foreach($tables as $row): ?>
    <?php $temp = preg_replace('/[^0-9]/','',$row['name']);?>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1"> 
                    <?php if($row['status'] == 'available'): ?>
                    <img id="image-table-<?php echo $temp;?>" src="<?php echo base_url('public/assets/images/big/tables/available.svg');?>" alt="user" />
                    <?php elseif($row['status'] == 'booked'): ?>
                    <img id="image-table-<?php echo $temp;?>" src="<?php echo base_url('public/assets/images/big/tables/booked.svg');?>" alt="user" />
                    <?php else: ?>
                    <img id="image-table-<?php echo $temp;?>" src="<?php echo base_url('public/assets/images/big/tables/active.svg');?>" alt="user" />
                    <?php endif; ?>
                </div>
                <div class="el-card-content">
                    <h4 class="m-b-0"><?php echo $row['name']; ?></h4>
                    <div class="m-b-0">
                        <p>Status <strong class="text-success" id="status-table-<?php echo $temp;?>"><?php echo $row['status'];?></strong></p>
                    </div>
                    <div id="group-button-tables-<?php echo $temp;?>" class="row m-b-0">
                        <?php if($row['status'] == 'available'):?>
                            <div class="col-md-6 text-muted">
                                <button id="btnLeft-<?php echo $temp;?>" class="btn btn-outline-success">Order</button>
                            </div>
                            <div class="col-md-6 text-muted">
                                <button id="btnRight-<?php echo $temp;?>" class="btn btn-outline-info">Book</button>
                            </div>
                        <?php elseif($row['status'] == 'booked'):?>
                             <div class="col-md-6 text-muted">
                                <button id="btnLeft-<?php echo $temp;?>" class="btn btn-outline-success">Order</button>
                            </div>
                            <div class="col-md-6 text-muted">
                                <button id="btnRight-<?php echo $temp;?>" class="btn btn-outline-danger">Cancel</button>
                            </div>
                        <?php else:?>
                            <div class="col-md-6 text-muted">
                                <button id="btnLeft-<?php echo $temp;?>" class="btn btn-outline-success">Order</button>
                            </div>
                            <div class="col-md-6 text-muted">
                                <button id="btnRight-<?php echo $temp;?>" class="btn btn-outline-warning">Pay</button>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>                
   
<script>
    
    <?php reset($tables);?>
    <?php foreach($tables as $table): ?>
        updateStatusTables('<?php echo $table['name'];?>','<?php echo $table['id']; ?>');
        <?php if($table['status'] == 'booked'): ?>
        autoUnBookedTable('<?php echo $table['book_at']; ?>');
        <?php endif;?>
    <?php endforeach; ?>

    function updateStatusTables(index,id){
        index = index.replace(/\D/g,'');
        var btnLeft = document.getElementById('btnLeft-'+index);
        var btnRight = document.getElementById('btnRight-'+index);
        btnLeft.addEventListener("click",function(){
            var status = document.getElementById('status-table-'+index).innerHTML.toLowerCase();
            var btnLeft = document.getElementById('btnLeft-'+index);
            var btnRight = document.getElementById('btnRight-'+index);
            var image = document.getElementById('image-table-'+index);
            var statusTable = document.getElementById('status-table-'+index);
            if(status == 'available'){
                statusTable.innerHTML = 'active';
                statusTable.classList.remove('text-success');
                statusTable.classList.add('text-danger');
                image.src = '<?php echo base_url('public/assets/images/big/tables/active.svg');?>';
                btnRight.innerHTML = "Pay";
                btnRight.classList.remove('btn-outline-info');
                btnRight.classList.add('btn-outline-warning');
                window.location.href = '<?php echo base_url('middleware/redirect_new_order/') ?>'+id;
            }else if(status == 'booked'){
                statusTable.innerHTML = 'active';
                statusTable.classList.remove('text-warning');
                statusTable.classList.add('text-danger');
                image.src = '<?php echo base_url('public/assets/images/big/tables/active.svg');?>';
                btnRight.innerHTML = "Pay";
                btnRight.classList.remove('btn-outline-danger');
                btnRight.classList.add('btn-outline-warning');
                window.location.href = '<?php echo base_url('middleware/redirect_new_order/') ?>'+id;
            }else{
                window.location.href = '<?php echo base_url('middleware/redirect_order/') ?>'+id;
            }
            
        });
        btnRight.addEventListener("click",function(){
            var status = document.getElementById('status-table-'+index).innerHTML.toLowerCase();
            var btnLeft = document.getElementById('btnLeft-'+index);
            var btnRight = document.getElementById('btnRight-'+index);
            var image = document.getElementById('image-table-'+index);
            var statusTable = document.getElementById('status-table-'+index);
            if(status == 'available'){
                $("#exampleModal").modal('show');
                var save = document.getElementById("save-book-button");
                var inputDate = document.getElementById('date');
                var timeStart = document.getElementById('time-start');
                var noti = document.getElementById("notification");
                save.addEventListener("click",function(){
                if(checkValidDateTime(inputDate.value,timeStart.value)){
                    noti.style.display = "block";
                    noti.classList.remove("text-danger");
                    noti.classList.add('text-success');
                    //console.log(inputDate.value);
                    //console.log(timeStart.value+':00');
                    timeBook = inputDate.value +" "+ timeStart.value+':00';
                    //console.log(timeBook);
                    (AJAXBookTable(id,timeBook));
                    statusTable.innerHTML = 'booked';
                    statusTable.classList.remove('text-success');
                    statusTable.classList.add('text-warning');
                    image.src = '<?php echo base_url('public/assets/images/big/tables/booked.svg');?>';
                    btnRight.innerHTML = "Cancel";
                    btnRight.classList.remove('btn-outline-info');
                    btnRight.classList.add('btn-outline-danger');
                }else{
                    noti.style.display = "block";
                    noti.classList.remove("text-success");
                    noti.classList.add('text-danger');  
                }
                //AJAXBookTable(idTable,timeBook);
                });
        
            }else if(status == 'booked'){
                statusTable.innerHTML = 'available';
                statusTable.classList.remove('text-warning');
                statusTable.classList.add('text-success');
                image.src = '<?php echo base_url('public/assets/images/big/tables/available.svg');?>';
                this.innerHTML = "Book";
                this.classList.remove('btn-outline-danger');
                this.classList.add('btn-outline-info');
                AJAXCancelBookTable(id);
            }else{
                statusTable.innerHTML = 'available';
                statusTable.classList.remove('text-danger');
                statusTable.classList.add('text-success');
                image.src = '<?php echo base_url('public/assets/images/big/tables/available.svg');?>';
                this.innerHTML = "Book";
                this.classList.remove('btn-outline-warning');
                this.classList.add('btn-outline-info');
                window.location.href = '<?php echo base_url('middleware/redirect_checkout/')?>' +id;
            }
        });        
    }

    function getTodayTime(){
        var date = new Date();
        var dd = date.getDate();
        var mm = date.getMonth() + 1; //January is 0;
        var yyyy = date.getFullYear();
        if(dd < 10){
            dd = '0' + dd;
        }
        if(mm < 10){
            mm = '0' + mm;
        }
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();
        if(hours < 10){
            hours = '0' + hours;
        }
        if(minutes < 10){
            minutes = '0' + minutes;
        }
        if(seconds < 10){
            seconds = '0' + seconds;
        }
        var today = {};
        today['date'] = yyyy+'-'+mm+'-'+dd;
        today['time'] = hours+':'+minutes;
        //console.log(today);
        return today;
    }

    function checkValidDateTime(inputDate,inputTimeStart){
        today = getTodayTime();
        //console.log(today);
        inputDate = inputDate.split('-');
        inputTimeStart = inputTimeStart.split(':');
        var todayDate = (today.date).toString();
        todayDate = todayDate.split('-');
        var todayTime = (today.time).toString();
        todayTime = todayTime.split(':');
        //console.log(todayDate[0]);
        //console.log(todayTime[0]);
        if(inputDate[0] >= todayDate[0] && (inputDate[0] <= (todayDate[0]+1))){
          if(inputDate[0] == todayDate[0]){
              if(inputDate[1] >= todayDate[1]){
                  if(inputDate[1] == todayDate[1]){
                      if(inputDate[2] >= todayDate[2]){
                          if(inputDate['2'] == todayDate[2]){
                            var validTime = (inputTimeStart[1] - todayTime[1]) + (inputTimeStart[0] - todayTime[0]) * 60;
                            if(validTime >= 15){
                                return true;
                            }
                          }else{
                            return true;  
                          }
                      }
                  }else{
                    return true; 
                  }
              }
          }else{
            return true;
          }
        }
        return false;
    }

    function triggerButtonBook(idTable){
        var save = document.getElementById("save-book-button");
        var inputDate = document.getElementById('date');
        var timeStart = document.getElementById('time-start');
        var noti = document.getElementById("notification");
        save.addEventListener("click",function(){
            if(checkValidDateTime(inputDate.value,timeStart.value)){
                noti.style.display = "block";
                noti.classList.remove("text-danger");
                noti.classList.add('text-success');
                //console.log(inputDate.value);
                //console.log(timeStart.value+':00');
                timeBook = inputDate.value +" "+ timeStart.value+':00';
                //console.log(timeBook);
                (AJAXBookTable(idTable,timeBook));
            }else{
                noti.style.display = "block";
                noti.classList.remove("text-success");
                noti.classList.add('text-danger');  
            }
            //AJAXBookTable(idTable,timeBook);
        });

    }


    function AJAXBookTable(idTable,timeBook){
       var sign = false; 
       $.ajax({
           type:'post',
           url:"<?php echo base_url('business/book_table');?>",
           data:{id_table:idTable,time_booked:timeBook}
       }).done(function(data){
           //console.log(data);
           var close = document.getElementById("btn-close-book-table").click();
           sign = true;
       }).fail(function(jqXHR,textStatus){
           console.log(jqXHR);
       });
       return sign;
    }

    function AJAXCancelBookTable(idTable){
        $.ajax({
           type:'post',
           url:"<?php echo base_url('business/cancel_book_table');?>",
           data:{id_table:idTable}
       }).done(function(data){
           alert(data);
       }).fail(function(jqXHR,textStatus){
           console.log(jqXHR);
       });
    }

    
    function autoUnBookedTable(timeOut){
        var today = getTodayTime();
        var dateAndTimeNow = today['date'] + "T" + today['time'] + ":00";
        var timeNow = Date.parse(dateAndTimeNow);
        timeOut = Date.parse(timeOut) + 15*60*1000;
        if(timeNow > timeOut){
            return false;
        }else{
            var intervalTimeOut = setTimeout(function(){
                location.reload();
            },timeOut-timeNow);
        }
    }

    function triggerAddNewTable(){
        var notify = document.getElementById("notify-add");
        var newTable = document.getElementById('input-new-table');
        var btnAddNewTable = document.getElementById('add-table-button');
        newTable.addEventListener("input",function(){
            var tableIsExists = false;
            <?php reset($tables); foreach($tables as $table): ?>
                if(('Table ' + this.value) == '<?php echo $table['name']; ?>'){
                    tableIsExists = true;
                }
            <?php endforeach; ?>

            if(tableIsExists){
                btnAddNewTable.style.display = "none";
                notify.style.display = "block";
                notify.innerHTML = "Table is exists , please choose another name";
                notify.classList.remove('text-success');
                notify.classList.add('text-danger');
            }else{
                if(newTable){
                    notify.innerHTML = "You can add new table";
                    notify.classList.remove('text-danger');
                    notify.classList.add('text-success');
                    btnAddNewTable.style.display = "block";
                    btnAddNewTable.addEventListener("click",function(){
                        AJAXAddNewTable(newTable.value);
                    });
                }
            }
        });
    }

    function AJAXAddNewTable(newTable){
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('business/add_new_table'); ?>',
            data:{name:newTable}
        }).done(function(data){
            document.getElementById("notify-add").innerHTML = data;
            document.getElementById("notify-add").classList.remove('text-danger');
            document.getElementById("notify-add").classList.add('text-success');
            setInterval(function(){
                location.reload();
            },5000);
        }).fail(function(jqXHR,textStatus){
            document.getElementById("notify-add").innerHTML = "Failed to add new table";
            document.getElementById("notify-add").classList.remove('text-success');
            document.getElementById("notify-add").classList.add('text-danger');
            console.log(jqXHR);
        });
    }
    
    function triggerDeleteTable(){
        var nameTable = document.getElementById("name-table");
        var notify = document.getElementById("notify-delete");
        var btnDelete = document.getElementById("delete-table-button");
        nameTable.addEventListener("change",function(){
            notify.style.display = "block";
            notify.classList.remove('text-success');
            notify.classList.add('text-danger');
            notify.innerHTML = "Are you sure with this decision ?";
            btnDelete.style.display = "block";
            btnDelete.addEventListener("click",function(){
                AJAXDeleteTable(nameTable.value);
            });
        });
    }

    function AJAXDeleteTable(tableName){
        var notify = document.getElementById("notify-delete");
        $.ajax({
            type: "post",
            url: '<?php echo base_url("business/delete_table"); ?>',
            data: {name:tableName}
        }).done(function(data){
            notify.style.display = "block";
            notify.innerHTML = data;
            notify.classList.remove("text-danger");
            notify.classList.add("text-success");
            setTimeout(function(){
                location.reload();
            },5000);
        }).fail(function(jqXHR,textStatus){
            notify.style.display = "block";
            notify.innerHTML = "Failed to delete table";
            notify.classList.remove("text-success");
            notify.classList.add("text-danger");
            console.log(jqXHR);
        });
    }

    triggerAddNewTable();
    triggerDeleteTable();
   
</script>