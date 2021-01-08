<!-- Modal -->
<div class="modal fade" id="modal-new-customer" tabindex="-1" role="dialog" aria-labelledby="new-customer-lable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="new-customer-lable">Adding New Customer</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-add-new-customer">

                    <div class='row'>
                        <div class='col'>
                            <label for='new-customer-fName'>First Name:</label>
                            <div class="custom-control custom-control-inline"> <!--positioning error message-->
                                <input type='text' id='new-customer-fName' name='new-customer-fName' 
                                    onkeydown='return !(/[0-9\!@#$%^&*()+=\-|~<>{}\/\"\[\]\\:?؟;.,`_]/i.test(event.key));' required>
                            </div>
                        </div>

                        <div class='col'>
                            <label for='new-customer-gender'>Gender:</label>

                            <div class="custom-control custom-control-inline"> <!--positioning error message-->
                                <select class="form-control" id="new-customer-gender" required>
                                    <option hidden disabled selected value=""> -- Select a Gender -- </option>
                                    <option value='male'>Male</option>
                                    <option value='female'>Female</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class='row my-4'>

                        <div class='col'>
                            <label for='new-customer-lName'>Last Name:</label>
                            <div class="custom-control custom-control-inline"> <!--positioning error message-->
                                <input type='text' id='new-customer-lName' name='new-customer-lName'
                                    onkeydown='return !(/[0-9\!@#$%^&*()+=\-|~<>{}\/\"\[\]\\:?؟;.,`_]/i.test(event.key));' required>
                            </div>
                        </div>

                        <div class='col'>
                            <label for='new-customer-age'>Age:</label>
                            <div class="custom-control custom-control-inline"> <!--positioning error message-->
                                <input type='number' min="5" id='new-customer-age' name='new-customer-age' 
                                    onkeydown='return /[0-9]/i.test(event.key)' required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" id="result-add-new-customer">
                        
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="query-new-customer">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>
