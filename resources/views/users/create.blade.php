            <!-- Modal -->
            <div class="modal fade text-left" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Tambah User </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="" method="POST">
                            @csrf
                            <div class="modal-body">
                                <label for="nama">nama: </label>
                                <div class="form-group">
                                    <input id="nama" type="text" name="nama" placeholder="nama"
                                        class="form-control">
                                </div>
                                <label for="email">email: </label>
                                <div class="form-group">
                                    <input id="email" type="text" name="email" placeholder="email"
                                        class="form-control">
                                </div>
                                <label for="nip">nip: </label>
                                <div class="form-group">
                                    <input id="nip" type="text" name="nip" placeholder="nip"
                                        class="form-control">
                                </div>
                                <label for="password">password: </label>
                                <div class="form-group">
                                    <input id="password" type="password" name="password" placeholder="password"
                                        class="form-control">
                                </div>
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>

                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>

                                </select>

                                <label for="status">status</label>
                                <select name="status" id="status" class="form-control" required>

                                    <option value="aktif">aktif</option>
                                    <option value="tidak aktif">tidak aktif</option>

                                </select>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ms-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tambah</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end modal --}}
