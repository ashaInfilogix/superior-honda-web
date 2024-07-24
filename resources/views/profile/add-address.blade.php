@extends('layouts.my-account')

@section('my-account')
    <div class="account__content">
        <h2 class="account__content--title h3 mb-20">Add New Address</h2>
        <form action="{{ route('addresses.store') }}" name="create-address" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label>Full Name</label>
                    <input type="text" name="full_name" class="account__login--input">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Mobile Number</label>
                    <input type="number" name="mobile_no" class="account__login--input">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Address (House No., Building Name)</label>
                    <input type="text" name="address" class="account__login--input">
                </div>
                <div class="col-md-6 mb-2">
                    <label>City</label>
                    <input type="text" name="city" class="account__login--input">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Nearby Famous Shop/Mall/Landmark</label>
                    <input type="text" name="nearby" class="account__login--input">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Postal Code</label>
                    <input type="number" name="postal_code" class="account__login--input">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Country</label>
                    <select id="country" name="country_id" class="account__login--input">
                        <option>Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label>State</label>
                    <select id="state" name="state_id" class="account__login--input">
                        <option>Select State</option>
                    </select>
                </div>
                <div class="col-md-6 mt-2">
                    <input type="checkbox" name="is_default" @checked(old(0, !$savedAddress)) @disabled(!$savedAddress)> Use address as default
                </div>
            </div>
            <br />
            <button class="new__address--btn primary__btn">Save Address</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('[name="create-address"]').validate({
                rules: {
                    full_name: "required",
                    mobile_no: "required",
                    address: "required",
                    city: "required",
                    postal_code: "required",
                    nearby: "required",
                    state: "required",
                    country: "required",
                },
                messages: {
                    full_name: "Please enter category full name",
                    mobile_no: "Please enter product mobile number",
                    address: "Please enter manufacture address",
                    city: "Please enter manufacture city",
                    postal_code: "Please enter manufacture postal code", 
                    nearby: "Please enter manufacture nearby", 
                    state: "Please enter manufacture state", 
                    country: "Please enter manufacture country", 

                },
                errorClass: "text-danger f-12",
                errorElement: "span",
                /* errorPlacement: function(error, element) {
                    error.insertAfter(element.siblings("label"));
                }, */
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function(form) {
                    console.log('form',form)
                    form.submit();
                }
            });
        });

        $('#country').on('change',function(){
            var country_id = $(this).val();
            $.ajax({
                url : "{{ route('addresses.getStates') }}/"+country_id,
                type : 'GET',
                success : function(resp){
                    $('#state').html(resp);
                },error : function(err){
                    console.log(err);
                }
            });
        });
    </script>
@endsection
