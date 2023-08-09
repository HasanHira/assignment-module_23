<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Category</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark "/>
                <table class="table" id="tableData">
                    <thead>
                    <tr class="bg-light">
                        <th>No</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tableList">
                    {{--Table Data--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    getList();
    async function getList(){

        showLoader();
        let response = await axios.get('/list-category');
        hideLoader();

        let tableData = $('#tableData');
        let tableList = $('#tableList');

        tableData.DataTable().destroy();
        tableList.empty();

        response.data.forEach( function(item, index){
            let row =`<tr>
                        <td>${index +1}</td>
                        <td>${item['name']}</td>
                        <td>
                            <button data-id="${item['id']}" class="btn btn-sm btn-outline-success editBtn">Edit</button>
                            <button data-id="${item['id']}" class="btn btn-sm btn-outline-danger deleteBtn">Delet</button>
                        </td>
                    </tr>`
            tableList.append(row);
        });

        // Select Item by its ID
        $('.editBtn').on('click', function(){
            let id = $(this).data('id');
            alert(id);
        });

        $('.deleteBtn').on('click', function(){
            let id = $(this).data('id');
            let itemName = $(this).data('name');
            $('#delete-modal').show();
            $('#itemDeleteID').val(id);
            $('#confirm-delete').innerText(itemName);
        });


        new DataTable('#tableData', {
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20]
        });

    }

</script>
