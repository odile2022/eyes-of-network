

<form method="post" action="/module/incident/ansible/runner.php">
    <div class="modal-header">						
        <h4 class="modal-title">Ajout Configuration</h4>
    </div>
    <div class="modal-body">				
        <div class="form-group">
            <label>hostname</label>
            <input type="text" class="form-control" name='vars[v_hostname]' required>
            <input type="hidden" name='test_playbook' value="true">
        </div>
        <div class="form-group">
            <label>test</label>
            <input type="text" class="form-control" name='vars[v_test]' required>
        </div>
    </div>
        <input type="submit" class="btn btn-success" value="Save">
</form>