<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Delete Confirmation</h5>
            <button class="btn-close" onclick="closeDeleteModal()">&times;</button>
        </div>
        <div class="modal-body">
            Are you sure to delete <strong id="deleteItemName"></strong> ?
        </div>
        <div class="modal-footer">
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                <button type="submit" class="btn-delete">Delete</button>
            </form>
        </div>
    </div>
</div>
