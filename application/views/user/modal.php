<!-- Modal -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="msg"></div>
                <form method="POST" action="<?= site_url('auth/createUser') ?>" enctype="multipart/form-data" id="create_user_form">
                    <input type="hidden" name="size" value="1000000">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <div id="my_camera" style="height: 250;" class="text-center">
                                    <img src="<?= site_url() ?>assets/img/person.png" alt="..." class="img img-fluid" width="250" alt="preview">
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                                    <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
                                </div>
                                <div id="profileImage">
                                    <input type="hidden" name="profileimg">
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="avatar" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group form-floating-label">
                                <label>Username</label>
                                <input type="text" class="form-control" name="identity" required minlength="5">
                            </div>
                            <div class="form-group form-floating-label">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" required>
                            </div>
                            <div class="form-group form-floating-label">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" required>
                            </div>
                            <div class="form-group form-floating-label">
                                <label>User Role</label>
                                <select class="form-control" name="group" required>
                                    <?php foreach($this->ion_auth->groups()->result() as $row): ?>
                                        <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>Email Address</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="position-relative">
                            <input id="password" name="password" type="password" class="form-control mb-0" required="" minlength="5">
                            <div class="show-password" style="cursor:pointer">
                                <small>Show Password</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="position-relative">
                            <input id="confirmpassword" name="confirmpassword" type="password" class="form-control" required="" minlength="5">
                            <div class="show-password" style="cursor:pointer">
                                <small>Show Password</small>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>