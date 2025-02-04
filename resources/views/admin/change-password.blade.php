@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Change Password</h1>
            </div>
            <div class="col-sm-6 text-right">
                
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        @include('admin.message')
        <form action="" method="post" id="changePassword" name="changePassword">
            
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">               
                                <label for="name">Old Password</label>
                                <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">               
                                <label for="name">New Password</label>
                                <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">               
                                <label for="name">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control">
                                <p></p>
                            </div>
                        </div>
                        
                    </div>
                </div>							
            </div>
            <div class="col-md-6">
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customJs')
    <script>
        $("#changePassword").submit(function(e){
            e.preventDefault();
            $("button[type=submit]").prop('disabled',true);
            $.ajax({
                url: '{{ route("admin.processChangePassword") }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        window.location.href = '{{ route("admin.showChangePasswordForm") }}';
                    } else {
                        var errors = response.errors;
                        $("button[type=submit]").prop('disabled',false);
                        if(errors.old_password){
                            $("#old_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.old_password)
                        } else {
                            $("#old_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html(errors.old_password)
                        }

                        if(errors.new_password){
                            $("#new_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.new_password)
                        } else {
                            $("#new_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html(errors.new_password)
                        }

                        if(errors.confirm_password){
                            $("#confirm_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.confirm_password)
                        } else {
                            $("#confirm_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html(errors.confirm_password)
                        }
                    }
                }
            });
        });
        
    </script>
@endsection