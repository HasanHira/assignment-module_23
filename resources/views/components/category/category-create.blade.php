<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
            </div>
            <div class="modal-body">
                <form id="category-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="category_name">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="close-modal" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button id="save-btn" class="btn btn-sm btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>

    document.getElementById("save-btn").addEventListener('click', async function(){

        let categoryName = document.getElementById("category_name").value;

        if(categoryName.length === 0){
            errorToast("Category Name Required!");
        }
        else {
            document.getElementById("close-modal").click();

            showLoader()
            let response = await axios.post('/create-category', {
                name:categoryName
            })
            hideLoader()

            if(response.status === 200){
                successToast("Category Created Successfully");

                document.getElementById("category-form").reset();
                await getList();
            }
            else {
                errorToast("Request Fail!");
            }
        }

    });

</script>
