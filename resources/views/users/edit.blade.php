<!-- Modal Edit -->
<div class="modal fade text-left" id="edituser" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editModalLabel">Edit User</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label for="edit-nama">Nama: </label>
                    <div class="form-group">
                        <input id="edit-nama" type="text" name="nama" placeholder="Nama" class="form-control"
                            required>
                    </div>
                    <label for="edit-email">Email: </label>
                    <div class="form-group">
                        <input id="edit-email" type="email" name="email" placeholder="Email" class="form-control"
                            required>
                    </div>
                    <label for="edit-nip">NIP: </label>
                    <div class="form-group">
                        <input id="edit-nip" type="text" name="nip" placeholder="NIP" class="form-control">
                    </div>
                    <label for="edit-level">Level</label>
                    <select id="edit-level" name="level" class="form-control" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <label for="edit-status">Status</label>
                    <select id="edit-status" name="status" class="form-control" required>
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Edit -->
