<!--begin::Card header-->
<div class="card-header border-0 pt-6">
    <!--begin::Card title-->
    <div class="d-flext card-toolbar gap-4" >
        <!--begin::Search-->
        <div class="d-flex align-items-center position-relative my-1">
        <div class="form-floating">
            <input type="text" class="form-control form-input-solid" id="floatingInputGrid" placeholder="name@example.com" value="">
            <label for="floatingInputGrid" class="text-muted"><i class="fas fa-car text-success"></i>&nbsp;&nbsp;License Plate</label>
        </div>
        </div>
        <!--end::Search-->
        <!--begin::Status-->
        <div class="d-flex align-items-center position-relative my-1">            
            <!--end::Svg Icon-->
            <div class="form-floating">
                <select  class="form-select form-control form-select-sm form-select-solid w-250px ps-15 " id="floatingSelect" aria-label="Floating label select example">
                    <option selected>All</option>
                    <option value="actual">Actual</option>
                    <option value="replacement">Replacement</option>
                    <option value="nocontract">No Contract</option>
                </select>
                <label for="floatingSelect" class="text-muted"><i class="fas fa-filter text-primary"></i>&nbsp;&nbsp;Status</label>
            </div>
        </div>
        <!--end::Status-->
        <div class="d-flex align-items-center position-relative my-1">   
            <div class="btn-group">
                <button href="#" class="btn btn-sm btn-primary h"><i class="fas fa-search text-succes"></i>Search</button>
                <button href="#" class="btn btn-danger"><i class="fas fa-print text-succes"></i>Export To Excel</button>
            </div>
        </div> 
    </div>
    <!--begin::Card title-->
</div>