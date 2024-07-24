@extends('layouts.my-account')

@section('my-account')
    <div class="row">
        <div class="col-md-6">
            <h2 class="account__content--title h3 mb-20">Vehicles</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('vehicles.create') }}" class="primary__btn slider__btn">Add Vehicle</a>
        </div>
        <div class="account__table--area">
            <table class="account__table">
                <thead class="account__table--header">
                    <tr class="account__table--header__child">
                        <th class="account__table--header__child--items">#</th>
                        <th class="account__table--header__child--items">Category</th>
                        <th class="account__table--header__child--items">Brand</th>
                        <th class="account__table--header__child--items">Model</th>
                        <th class="account__table--header__child--items">Variant</th>
                        <th class="account__table--header__child--items">Type</th>
                        <th class="account__table--header__child--items">Actions</th>
                    </tr>
                </thead>
                <tbody class="account__table--body mobile__none">
                    @foreach ($vehicles as $key => $vehicle)
                        <tr class="account__table--body__child">
                            <td class="account__table--body__child--items">{{ ++$key }}</td>
                            <td class="account__table--body__child--items">{{ $vehicle->category->name }}</td>
                            <td class="account__table--body__child--items">{{ optional($vehicle->brand)->brand_name }}
                            </td>
                            <td class="account__table--body__child--items">{{ optional($vehicle->model)->model_name }}
                            </td>
                            <td class="account__table--body__child--items">
                                {{ optional($vehicle->variant)->variant_name }}</td>
                            <td class="account__table--body__child--items">{{ optional($vehicle->type)->vehicle_type }}
                            </td>
                            <td class="account__table--body__child--items">
                                <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="primary__btn slider__btn">
                                    Edit
                                </a>
                                <button id="deleteButton" data-source="product"
                                    data-endpoint="{{ route('vehicles.destroy', $vehicle->id) }}"
                                    class="primary__btn slider__btn delete-btn">Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    {{-- <script>
        $(function() {
            $('.delete-btn').click(function() {
               alert('sad');
                let source = $(this).data('source');
                let deleteApiEndpoint = $(this).data('endpoint');

                swal({
                    title: "Are you sure?",
                    text: `You really want to remove this ${source}?`,
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: deleteApiEndpoint,
                            method: 'DELETE',
                            data: {
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    swal({
                                        title: "Success!",
                                        text: response.message,
                                        type: "success",
                                        showConfirmButton: false
                                    })

                                    setTimeout(() => {
                                        location.reload();
                                    }, 2000);
                                }
                            }
                        })
                    }
                });
            })
        })
    </script> --}}
@endsection
