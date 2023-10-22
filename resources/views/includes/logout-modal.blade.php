<div class="modal fade bd-logout-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleSmallModalLabel">Ready to Leave?</h5>
            </div>
            <div class="modal-body">
                <p class="text-muted">Select "Logout" below if you are ready to end your current session.</p>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="onLogout()">Logout</button>
            </div>
        </div>
    </div>
</div>
