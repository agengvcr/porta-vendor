<div class="card card-flush shadow-lg">  
    @include('unit.headerList') 
    <!--begin::Card body-->
    <hr class="border-gray-300 border-dashedy">
    <div class="card-body py-4">
       
        <!--begin::Table-->
        <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bold fs-7  gs-0">
                            <th><i class="fas fa-car text-success"></i>&nbsp;&nbsp;License Plate</th>
                            <th><i class="fas fa-tachometer-alt text-info"></i>&nbsp;&nbsp;Asset Type</th>
                            <th><i class="far fa-calendar-alt text-danger"></i>&nbsp;&nbsp;Rent Date From</th>
                            <th><i class="far fa-calendar-alt text-danger"></i>&nbsp;&nbsp;Rent Date To</th>
                            <th><i class="fas fa-info-circle text-primary"></i>&nbsp;&nbsp;Status</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-semibold">
                        
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>