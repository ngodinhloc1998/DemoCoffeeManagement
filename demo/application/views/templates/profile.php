<div class="row justify-content-center">
    <div class="col-md-8 align-self-center">
        <div class="card">
            <div class="card-header">
                <h4 class="text-info">Your Profile</h4>
            </div>
            <div class="card-body">

                <table class="table" width="80%">
                    <tr>
                        <th scope="row">Name</th>
                        <td>
                            <strong><?php  echo $user[0]['name']; ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Username</th>
                        <td>
                            <strong><?php  echo $user[0]['username']; ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Identity Card</th>
                        <td>
                            <strong><?php  echo $user[0]['cmnd']; ?></strong>
                        </td>
                    </tr>
                </table>

            </div>
            <div class="card-footer">
                <div class="btn btn-primary" id="btn-change-password">Change Password</div>
                    <form class="form-group" style="display: none;" id="container-change-password">
                        <div class="row mt-2 mb-2">
                            <div class="col-sm-4">
                                <p>New Password*</p>
                            </div>
                            <div class="col-sm-8">
                                <input id='new-password' style="border: 1px solid;" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-2 justify-content-center">
                            <div class="col-sm-4">
                                <p>Passoword Validation*</p>
                            </div>
                            <div class="col-sm-8">
                                <input id='vali-password' type="password" style="border: 1px solid;" class="form-control">
                            </div>
                            <div id="container-notify" style="display: none;" class="col-sm-12 mt-3 mb-3">
                                <p id="notify" class="text-center border">Duma</p>
                            </div>
                            <div class="col-sm-4 mt-2">
                                <div style="display: none;" id="btn-save-change-password" class="btn btn-primary">Save</div>
                                <div id="btn-cancel-change-password" class="btn btn-danger">Cancel</div>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changePassword(){
        var btnChangePassword = document.getElementById('btn-change-password');
        var btnSaveChangePassword = document.getElementById('btn-save-change-password');
        var btnCancelChangePassword = document.getElementById('btn-cancel-change-password');
        var containerForm = document.getElementById('container-change-password');
        btnChangePassword.addEventListener("click",function(){            
            containerForm.style.display = 'block';
        });
        btnCancelChangePassword.addEventListener('click',function(){
            containerForm.style.display = 'none';
        });
    }

    function validationPassword(){
        var newPassword = document.getElementById('new-password');
        var valiPassword = document.getElementById('vali-password');
        var containerNotify = document.getElementById('container-notify');
        var notify = document.getElementById('notify');
        var btnSaveChange = document.getElementById('btn-save-change-password');
     
        newPassword.addEventListener("input",function(){
            if(this.value.length < 6){
                containerNotify.style.display = "block";
                notify.classList.remove('text-success');
                notify.classList.add('text-danger');
                notify.innerHTML = "Password at least 6 character";
            }else{
                containerNotify.style.display = "block";
                notify.classList.remove('text-danger');
                notify.classList.add('text-success');
                notify.innerHTML = "Password OK!";
            }
        });

        valiPassword.addEventListener("input",function(){
           if(this.value != newPassword.value){
                containerNotify.style.display = "block";
                notify.classList.remove('text-success');
                notify.classList.add('text-danger');
                notify.innerHTML = "Old password and new password not matched";
                btnSaveChange.style.display = "none";
           }else{
                containerNotify.style.display = "block";
                notify.classList.remove('text-danger');
                notify.classList.add('text-success');
                notify.innerHTML = "Password OK!";
                btnSaveChange.style.display = "inline-block";
                btnSaveChange.addEventListener("click",function(){
                    AJAXSaveChange(valiPassword.value);
                });
           }
        });
    }

    function AJAXSaveChange(newPassword){
        $.ajax({
            type: 'post',
            url: "<?php echo base_url('users/change_password'); ?>",
            data: {password:newPassword}
        }).done(function(data){
            alert("Success");
        }).fail(function(jqXHR,textStatus){
            console.log(jqXHR);
        });
    }


    changePassword();
    validationPassword();
</script>