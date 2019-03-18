
<!-- Modal Add New User-->
<div class="modal fade" id="modalAddNewUser" tabindex="-1" role="dialog" aria-labelledby="modalAddNewUser" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 mb-2">
                <label for="input-name">Name</label>
                <input id="input-name" class="form-control border" type="text" placeholder="Enter Your Name">
                <p id="notify-input-name" class="text-danger border mt-2">Name must not be empty</p>
            </div>
            <div class="col-sm-12 mb-2">
                <label for="input-cmnd">Identity Card</label>
                <input id="input-cmnd" class="form-control border" type="number" placeholder="Enter Your Indentity Card">
                <p id="notify-input-cmnd" class="text-danger border mt-2">Entity card must not be empty</p>
            </div>
            <div class="col-sm-12 mb-2">
                <label for="input-username">Username</label>
                <input id="input-username" class="form-control border" type="text" placeholder="Enter Your Username">
                <p id="notify-input-username" class="text-danger border mt-2">Username must not be empty</p>
            </div>
            <div class="col-sm-12 mb-2">
                <label for="input-password">Password</label>
                <input id="input-password" class="form-control border" type="password" placeholder="Enter Your Password">
                <p id="notify-input-password" class="text-danger border mt-2">Password must not be empty</p>
            </div>
            <div class="col-sm-12 mb-2">
                <label for="input-password-confirm">Confirm Password</label>
                <input id="input-password-confirm" class="form-control border" type="password" placeholder="Confirm Your Password">
                <p id="notify-input-password-confirm" class="text-danger border mt-2">Password confirm must not be empty</p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="btn-close-create-new-account" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button id="btn-create-new-account" style="display: none;" type="button" class="btn btn-info">Create New Account</button>
      </div>
    </div>
  </div>
</div>

<!--Modal Reset Password-->

<div class="modal fade" id="modalResetPassword" tabindex="-1" role="dialog" aria-labelledby="modalResetPassword" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 mb-2">
                <label for="input-reset-new-password">Password</label>
                <input id="input-reset-new-password" class="form-control border" type="password" placeholder="Enter Your Password">
            </div>
            <div class="col-sm-12 mb-2">
                <label for="input-reset-confirm-password">Confirm Password</label>
                <input id="input-reset-confirm-password" class="form-control border" type="password" placeholder="Confirm Your Password">
            </div>
            <div class="col-sm-12 mb-2">
                <p id="notify-reset-password" style="display: none;" class="mt-2 border text-center">Notification</p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn-close-reset-password" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button style="display: none;" id="btn-save-changes-reset-password" type="button" class="btn btn-info">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!--========================================================-->

<div class="row justify-content-center">
    <div class="col-md-12">
        <table class="table table-striped mb-5">
            <thead>
                <tr>
                    <th style="width:8.33%;" scope="col">Id</th>
                    <th style="width:24.99%;" scope="col">Name</th>
                    <th style="width:16.66%;" scope="col">Username</th>
                    <th style="width:16.66%;" scope="col">Identity Card</th>
                    <th style="width: 8.33%;" scope="col">Status</th>
                    <th style="width:24.99%;" scope="col"></th>
                </tr>
            </thead>
            <tbody id="container-user">
                <?php foreach($users as $user): ?>
                <tr id="user-<?php echo $user['id']; ?>">
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['cmnd']; ?></td>
                    <td><?php echo $user['status']; ?></td>
                    <td>
                        <div data-toggle="modal" data-target="#modalResetPassword" id="btn-reset-password-<?php echo $user['id']; ?>" class="btn btn-xs btn-info">Reset Password</div>
                        <div id="btn-delete-user-<?php echo $user['id']; ?>" class="btn btn-xs btn-danger">Delete</div>
                    </td>
                <?php endforeach; ?>    
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <div id="btn-add-new-user" data-toggle="modal" data-target="#modalAddNewUser" class="btn btn-info">Add new user</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    
    function validateChangePassword(){
        var newPassword = document.getElementById("input-reset-new-password");
        var confirmPassword = document.getElementById("input-reset-confirm-password");
        var notify = document.getElementById("notify-reset-password");
        var btnSaveChangesResetPassword = document.getElementById("btn-save-changes-reset-password");
        
        newPassword.addEventListener("input",function(){
            if(this.value.length < 6){
                btnSaveChangesResetPassword.style.display = "none";
                notify.style.display = "block";
                notify.classList.remove("text-success");
                notify.innerHTML = "Password must be at least 6 character";
                notify.classList.add("text-danger");        
            }else{
                if(confirmPassword.value.length == 0){
                    btnSaveChangesResetPassword.style.display = "none";
                    notify.style.display = "block";
                    notify.classList.remove("text-success");
                    notify.innerHTML = "Enter your confirm password";
                    notify.classList.add("text-danger");
                }
                confirmPassword.addEventListener("input",function(){
                    if(this.value != newPassword.value){
                        btnSaveChangesResetPassword.style.display = "none";
                        notify.style.display = "block";
                        notify.classList.remove("text-success");
                        notify.classList.add("text-danger");
                        notify.innerHTML = "New password and confirm password is not matched";
                    }else{
                        btnSaveChangesResetPassword.style.display = "inline-block";
                        notify.style.display = "block";
                        notify.classList.remove("text-danger");
                        notify.classList.add("text-success");
                        notify.innerHTML = "Password OK!";
                    }
                });    
            }
        });
    }

    function AJAXResetPassword(id_user,new_password){
        var btnCloseResetPassword = document.getElementById("btn-close-reset-password");
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('users/reset_password'); ?>',
            data: {id:id_user,password:new_password}
        }).done(function(data){
            btnCloseResetPassword.click();
            alert(data);
        }).fail(function(jqXHR,textStatus){
            alert("Failed to reset password");
            console.log(jqXHR);
        });
    }

    function triggerResetPassword(){
        var btnSaveChangesResetPassword = document.getElementById("btn-save-changes-reset-password"); 
        <?php reset($users); ?>
        <?php foreach($users as $user): ?>
            document.getElementById("btn-reset-password-<?php echo $user['id']; ?>").addEventListener("click",function(){
                validateChangePassword();
                btnSaveChangesResetPassword.addEventListener("click",function(){
                    var id = "<?php echo $user['id']; ?>";
                    var password = document.getElementById("input-reset-new-password").value;
                    AJAXResetPassword(id,password);
                });
            });
        <?php endforeach; ?>
    }

    triggerResetPassword();



    //Functionality create account

    function checkExistsUsername(username){
        <?php reset($users); ?>
        <?php foreach($users as $user): ?>
            if(username == '<?php echo $user['username']; ?>'){
                return true;
            } 
        <?php endforeach; ?>
        return false;
    }

    function checkIndentityCard(id){
        <?php reset($users); ?>
        <?php foreach($users as $user): ?>
            if(id == '<?php echo $user['cmnd']; ?>'){
                return true;
            } 
        <?php endforeach; ?>
        return false;
    }

    function validateName(){
        var inputName = document.getElementById("input-name");
        var notifyInputName = document.getElementById("notify-input-name");
        if(inputName.value.length == 0){
            notifyInputName.innerHTML = "Your Name must not be empty";
            notifyInputName.classList.remove("text-success");
            notifyInputName.classList.add("text-danger");
            return false;
        }else{
            notifyInputName.innerHTML = "Your Name is valid";
            notifyInputName.classList.remove("text-danger");
            notifyInputName.classList.add("text-success");
            return true;
        }
    }

    function validateCMND(){
        var inputCMND = document.getElementById("input-cmnd");
        var notifyInputCMND = document.getElementById("notify-input-cmnd");
        if(inputCMND.value.length ==  0){
            notifyInputCMND.innerHTML = "Identity card must not be empty";
            notifyInputCMND.classList.remove("text-success");
            notifyInputCMND.classList.add("text-danger");
            return false;
        }else if(inputCMND.value.length > 11 || inputCMND.value.length < 9){
            notifyInputCMND.innerHTML = "Identity card must be between 9 to 11 characters";
            notifyInputCMND.classList.remove("text-success");
            notifyInputCMND.classList.add("text-danger");
            return false;
        }else if(checkIndentityCard(inputCMND.value)){
            notifyInputCMND.innerHTML = "Your Indentity Card was exists";
            notifyInputCMND.classList.remove("text-success");
            notifyInputCMND.classList.add("text-danger");
        }else{
            notifyInputCMND.innerHTML = "Your Identity Card is valid";
            notifyInputCMND.classList.remove("text-danger");
            notifyInputCMND.classList.add("text-success");
            return true;
        }
    }

    function validateUsername(){
        var inputUsername = document.getElementById("input-username");
        var notifyInputUsername = document.getElementById("notify-input-username");
        if(inputUsername.value.length == 0){
            notifyInputUsername.innerHTML = "Your Username must not be empty";
            notifyInputUsername.classList.remove("text-success");
            notifyInputUsername.classList.add("text-danger");
            return false;
        }else if(inputUsername.value.length < 6){
            notifyInputUsername.innerHTML = "Your Username must be at least 6 characters";
            notifyInputUsername.classList.remove("text-success");
            notifyInputUsername.classList.add("text-danger");
            return false;
        }else if(checkExistsUsername(inputUsername.value)){
            notifyInputUsername.innerHTML = "Your Username was exist, please choose another username";
            notifyInputUsername.classList.remove("text-success");
            notifyInputUsername.classList.add("text-danger");
        }else{
            notifyInputUsername.innerHTML = "Your Username is valid";
            notifyInputUsername.classList.remove("text-danger");
            notifyInputUsername.classList.add("text-success");
            return true;
        }
    }

    function validatePassword(){
        var inputPassword = document.getElementById("input-password");
        var notifyInputPassword = document.getElementById("notify-input-password");
        if(inputPassword.value.length == 0){
            notifyInputPassword.innerHTML = "Your password must not be empty";
            notifyInputPassword.classList.remove("text-success");
            notifyInputPassword.classList.add("text-danger");
            return false;
        }else if(inputPassword.value.length < 6){
            notifyInputPassword.innerHTML = "Your password must be at least 6 characters";
            notifyInputPassword.classList.remove("text-success");
            notifyInputPassword.classList.add("text-danger");
            return false;
        }else{
            notifyInputPassword.innerHTML = "Your password is valid";
            notifyInputPassword.classList.remove("text-danger");
            notifyInputPassword.classList.add("text-success");
            return true;
        }
    }

    function validateConfirmPassword(){
        var inputConfirmPassword = document.getElementById("input-password-confirm");
        var inputPassword = document.getElementById("input-password");
        var notifyInputConfirmPassword = document.getElementById("notify-input-password-confirm");
        if(inputConfirmPassword.value.lenght == 0){
            notifyInputConfirmPassword.innerHTML = "Confirm password not be empty";
            notifyInputConfirmPassword.classList.remove("text-success");
            notifyInputConfirmPassword.classList.add("text-danger");
            return false;
        }else if(inputConfirmPassword.value != inputPassword.value){
            notifyInputConfirmPassword.innerHTML = "Password and confirm password did not match";
            notifyInputConfirmPassword.classList.remove("text-success");
            notifyInputConfirmPassword.classList.add("text-danger");
            return false;
        }else{
            notifyInputConfirmPassword.innerHTML = "Confirm password is valid";
            notifyInputConfirmPassword.classList.remove("text-danger");
            notifyInputConfirmPassword.classList.add("text-success");
            return true;
        }
    }

    function validateCreateAccount(){
        var btnCreateNewAccount = document.getElementById("btn-create-new-account");
        if(validateName() && validateCMND() && validateUsername() && validatePassword() && validateConfirmPassword()){
            btnCreateNewAccount.style.display = "inline-block";
            return true;
        }else{
            btnCreateNewAccount.style.display = "none";
            return false;
        }
    }

    //wrong
    function AJAXCreateAccount(userInfo){
        var btnCloseCreateAccount = document.getElementById("btn-close-create-new-account");
        $.ajax({
            type:"post",
            url: "<?php echo base_url('users/create_account'); ?>",
            data: {user:userInfo},
            cache: false
        }).done(function(data){
            btnCloseCreateAccount.click();
            alert(data);
            location.reload();
        }).fail(function(jqXHR,textStatus){
            console.log(jqXHR);
            alert("Failed to create new account");
        });
    }

    function triggerValidateCreateAccount(){
        var inputName = document.getElementById("input-name");
        var inputCMND = document.getElementById("input-cmnd");
        var inputUsername = document.getElementById("input-username");
        var inputPassword = document.getElementById("input-password");
        var inputConfirmPassword = document.getElementById("input-password-confirm");
        
        inputName.addEventListener("input",function(){
            validateName();
            if(validateCreateAccount()){
                var user = {
                    "name": inputName.value,
                    "cmnd": inputCMND.value,
                    "username": inputUsername.value,
                    "password": inputPassword.value
                };
                var btnCreateAccount = document.getElementById("btn-create-new-account");
                btnCreateAccount.addEventListener("click",function(){
                    AJAXCreateAccount(user);
                });
                return true;
            }else{
                return false;
            }
        });

        inputCMND.addEventListener("input",function(){
            validateCMND();
            if(validateCreateAccount()){
                var user = {
                    "name": inputName.value,
                    "cmnd": inputCMND.value,
                    "username": inputUsername.value,
                    "password": inputPassword.value
                };
                var btnCreateAccount = document.getElementById("btn-create-new-account");
                btnCreateAccount.addEventListener("click",function(){
                    AJAXCreateAccount(user);
                });
                return true;
            }else{
                return false;
            }
        });

        inputUsername.addEventListener("input",function(){
            validateUsername();
            if(validateCreateAccount()){
                var user = {
                    "name": inputName.value,
                    "cmnd": inputCMND.value,
                    "username": inputUsername.value,
                    "password": inputPassword.value
                };
                var btnCreateAccount = document.getElementById("btn-create-new-account");
                btnCreateAccount.addEventListener("click",function(){
                    AJAXCreateAccount(user);
                });
                return true;
            }else{
                return false;
            }
        });

        inputPassword.addEventListener("input",function(){
            validatePassword();
            if(validateCreateAccount()){
                var user = {
                    "name": inputName.value,
                    "cmnd": inputCMND.value,
                    "username": inputUsername.value,
                    "password": inputPassword.value
                };
                var btnCreateAccount = document.getElementById("btn-create-new-account");
                btnCreateAccount.addEventListener("click",function(){
                    AJAXCreateAccount(user);
                });
                return true;
            }else{
                return false;
            }
        });

        inputConfirmPassword.addEventListener("input",function(){
            validateConfirmPassword();
            if(validateCreateAccount()){
                var user = {
                    "name": inputName.value,
                    "cmnd": inputCMND.value,
                    "username": inputUsername.value,
                    "password": inputPassword.value
                };
                var btnCreateAccount = document.getElementById("btn-create-new-account");
                btnCreateAccount.addEventListener("click",function(){
                    AJAXCreateAccount(user);
                });
                return true;
            }else{
                return false;
            }
        });
    }

    function deleteUser(){
        <?php reset($users);?>
        <?php foreach($users as $user): ?>
            triggerDeleteUser("<?php echo $user['id']; ?>");
        <?php endforeach; ?>
    }

    function AJAXDeleteUser(id_user){
        $.ajax({
            type: "post",
            url: "<?php echo base_url('users/delete_user'); ?>",
            data: {id:id_user}
        }).done(function(data){
            $("#user-"+id_user).fadeOut(2000);
            alert("User was deleted")
        }).fail(function(jqXHR,textStatus){
            alert("Fail to delete");
        });
    }

    function triggerDeleteUser(id){
        var btnDeleteUser = document.getElementById("btn-delete-user-"+id);
        btnDeleteUser.addEventListener("click",function(){
            AJAXDeleteUser(id);
        });
    }
    deleteUser();
    triggerValidateCreateAccount();

</script>