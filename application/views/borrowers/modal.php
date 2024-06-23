<!-- Modal -->
<div class="modal fade" id="addBorrowers" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Borrower's Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= site_url('borrowers/create_borrowers') ?>" enctype="multipart/form-data" id="create_borrowers_form">
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
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="name" required placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" name="gender" required>
                                    <option>Male</option>
                                    <option>Femail</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Birthdate</label>
                                <input type="date" class="form-control" name="bdate" required>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="number" class="form-control" name="number" required minlength="11" placeholder="Enter phone number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Occupation</label>
                                <input type="text" class="form-control" name="occupation" required placeholder="Enter occupation">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Employer's Address</label>
                                <input type="text" class="form-control" name="em_address" required placeholder="Enter employer's address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Spouse Name</label>
                                <input type="text" class="form-control" name="spouse_name" placeholder="Enter spouse name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Spouse Occupation</label>
                                <input type="address" class="form-control" name="spouse_occu" placeholder="Enter spouse occupation">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Spouse Employer's Address</label>
                        <textarea class="form-control" name="spouse_em_address" placeholder="Enter spouse employer's address"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Permanent Address</label>
                        <textarea class="form-control" name="address" required placeholder="Enter permanent address"></textarea>
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

<!-- Modal -->
<div class="modal fade" id="editBorrowers" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Borrower's Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= site_url('borrowers/update_borrowers') ?>" enctype="multipart/form-data" id="edit_borrowers_form">
                    <input type="hidden" name="size" value="1000000">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <div id="my_camera1" style="height: 250;" class="text-center">
                                    <img src="<?= site_url() ?>assets/img/person.png" alt="..." class="img img-fluid" width="250" alt="preview" id="avatar">
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam1">Open Camera</button>
                                    <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo1()">Capture</button>   
                                </div>
                                <div id="profileImage1">
                                    <input type="hidden" name="profileimg">
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="avatar" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="name" required placeholder="Enter name" id="name">
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" name="gender" required id="gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Birthdate</label>
                                <input type="date" class="form-control" name="bdate" required id="birthdate">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="number" class="form-control" name="number" required minlength="11" placeholder="Enter phone number" id="number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Occupation</label>
                                <input type="text" class="form-control" name="occupation" required placeholder="Enter occupation" id="occupation">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Employer's Address</label>
                                <input type="address" class="form-control" name="em_address" required placeholder="Enter employer's address" id="em_address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Spouse Name</label>
                                <input type="text" class="form-control" name="spouse_name" placeholder="Enter spouse name" id="spouse">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Spouse Occupation</label>
                                <input type="address" class="form-control" name="spouse_occu" placeholder="Enter spouse occupation" id="spouse_occu">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Spouse Employer's Address</label>
                        <textarea class="form-control" name="spouse_em_address" placeholder="Enter spouse employer's address" id="spouse_em_address"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Permanent Address</label>
                        <textarea class="form-control" name="address" required placeholder="Enter permanent address" id="address"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="borrowers_id">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>